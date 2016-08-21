<?php echo $header; ?>
    <!-- Begin page content -->
    <div class="container container-home signup-forms">
      <h2 class="light page-header">Reset Password</h2>
      <div class="row">
        <!--<div class="col-md-2">
           <img src="<?php echo base_url();?>images/logo.png" />
        </div>-->
        <div class="col-md-12 box">
            <!-- <form class="form-horizontal" method="post" action="/employee/reset_password"> -->
	            <?php
	            echo form_open("employee/reset_password",array("class"=>"form-horizontal")); 
	            if($this->session->flashdata('msg')){
	            	echo $this->session->flashdata("msg");
	            }
	            ?>
				<div class="col-md-2"></div>
				<div class="col-md-6">
					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label " for="email">Email</label>
						<div class="col-md-7">
							<input id="email" name="email" type="email"
								onblur="verify_employer_email(this, this.value)"
								placeholder="Enter Email Address" class="form-control input-md"
								required="required">
							<div id="verify_email" class="errorBox"></div>
							<input type="hidden" id="email_available_flag" value="0" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-5 control-label " for="email"></label>
						<div class="col-md-7">
							<button type="submit" id="" name="reset" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</form>
        </div>        
      </div>
    </div>
<?php echo $footer; ?>
  </body>

</html>
