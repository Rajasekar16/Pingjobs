<?php echo $header; ?>


<?php


//print_r($employee);


$employee = @$employee[0];
$id =@$employee['id'];
$employee_current_salary =@$employee['employee_current_salary'];
$employee_expected_salary =@$employee['employee_expected_salary'];
$employee_name =@$employee['employee_name'];
$employee_email =@$employee['employee_email'];
$employee_password =@$employee['employee_password'];
$employee_exp_year =@$employee['employee_exp_year'];
$employee_exp_month =@$employee['employee_exp_month'];
$employee_skills =@$employee['employee_skills'];
$employee_edu_master =@$employee['employee_edu_master'];
$employee_edu_basic =@$employee['employee_edu_basic'];
$employee_address =@$employee['employee_address'];
$employee_city =@$employee['employee_city'];
$employee_pincode =@$employee['employee_pincode'];
$employee_mobile_no =@$employee['employee_mobile_no'];
$employee_status =@$employee['employee_status'];
$created_date =@$employee['created_date'];
$employee_current_company =@$employee['employee_current_company'];
$employee_current_desig =@$employee['employee_current_desig'];
$employee_current_from_date =@$employee['employee_current_from_date'];
$employee_current_to_date =@$employee['employee_current_to_date'];
$traing_certificates =@$employee['traing_certificates'];
$employee_industry =@$employee['employee_industry'];
$employee_functional =@$employee['employee_functional'];
$employee_resume_name =@$employee['employee_resume_name'];
$employee_resume_url =@$employee['employee_resume_url'];
$traing_course =@$employee['traing_course'];
$employee_notice =@$employee['employee_notice'];



$year = date('Y', strtotime($employee_current_from_date));
if($year<1980){$employee_current_from_date = date('Y/m/d');}

$year = date('Y', strtotime($employee_current_to_date));
if($year<1980){$employee_current_to_date = date('Y/m/d');}

//echo $year;die();






?>

    <!-- Begin page content -->      
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-12 box">
                  <!-- <h2 class="light page-header">Employee Signup</h2> -->
        <form style="display:none;" method="post" id="resume_upload_form" enctype="multipart/form-data">
            <input type="file" id="resume_upload" name="resume_upload" />
          </form>

            <form  enctype="multipart/form-data"  id ="employee-add-form" class="form-horizontal" onsubmit="return employee_validation();" method="post" id="employee_form" >              
                  <!-- Text input-->

                     <div class="alert alert-danger" style="display:none">
                      <strong>Error!</strong> The email/username and password you entered don't match .
                    </div>
                    <div class="alert alert-success" style="display:none">
                      <strong>Error!</strong> The email/username and password you entered don't match .
                    </div>

                  <div class="col-md-6">
                    <input type="hidden"  name="employee_resume_url" id ="employee_resume_url"   value="<?php  echo $employee_resume_url; ?>" />
                    <input type="hidden"  name="employee_resume_name" class ="employee_resume_name"  value="<?php  echo $employee_resume_name; ?>"  />
                    <input type="hidden"  name="id" id="id"  value="<?php  echo $id; ?>"  />


                    <div class="form-group required">
                    <label class="col-md-5 control-label" for="employee_name">Name</label>  
                    <div class="col-md-7">
                    <input id="employee_name" maxlength="100" name="employee_name"    placeholder="Enter Name" class="form-control input-md" 
                    value="<?php  echo $employee_name; ?>">
                  </div>
                    
                  </div>

                    <?php if($id <1){?>  
                  <div class="form-group required">
                    <label class="col-md-5 control-label" for="employee_email">Email</label>  
                    <div class="col-md-7">
                    <input id="employee_email" maxlength="100" name="employee_email"  onblur="verify_employee_email(this, this.value)" type="email" placeholder="Enter Email Address" class="form-control input-md" required=""
                    value="<?php  echo $employee_email; ?>">
                    <div id="verify_email" class="errorBox" ></div>
                    <input type="hidden" id="email_available_flag" value="0" />
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group required">
                    <label class="col-md-5 control-label" for="employee_password">Password</label>  
                    <div class="col-md-7">
                    <input id="employee_password" maxlength="50" name="employee_password" type="password" placeholder="Enter Password" class="form-control input-md" required="" value="<?php  echo $employee_password; ?>">
                      
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group required">
                    <label class="col-md-5 control-label" for="textinput">Confirm Password</label>  
                    <div class="col-md-7">
                    <input id="employee_conf_password"  type="password" placeholder="Re enter Password" class="form-control input-md" required="" >
                    <div class="errorBox"></div>
                    </div>
                  </div>
                   <?php } ?>

                  <div class="form-group required">
                    <label class="col-md-5 control-label" for="employee_exp_year">Experience</label>  
                    <div class="col-xs-5ths">
                      <select id="employee_exp_year" name="employee_exp_year" class="form-control" required>
                        <option value="">Years</option>
                        <option value="0">freshers</option>
                        <?php 
                        for($i=1;$i<=30;$i++)
                        {
                          $selected ="";
                          if($employee_exp_year == $i)
                          {
                            $selected ="selected";
                          }
                          ?>
                            <option   <?php  echo $selected; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>


                      </select>
                    </div>
                    <div class="col-xs-5ths">
                      <select id="employee_exp_month" name="employee_exp_month" class="form-control">
                        <option value="0">Months</option>
                        <option value="0">0</option>
                        <?php 
                        for($i=1;$i<=12;$i++)
                           {
                           $selected ="";
                          if($employee_exp_month == $i)
                          {
                            $selected ="selected";
                          }
                       ?>
                            <option  <?php  echo $selected; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>


                

                  <!-- Text input-->
		                 <div class="form-group">
                    <label class="col-md-5 control-label" for="textinput">Current Company Name</label>  
                    <div class="col-md-7">
                    <input id="employee_current_company" name="employee_current_company" type="text" placeholder="Company Name" class="form-control input-md"  value ="<?php echo $employee_current_company; ?>">
                    </div>
                  </div>

                  <!-- Select Basic -->
              <!--  <div class="form-group">
                  <label class="col-md-5 control-label" for="selectbasic">Designation</label>
                  <div class="col-md-7 pad-rt-0">
                    <select id="employee_current_desig" name="employee_current_desig" class="form-control">

                      <?php 
                        foreach($designation as $row)
                        {?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>


                      
                    </select>
                  </div>
                </div>
              -->
                 <!-- Select Basic -->
               


                <div class="form-group">
                    <label class="col-md-5 control-label" for="employee_exp_year">Period</label>  
                    <div class="date_from_to">
                      <input  class=" form-control input-md" type="text" placeholder="From" name ="employee_current_from_date"  id="fromdate"   value ="<?php echo date('m-d-Y',strtotime($employee_current_from_date)); ?>" >
                    </div>
                    <div class="date_from_to">
                      <input  class=" form-control input-md" type="text" placeholder="To"  name ="employee_current_to_date" id="todate" value ="<?php echo date('m-d-Y',strtotime($employee_current_to_date)); ?>" >
                    </div>
                  </div>


              <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_edu_basic" >Current Salary</label>
                  <div class="col-md-5 pad-rt-0">
                    <select id="employee_current_salary" name="employee_current_salary" class="form-control">
                        <option value="">Select Education</option>
                        <?php 
                        foreach($salary as $row)
                        {
                          $selected ="";
                          if($employee_current_salary ==$row['id'])
                          {
                            $selected ="selected";
                          }
                          ?>
                          <option   <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                  <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_edu_basic" >Expected Salary</label>
                  <div class="col-md-5 pad-rt-0">
                    <select id="employee_expected_salary" name="employee_expected_salary" class="form-control">
                        <option value="">Select Education</option>
                        <?php 
                        foreach($salary as $row)
                        {
                          $selected ="";
                          if($employee_expected_salary ==$row['id'])
                          {
                            $selected ="selected";
                          }
                          ?>
                          <option <?php echo $selected; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                    </select>
                  </div>
                  <!-- <div class="col-md-1 pad-lt-0 text-right">
                    <a class="btn btn-default" onclick="add_master_education()" data-toggle="tooltip" data-placement="left" title="Add Master Education"><i id="add_master" class="glyphicon glyphicon-plus"></i></a>
                  </div> -->
                </div>                  

                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-5 control-label" for="employee_skills">Key Skills</label>
                    <div class="col-md-7">
                       <input type ="text" class="form-control" data-role="tagsinput"  name="employee_skills"  id="employee_skills" placeholder="Enter Key Skills" value ="<?php echo $employee_skills ;?>" />
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-5 control-label" for="textinput">Notice Period(Days)</label>  
                    <div class="col-md-7">
                    <input id="employee_notice" name="employee_notice"  title="Notice period for only threee digit number"  
                       type="number" min="1" placeholder="Enter Notice Period" class="form-control input-md number-only" value ="<?php  echo  $employee_notice; ?>" >
                      
                    </div>
                  </div>

                <!--   
                  <div class="form-group add-prev-emp">
                    <div class="col-md-12 text-center">
                      <a class="btn btn-default"><span aria-hidden="true" class="glyphicon glyphicon-plus"></span>Previous Employment Details</a>
                      </div>
                  </div> -->



                  <div class="form-group">
                    <label class="col-md-5 control-label" for="employee_skills">Upload Resume</label>
                    <div class="col-md-7">
                   <div style="position:relative;">
                  

          <a id="uploadresumetrigger" class="btn btn-danger btn-action" data-toggle="tooltip" data-placement="left" data-title="Upload Credential">Upload</a></h4>
         

                    &nbsp;
                    <span class='label label-info  employee_resume_name'>  <?php  echo  (strlen($employee_resume_name)<5)?'no resume uploaded':$employee_resume_name; ?> </span>
                  </div>
                   </div>
                  </div>



                 

                 
                  <!-- Text input-->
                  
                </div>  
                <div class="col-md-6">


                  <div class="form-group">
                  <label class="col-md-5 control-label" for="selectbasic">Industry</label>
                  <div class="col-md-7 pad-rt-0">
                    <select id="employee_industry" name="employee_industry" class="form-control">
                      <?php 
                        foreach($industry as $row)
                        {

                          $selected ="";
                          if($employee_industry ==$row['id'])
                          {
                            $selected ="selected";
                          }?>


                          <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                      
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-5 control-label" for="selectbasic">Functional</label>
                  <div class="col-md-7 pad-rt-0">
                    <select id="employee_functional" name="employee_functional" class="form-control">
                      <?php 
                        foreach($functional as $row)
                        {
                          $selected ="";
                          if($employee_functional ==$row['id'])
                          {
                            $selected ="selected";
                          } ?>
                          <option  <?php  echo $selected; ?>value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>                      
                    </select>
                  </div>
                </div>


                   <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-5 control-label" for="textinput">Traing Course</label>  
                    <div class="col-md-7">
                    <input id="textinput" name="traing_course" type="text" placeholder="" class="form-control input-md"  value ="<?php  echo  $traing_course; ?>" >
                      
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-md-5 control-label" for="textinput">Traing Certificates</label>  
                    <div class="col-md-7">
                    <input id="textinput" name="traing_certificates" type="text" placeholder="" class="form-control input-md" value ="<?php  echo  $traing_certificates; ?>" >
                      
                    </div>
                  </div>
              


                <!-- Select Basic --> 
                <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_edu_basic" >Under graduate(UG)</label>
                  <div class="col-md-5 pad-rt-0">
                    <select id="employee_edu_basic" name="employee_edu_basic" class="form-control">
                        <option value="">Select Education</option>
                        <?php 
                        foreach($basic_education as $row)
                        {
                          $selected ="";
                          if($employee_edu_basic ==$row['id'])
                          {
                            $selected ="selected";
                          } ?>
                          <option  <?php echo $selected ;?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                    </select>
                  </div>
                  <!-- <div class="col-md-1 pad-lt-0 text-right">
                    <a class="btn btn-default" onclick="add_master_education()" data-toggle="tooltip" data-placement="left" title="Add Master Education"><i id="add_master" class="glyphicon glyphicon-plus"></i></a>
                  </div> -->
                </div>



                <!-- Select Basic --> 
               <!--  <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_edu_basic" >Post graduate(PG)</label>
                  <div class="col-md-5 pad-rt-0">
                    <select id="employee_edu_basic" name="employee_edu_basic" class="form-control">
                        <option value="">Select Education</option>
                        <?php 
                        foreach($master_education as $row)
                        {
                          $selected ="";
                          if($employee_edu_basic ==$row['id'])
                          {
                            $selected ="selected";
                          } ?>
                          <option <?php echo $selected ;?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                    </select>
                  </div> -->
                  <!-- <div class="col-md-1 pad-lt-0 text-right">
                    <a class="btn btn-default" onclick="add_master_education()" data-toggle="tooltip" data-placement="left" title="Add Master Education"><i id="add_master" class="glyphicon glyphicon-plus"></i></a>
                  </div> -->
                <!--</div> -->


                <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_edu_master" >Post graduate(PG) </label>
                  <div class="col-md-5 pad-rt-0">
                    <select id="employee_edu_master" name="employee_edu_master" class="form-control">
                        <option value="">Select Education</option>
                        <?php 
                        foreach($master_education as $row)
                        { 
                          $selected ="";
                          if($employee_edu_master ==$row['id'])
                          {
                            $selected ="selected";
                          } ?>

                          <option <?php echo $selected ;?>  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

             


                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_address">Address</label>  
                  <div class="col-md-7">
                  <input id="employee_address" name="employee_address" maxlength="200" type="text" placeholder="Enter Address" class="form-control input-md" value ="<?php  echo  $employee_address; ?>"  >
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_city">City</label>  
                  <div class="col-md-7">
                  <input id="employee_city" name="employee_city" type="text"  maxlength="30" placeholder="Enter City Name" class="form-control input-md char-only"   value ="<?php  echo  $employee_city; ?>"  >
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-5 control-label" for="employee_pincode">Pincode</label>  
                  <div class="col-md-7">
                  <input id="employee_pincode" name="employee_pincode" pattern="[0-9]{6}"  maxlength="6" type="text" placeholder="Enter Pincode" class="form-control input-md number-only"   value ="<?php  echo  $employee_pincode; ?>"  >
                  <div class="errorBox"></div>
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group required">
                  <label class="col-md-5 control-label" for="employee_mobile_no"  >Mobile Number</label>  
                  <div class="col-md-7">
                  <input id="employee_mobile_no" name="employee_mobile_no" pattern="[789][0-9]{9}" title="Phone number  start with 7-9 and remaing 9 digit with 0-9"   type="text" placeholder="Enter Mobile Number" class="form-control input-md number-only"  required=""  value ="<?php  echo  $employee_mobile_no; ?>" >
                  <div class="errorBox"></div>
                   </div>
                </div>

                </div> 
              <div class="clearfix"></div>

              <?php if($id ==0){ ?>
              <div class="col-md-12">
                  <div>
                    <div class="col-md-5"></div>  
                    <div class="col-md-7 pad-lt-0">
                      <input type="checkbox" name="" id="terms" value="2"> We agree to the <a>Terms of Use</a> & <a>Privacy Policy</a>                      
                    </div>  
                  </div>
              </div>
              <?php } ?>

              <div class="clearfix"></div>
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <input type="hidden" name="mode" id="mode" value="<?php  echo ($id>0)?'edit':'create';?> ">
                  <button type="button" id="button1id" name="" onclick="clearAll(this)" class="btn btn-default">Cancel</button>
                  <button type="submit" id="submit" name="" class="btn btn-primary"> <?php echo ($id ==0)?'Sign Up Now': "Update Profile"; ?></button>
                </div>
              </div>
           
            </form>



        </div>
        
      </div>
    </div>



<?php echo $footer; ?>
<script type="text/javascript">
gBaseUrl = "<?php echo base_url(); ?>"; 
$(document).ready(function(){

  $(document).on('click','.add-prev-emp',function(){
    console.log('#add-prev-emp');
    var html = '<div class="form-group" class ="previous_expri_div">\
                    <div class="col-md-12 text-center page-header">\
                      <h4 class="light">Previous Employment Details</h4>\
                      </div>\
                  </div>\
                  <div class="form-group">\
                    <div class="col-md-9 text-right">\
                      <h4 class="light"> <a class ="previous_expri" >Remove</a></h4>\
                      </div>\
                  </div>\
                  <div class="form-group">\
                    <label class="col-md-5 control-label" for="textinput">Previous Company Name</label>\
                    <div class="col-md-7">\
                    <input id="textinput" name="textinput" type="text" placeholder="Company Name" class="form-control input-md" required="">\
                    </div>\
                  </div>\
                </div>\
                <div class="form-group">\
                    <label class="col-md-5 control-label" for="employee_exp_year">Period</label>  \
                    <div class="date_from_to">\
                      <input  class=" form-control input-md" type="text" placeholder="From" name ="employee_current_from_date"  id="fromdate">\
                    </div>\
                    <div class="date_from_to">\
                      <input  class=" form-control input-md" type="text" placeholder="To"  name ="employee_current_to_date" id="todate">\
                    </div>\
                  </div>\
                  </div>';
    $( html ).insertBefore($(this));
  });

});

</script>

<script>
function add_master_education()
{
  $('#add_master').toggleClass('glyphicon-plus').toggleClass('glyphicon-minus');
  $('#master_education').toggle();
}
function employee_validation()
{
//alert($('#id').val());
  if( $('#id').val() >0)
  {    
    //return true;
  }
  else
  {


  var password=$('#employee_password').val();
  var confirm_password=$('#employee_conf_password').val();
  var email_available_flag=$('#email_available_flag').val();
  if(password!=confirm_password)
  {
    $('#employee_conf_password').next('.errorBox').html('Password not match').show();
    return false ;
  }
  
  if(!$('#terms').is(":checked"))
  {
    alert('Please check terms and conditions');
    return false ;
  }
  if(email_available_flag=='0')
  {
    $('#verify_email').html('Email id already exists!');
    return false ;
  }
}
      $.ajax({
        url: gBaseUrl+'/employee/add_update/',
        type: 'POST',
        data:$('#employee-add-form').serialize(),
        dataType: 'json',
        success: function(response){
          if(response.status == 'ok')
          {             
             //window.location=response.data;
            $('.alert-success').html(response.msg).show();

             setTimeout(function(){
              // $('.alert-danger').html(response.msg);
              $('.alert-success').hide();
              //$('.input-lg').removeClass('input-alert');
            }, 3000);

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
          window.scrollTo( 0, 0 );
        },
        error: function(res){
        }
      });
      $(document).scrollTop()
      return false;
    //}
    //}




}

function verify_employee_email(element,email)
{
  var ajax_url=base_url+'employee/verify_employee_email';
  $('#email_available_flag').val('0');
  if(email!='')
  {
      var datObj={
          email:email
      }
      $.ajax({
          url: ajax_url,
          data: datObj,
          dataType:'json',
          method: 'POST',
          success: function(response){
                if(response.status=='ok')
                {
                  $('#email_available_flag').val('1');
                  $('#verify_email').html('').hide();
                }else if(response.status=='err') 
                {
                  element.value='';
                  $('#verify_email').html('Email id already exists!').show();
                  $('#email_available_flag').val('0');
                }else
                {
                  element.value='';
                  $('#verify_email').html('Please give valid email id!').show();
                  $('#email_available_flag').val('0');
                }
            }         
        });
  }
}

 $(document).ready(function () {
                
                $('#fromdate,#todate').datepicker({
                    format: "mm/dd/yyyy"
                });  
            
            });

 $(document).ready(function(){

  $('#employee_skills').tagsinput({
    maxTags: 5
  });




      $(".previous_expri").click(function(event) {
    event.preventDefault();
    alert("inside");
       $(this).closest('.li').remove();
});

});



 $(document).on("click", ".previous_expri", function() {
//   console.log("inside";   <-- here it is
    console.log("inside");
    //alert("inside");
    $(this).closest('.li').remove();
 });


  </script>
  </body>
</html>
