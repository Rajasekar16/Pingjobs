<?php
echo $header;

@$employer =@$employer[0];
$id=@$employer['id']; 
$email=@$employer['email']; 
$password=@$employer['password']; 
$company_name=@$employer['company_name']; 
$company_type=@$employer['company_type']; 
$company_employes=@$employer['company_employes']; 
$industry=@$employer['industry']; 
$website=@$employer['website']; 
$address=@$employer['address']; 
$state=@$employer['state']; 
$city=@$employer['city']; 
$pincode=@$employer['pincode']; 
$contact_no=@$employer['contact_no']; 
$contact_person=@$employer['contact_person']; 
$status=@$employer['status']; 
$created_date=@$employer['created_date'];
$about_company=@$employer['about_company'];
$premium_employer=@$employer['premium_employer'];
$logo=@$employer['logo'];
?>
<!-- Begin page content -->
<div class="container container-home">
	<div class="row">
		<div class="col-md-12 box">
			<h2 class="light page-header">
				<?php if($id !=0){ ?>
				Update Employer
				<?php } elseif(isset($addBy) && $addBy == "admin"){ ?>
				Add Employer
				<?php }else { ?>
				Employer Signup
				<?php } ?>
			</h2>
			<?php
			$action = "";
			if(isset($addBy) && $addBy == "admin")
				$action = "admin/create_employee";
			else
				$action = "employer/add_update";
			echo form_open_multipart($action,array('class'=>"form-horizontal","id"=>"add_employee","onsubmit"=>"return employer_validation();"));
			?>
				<?php echo $this->session->flashdata('msg'); ?>
				<!-----CUSTOM MESSAGE START------>
				<?php echo validation_errors(); ?>
				<!-----CUSTOM MESSAGE END------>
				<input type="hidden" id ="id" name ="id" value ="<?php  echo $id; ?>"/>
				<div class="col-md-6">
					<?php if(isset($company_type_array)): ?>
					<!-- Multiple Radios (inline) -->
					<div class="form-group">
						<label class="col-md-5 control-label" for="company_type">Company Type</label>
						<div class="col-md-7">
							<?php foreach($company_type_array AS $index=>$company_types){ ?>
							<label class="radio-inline" for="radios-<?php echo $company_types['id']; ?>">
								<input type="radio" name="company_type" id="company_type_<?php echo $company_types['id']; ?>" value="<?php echo $company_types['id']; ?>"  <?php  echo ($company_types['id'] == $company_type || ($company_type == 0 && $index==0)) ? 'checked="checked"':''?> > <?php echo $company_types['name']; ?>
							</label>
							<?php } ?>
						</div>
					</div>
					<?php endif; ?>

					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="contact_person">Contact Person</label>  
						<div class="col-md-7">
							<input id="contact_person" name="contact_person" type="text" placeholder="Enter Contact Person" class="form-control input-md "   value ="<?php  echo $contact_person ?>" required />
						</div>
					</div>

					
						<!-- Text input-->
						<div class="form-group required">
							<label class="col-md-5 control-label " for="email">Email</label>  
							<div class="col-md-7">
								<input id="email" name="email" type="email" onblur="verify_employer_email(this, this.value)" placeholder="Enter Email Address" class="form-control input-md" required="required" <?php if ($id > 0) echo "disabled value='".$email."'"; ?>  />
								<div id="verify_email" class="errorBox" ></div>
								<input type="hidden" id="email_available_flag" value="0" />
							</div>
						</div>
					<?php if ($id ==0) {?> 
						<!-- Text input-->
						<div class="form-group required">
							<label class="col-md-5 control-label " for="password">Password</label>  
							<div class="col-md-7">
								<input id="password" name="password" type="password" placeholder="Enter Password" class="form-control input-md" required="required" minlength="6" />
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group required">
							<label class="col-md-5 control-label" for="conf_password">Confrm Password</label>  
							<div class="col-md-7">
								<input id="conf_password" name="conf_password" type="password" placeholder="Re enter Password" class="form-control input-md" required="required" minlength="6" />
								<div class="errorBox"></div>
							</div>
						</div>
					<?php } ?>

					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="company_name">Company Name</label>  
						<div class="col-md-7">
							<input id="company_name" name="company_name" type="text" placeholder="Enter Company Name" class="form-control input-md" value ="<?php  echo $company_name ?>" required />
						</div>
					</div>

					<!-- Select Basic -->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="industry">Industry</label>
						<div class="col-md-7">
							<select id="industry" name="industry" class="form-control" required>
								<!--<option value="">Select Industry</option>-->
								<?php
								foreach($industry_array as $row)
								{
									$selected ="";
									if($industry == $row['id'])
									{
										$selected ="selected";
									} ?>
									<option <?php echo $selected ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="conatact_no">Contact Number</label>  
						<div class="col-md-7">
							<input id="contact_no" name="contact_no" type="text" pattern="[789][0-9]{9}" minlength="6" maxlength="10"  title="Phone number  start with 7-9 and remaing 9 digit with 0-9"  placeholder="Enter Contact Number" class="form-control input-md number-only" required="" value ="<?php  echo $contact_no ?>" >
							<div class="errorBox"></div>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-5 control-label" for="conatact_no">Company Logo</label>  
						<div class="col-md-7">
							<input id="company_logo" name="company_logo" type="file" accept="image/*" placeholder="Company Logo" class="form-control input-md hide" size="20" />
							<h4>
								<a id="uploadLogoTrigger" class="btn btn-danger btn-action" data-toggle="tooltip" data-placement="right" data-title="Upload logo">
									Upload
								</a>&nbsp;
	                    		<span class='label label-info' id="logoName"><?php echo (@$logo=='') ? 'No logo uploaded' : ''; ?></span>
							</h4>
							<div class="errorBox"><?php echo @$fileUploadError; ?></div>
						</div>
					</div>
					<?php
					if(@$logo!='')
					{
					?>
						<div class="form-group">
							<label class="col-md-5 control-label" for="conatact_no"></label>
							<div class="col-md-7">
								<img src="<?php echo base_url();?>upload/logo/<?php echo $logo;?>" alt='Company logo' class="img-rounded" width="100" />
							</div>
						</div>
					<?php
					}
							
					?>
				</div>
				<div class="col-md-6">
					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="company_employes">No of employee</label>  
						<div class="col-md-7">
							<input id="company_employes" name="company_employes" maxlength="6" type="text" placeholder="No of employee" class="form-control input-md number-only"  value ="<?php  echo $company_employes ?>" required  >
							<div class="errorBox"></div>
						</div>
					</div>
					
					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="address">Address</label>  
						<div class="col-md-7">
							<input id="address" name="address" type="text" placeholder="Enter Address" class="form-control input-md"   value ="<?php  echo $address ?>"  required />
						</div>
					</div>

					<!-- Select Basic -->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="state">State</label>
						<div class="col-md-7">
							<select id="state" name="state" class="form-control" required>
								<option value="">Select State</option>
								<?php 
								foreach($state_array as $row)
								{
									$selected ="";
									if($state == $row['id'])
									{
										$selected ="selected";
									} ?>
									<option  <?php echo $selected; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="city">City</label>  
						<div class="col-md-7">
							<select id="city" name="city" class="form-control" required>
								<option value="">Select City</option>
								<?php 
								foreach($location_array as $row)
								{
									$selected ="";
									if($city == $row['id'])
									{
										$selected ="selected";
									} ?>
									<option  <?php echo $selected; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>

					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="pincode">Pincode</label>  
						<div class="col-md-7">
							<input id="pincode" name="pincode" minlength="6" maxlength="6" type="text" placeholder="Enter Pincode" class="form-control input-md number-only"  value ="<?php  echo $pincode ?>" required  >
							<div class="errorBox"></div>
						</div>
					</div>

					<!-- Text input-->
					<?php if(isset($addBy)): ?>
					<div class="form-group">
						<label class="col-md-5 control-label" for="status">Status</label>  
						<div class="col-md-7">
							<select name="status" id="status" class="form-control" required>
								<option value="0" <?php if($status === "0") echo 'selected'; ?> >Waiting</option>
								<option value="2" <?php if($status === "2") echo 'selected'; ?> >Approve</option>
								<option value="1" <?php if($status == "" || $status === "1") echo 'selected'; ?> >Approved</option>
								<option value="3" <?php if($status === "3") echo 'selected'; ?> >De-activate</option>
							</select>
						</div>
					</div>
					<?php endif; ?>
					
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-5 control-label" for="textinput">Website</label>  
						<div class="col-md-7">
							<input id="website" name="website" type="text" placeholder="Enter Website URL" class="form-control input-md"  value ="<?php  echo $website ?>" >
						</div>
					</div>
					
					<!-- Text input-->
					<div class="form-group required">
						<label class="col-md-5 control-label" for="about_company">About Company</label>  
						<div class="col-md-7">
							<textarea id="about_company" name="about_company" class="form-control" required><?php  echo $about_company; ?></textarea>
						</div>
					</div>
					
					<?php if(isset($addBy)){ ?>
					<!-- Select Basic -->
					<div class="form-group">
					  <label class="col-md-5 control-label" for="selectbasic">Premium Employer</label>
					  <div class="col-md-7">
						<label class="checkbox-inline" for="checkbox-1">
							<input type="checkbox" name="premium_employer" id="premium_employer" value="1" <?php echo (@$premium_employer == 1) ? 'checked="checked"':''?> style="position:relative;" > 
						</label>
					  </div>
					</div>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				
				<?php if($id ==0 && !isset($addBy)){ ?>
				<div class="col-md-12">
					<div>
						<div class="col-md-2"></div>  
						<input type="checkbox"  id="terms" value="2"> We agree to the <a>Terms of Use</a> & <a>Privacy Policy</a>
					</div>
				</div>
				<?php } ?>
				<div class="clearfix"></div>
				<div class="form-group">
					<div class="col-md-12 text-center">
						<input type="hidden" name="mode" id="mode" value="<?php echo ($id == 0)?'create':'edit'; ?>">
						<button type="submit" id="button2id" class="btn btn-primary">
							<?php 
							if($id ==0 && isset($addBy) && $addBy == "admin")
								echo 'Add employer';
							elseif($id == 0)
								echo 'Sign Up Now';
							else
								echo 'Update Profile';
							?>
						</button>
						<button id="resetBtn" type="reset" class="btn btn-default">Reset</button>&nbsp;&nbsp;
						<?php if(@$this->session->userdata['loggedin_admin']): ?>
						<a href="<?php echo base_url();?>/admin/employer"  >Back</a>&nbsp;&nbsp;
						<?php endif; ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>

<script>
$(function(){
	$("#uploadLogoTrigger").click(function(){
		$('#company_logo').trigger('click');
	});
	$('#company_logo').change(function(){
		$('#logoName').text(this.files[0].name);
	});
	$('#resetBtn').click(function(){
		$('#logoName').text('<?php echo (@$logo=='') ? 'No logo uploaded' : '' ?>');
	});
})();

function verify_employer_email(element,email)
{
	if($("#email").valid() == false)
		return false;
		
	var ajax_url=base_url+'employer/verify_employer_email';
	$('#email_available_flag').val('0');
	
	if(email!='')
	{
		$.ajax({
			url		: ajax_url,
			data	: { email:email },
			dataType:'json',
			method	: 'POST',
			success	: function(response){
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

function employer_validation()
{
	//validate the forms
	if($("#add_employee").valid() == false)
		return false;
		
	//User id already exists
	if( $('#id').val() >0)
	{
		return true;
	}
	
	//Email ID already exists check
	var email_available_flag=$('#email_available_flag').val();
	if(email_available_flag=='0')
	{
		$('#verify_email').html('Email id already exists!');
		return false ;
	}
	
	//Password check
	var password=$('#password').val();
	var confirm_password=$('#conf_password').val();
	if(password || confirm_password)
	{
		if(password!=confirm_password)
		{
			$('#conf_password').next('.errorBox').html('Password not match').show();
			return false ;
		}
	}
	
	//Accept the terms and condition when the terms exists
	if($('#terms').length && !$('#terms').is(":checked"))
	{
		alert('Please check terms and conditions');
		return false ;
	}
	return true;
}
</script>
<?php echo $footer; ?>