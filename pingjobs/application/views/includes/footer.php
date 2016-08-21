</div>
	<footer class="footer">
	    <div class="footer-nav">
		      <div class="container">
		      	<div class="row">      	
		      		<!--<div class="col-md-2">
		      			<h5>Information</h5>
		      			<ul>
							<li><a>About Us</a></li>
							<li><a>Terms & Conditions</a></li>
							<li><a>Privacy Policy</a></li>
							<li><a>Contact Us</a></li>
							<li><a>FAQs</a></li>
		      			</ul>
		      		</div>

		      		<div class="col-md-2">
		      			<h5>Joobseekers</h5>
		      			<ul>
							<li><a>Post your resume</a></li>
							<li><a>Job search</a></li>
						</ul>
		      		</div>
		      		<div class="col-md-2">
						<h5>Browse Jobs</h5>
		      			<ul>
							<li><a>Browse All Jobs</a></li>							
							<li><a>Jobs by Company</a></li>
							<li><a>Jobs by Category</a></li>
							<li><a>Jobs by Designation</a></li>
		      			</ul>
		      		</div>
		      		<div class="col-md-2">
						<h5>Employers</h5>
		      			<ul>
							<li><a>Post Jobs</a></li>
							<li><a>Access Database</a></li>						
		      			</ul>
		      		</div>
		      		<div class="col-md-2">
						<h5>Follow us</h5>
		      			<ul>
							<li><a>Faebook</a></li>
							<li><a>Access Database</a></li>
							<li><a>Manage Responses</a></li>
		      			</ul>
		      		</div>-->
					<div class="col-md-12">
						<p class="text-center copyright">All rights reserved &copy; <?php echo date('Y'); ?> Ping Jobs</p>
					</div>
		      	</div>
		      </div>
	    </div>
	    
    </footer>

<div class="modal" id="employeelogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<?php
	echo form_open('javascript:;',array('class'=>"form-horizontals","id"=>"employee-form-login","onsubmit"=>"return login_employee();"));
	?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employee Login</h4>
      </div>
      <div class="modal-body">
       <div class="alert alert-danger" style="display:none">
        <strong>Error!</strong> The email/username and password you entered don't match .
      </div>
      
          <div class="form-group">
              <input id="employee_email"  name="employee_email" type="email" placeholder="Enter Username" class="form-control input-md" required="">
          </div>

          <div class="form-group">
              <input id="employee_password" name="employee_password" type="password" placeholder="Enter Password" class="form-control input-md" required="">
          </div>
          <div class="form-group">
              New User? <a href="<?php echo SITE_URL?>employee"><strong>Register Now</strong></a> | <a href="/employee/reset_password">Forgot Password?</a>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="employee_login" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Login</button>
      </div>
    </div>
	</form>
  </div>
</div>

<script type="text/javascript">
    gBaseUrl = "<?php echo base_url(); ?>";  
    function login_employee()
    {
      if($('#employee_email').val() != ''  &&  $('#employee_password').val() != '' )
      {
      $.ajax({
        url: gBaseUrl+'/employee/verify_login/',
        type: 'POST',
        data:$('#employee-form-login').serialize(),
        dataType: 'json',
        success: function(response){
          if(response.status == 'ok')
          {             
             window.location=response.data;
          }
          else
          {
            $('.alert-danger').html(response.msg).show();
            //$('.input-lg').addClass('input-alert');

            setTimeout(function(){
              // $('.alert-danger').html(response.msg);
              $('.alert-danger').hide();
              $('.input-lg').removeClass('input-alert');
            }, 3000);
          }
        },
        error: function(res){
        }
      });
      return false;
    }
    }
    </script>


<div class="modal" id="employerlogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<?php
	echo form_open('employer/verify_login',array('class'=>"form-horizontals","role"=>"login","id"=>"form-login","onsubmit"=>"return login();"));
	?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employer Login</h4>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger" style="display:none">
        <strong>Error!</strong> The email/username and password you entered don't match .
      </div>

          <div class="form-group">
              <input id="employer_email" name="email" type="email" placeholder="Enter Username" class="form-control input-md" required="">
          </div>

          <div class="form-group">
              <input id="employer_password" name="password" type="password" placeholder="Enter Password" class="form-control input-md" required="">
          </div>

          <div class="form-group">
              New User?<a href="<?php  echo SITE_URL;?>employer"><strong>Register Now</strong></a> | <a href="/employer/reset_password">Forgot Password?</a>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="employer_login" class="btn btn-primary"><i class="glyphicon glyphicon-log-in"></i> Login</button>
      </div>
    </div>
</form>
  </div>
</div>


<script type="text/javascript">
    gBaseUrl = "<?php echo base_url(); ?>";  
    function login()
    {
      if($('#employer_email').val() != ''  &&  $('#employer_password').val() != '' )
      {
      $.ajax({
        url: gBaseUrl+'/employer/verify_login/',
        type: 'POST',
        data:$('#form-login').serialize(),
        dataType: 'json',
        success: function(response){
          if(response.status == 'ok')
          {             
             window.location=response.data;
          }
          else
          {
            $('.alert-danger').html(response.msg).show();
            //$('.input-lg').addClass('input-alert');

            setTimeout(function(){
              // $('.alert-danger').html(response.msg);
              $('.alert-danger').hide();
              $('.input-lg').removeClass('input-alert');
            }, 3000);
          }
        },
        error: function(res){
        }
      });
      return false;
    }
    }
    </script>



<div class="modal" id="employeeViewDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Employee Details</h4>
      </div>
     <form class="form-horizontal" method="post" action="<?php echo SITE_URL; ?>admin/resume_search">
        <div class="modal-body">

          <div class="form-group">
            <label class="col-md-4 control-label pad-top-0" for="name">Name : </label>
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_name"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label pad-top-0" for="name">Mobile No : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_mobile_no"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Email : </label>  
            <div class="col-md-6">
              <span class="control-label" for="name" id="view_employee_email"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Resume : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name"> <a target="_blank" download href="" id="view_employee_resume_url"><i class="glyphicon glyphicon-download-alt"></i> <span id="view_employee_resume_name"></span></a></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Skills : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_skills"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Experience : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name"><span id="view_employee_exp_year"></span>.<span id="view_employee_exp_month"></span> <small>years</small></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current Company : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_current_company"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current Salary</label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_current_salary"> </span>  <small>(laks/annum)</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Expected Salary : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_expected_salary"></span>  <small>(laks/annum)</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Notice Period : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_notice"></span>  <small>days</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Education Master : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_edu_master"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Education Basic : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_edu_basic"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current City : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_city"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Address : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_address"></span>  
            </div>
          </div>
        </div>
       <div class="modal-footer">
        <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </form>
    </div>
  </div>
</div>








    