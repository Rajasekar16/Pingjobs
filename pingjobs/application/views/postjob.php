<?php echo $header; ?>
    <!-- Begin page content -->
    <!-- Tag select reference http://timschlechter.github.io/bootstrap-tagsinput/examples/ -->
<?php 
$job_data = array();
if(!empty($job))
{
	$job_data  =$job[0];//print_r($job_data);
	$submit_text = "Update Job";
	$mode = "update";
	$editId = $job_data['id'];
}
else
{
	if(!empty($employer))
	{
		$employer= $employer[0];
		$job_data['job_company_name'] =$employer['company_name']; 
		$job_data['about_company'] =$employer['website']; 
		$job_data['job_company_name'] =$employer['company_name']; 
	}
	$mode = "create";
	$submit_text = "Post Job";
	$editId = 0;
}
?>
<div class="container container-home"> <!-- class="signup-forms" -->
	<div class="row">
		<div class="col-md-12 box">
			<h2 class="light page-header">Post Job</h2>
			<?php
			echo form_open('javascript:;',array('class'=>"form-horizontal","id"=>"postJob","onsubmit"=>"return postjob();"));
			?>
				<div class="alert alert-danger" style="display:none">
					<strong>Error!</strong> The email/username and password you entered don't match .
				</div>
				<div class="alert alert-success" style="display:none">
					<strong>Error!</strong> The email/username and password you entered don't match .
				</div>
				<?php echo $this->session->flashdata('msg'); ?>
				<div class="col-md-6">

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-5 control-label" for="job_type_id">
					Job Type
				</label>
				<div class="col-md-7">
					<select name="job_type_id" id="job_type_id" class="form-control">
			  <?php foreach($job_type as $row) {?>
					<option value="<?php echo $row['id'];?>" <?php echo ((!isset($job_data['job_type_id']) && $row['id'] == 1) || $row['id'] == @$job_data['job_type_id']) ? 'selected':''; ?> >
						<?php echo ucfirst($row['name']);?>
					</option>
			  <?php } ?>
					</select>
				 </div>
			</div>
			<!-- Select Employer -->
			  <div class="form-group required">
				<label class="col-md-5 control-label" for="selectbasic">Employer</label>
				<div class="col-md-7">
				  <select id="employer_id" name="employer_id" class="form-control" required>
					<option value="" >--Select--</option>
					<?php foreach($employers as $row) { ?> 
						<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['employer_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['company_name']);?></option>
					  <?php } ?>
				  </select>
				</div>
			  </div>
			  

			  <div class="form-group required">
				<label class="col-md-5 control-label" for="textinput">Job title</label>  
				<div class="col-md-7">
				<input id="job_title" name="job_title" type="text"  placeholder="Enter Job Title" class="form-control input-md" required="required" value="<?php echo @$job_data['job_title'] ?>"  required>                      
				</div>
			  </div>

			  <!-- Text input-->
			  <div class="form-group required">
				<label class="col-md-5 control-label" for="textinput">Job Description</label>  
				<div class="col-md-7">
				<textarea class="form-control input-md" maxlength="1000" placeholder="Enter Job Description" id="job_desc" name="job_desc" required><?php echo @$job_data['job_desc'] ?></textarea>
				  
				</div>
			  </div>                  

			  <!-- Select Basic -->
			  <div class="form-group">
				<label class="col-md-5 control-label" for="selectbasic">Job Industry</label>
				<div class="col-md-7">
				  <select id="job_industry_id" name="job_industry_id" class="form-control">
					<?php 
			  foreach($industry as $row)
			  {
				?> 
				<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['job_industry_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
			  <?php } ?>

				  </select>
				</div>
			  </div>
			  
			  
			  <!-- Select Basic -->
			  <div class="form-group">
				<label class="col-md-5 control-label" for="selectbasic">Functional</label>
				<div class="col-md-7">
				  <select id="job_functional_id" name="job_functional_id" class="form-control">
					  <?php 
				  foreach($functional as $row)
				  {?> 
				<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['job_functional_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
			  <?php } ?>

				  </select>
				</div>
			  </div>
			  
			  <!-- Text input-->
			  <div class="form-group required">
				<label class="col-md-5 control-label" for="keyskills">Key Skills</label>  
				<div class="col-md-7">
					<select id="job_key_skill" name="job_key_skill[]" class="form-control chosen" data-placeholder="Key Skills" required multiple>
						<option value="" disabled>Use Ctrl key to select multiple</option>
					  <?php  foreach($skills as $row) {?> 
							<option value="<?php echo $row['id'];?>" <?php echo @(in_array($row['id'],$job_data['skills'])) ? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
					  <?php } ?>
					  </select>
				</div>
			  </div>
			  
			 <div class="form-group required">
				<label class="col-md-5 control-label" for="radios">No of Postitions</label>
				<div class="col-md-7"> 
				  <input id="job_no_postition" name="job_no_postition" type="text" placeholder="No of Postitions" class="form-control input-md number-only"  value="<?php echo @$job_data['job_no_postition']; ?>" required>
				</div>
			  </div>

		  </div>

		  <div class="col-md-6">
			  <div class="form-group required">
				<label class="col-md-5 control-label" for="selectbasic">Education</label>
				<div class="col-md-7">
				  <select id="job_education_id" name="job_education_id[]" size="5" class="form-control chosen" data-placeholder="Select qualification" multiple="multiple" required="required">
					<option value="" disabled>Use Ctrl key to select multiple</option>
					<?php foreach($education as $row) { ?> 
						<option value="<?php echo $row['id'];?>" <?php echo @(in_array($row['id'],$job_data['education'])) ? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
					<?php } ?>
				  </select>
				</div>
			  </div>

			  <div class="form-group required">
				<label class="col-md-5 control-label" for="textinput">Education Specifications</label>  
				<div class="col-md-7">
				<input id="job_education_spe" name="job_education_spe" type="text"  placeholder="Enter Education Specifications" class="form-control input-md"  value="<?php echo @$job_data['job_education_spe'] ?>" required>                      
				</div>
			  </div>


			  <!-- Text input-->
			  <div class="form-group">
				<label class="col-md-5 control-label" for="textinput">Experience</label>  
				<div class="col-md-3">
				<input id="job_experience_from" name="job_experience_from" type="text" placeholder="Min Exp" class="form-control input-md number-only"  value="<?php echo @$job_data['job_experience_from']; ?>">
				</div>
				<label class="col-md-1 control-label" for="textinput">To</label>
				<div class="col-md-3">
				<input id="job_experience_to" name="job_experience_to" type="text" placeholder="Max Exp" class="form-control input-md number-only" value="<?php echo @$job_data['job_experience_to']; ?>">
				</div>
			  </div>

			
			<!-- Text input-->
			  <div class="form-group">
				<label class="col-md-5 control-label" for="textinput">Salary (lak/anum)</label>  
				<div class="col-md-3">
					<input id="job_salary_from" name="job_salary_from" type="text" placeholder="Min Annual" class="form-control input-md number-dot-only"  value="<?php echo @$job_data['job_salary_from'] ?>">
				</div>
				<label class="col-md-1 control-label" for="textinput">To</label>
				<div class="col-md-3">
					<input id="job_salary_to" name="job_salary_to" type="text" placeholder="Max Annual" class="form-control input-md number-only"  value="<?php echo @$job_data['job_salary_to'] ?>">  
				</div>
			  </div>
			  
			  <!-- Select Basic -->
			  <div class="form-group">
				<label class="col-md-5 control-label" for="selectbasic">Gender Preference</label>
				<div class="col-md-7">
				  <select id="job_gender_id" name="job_gender_id" class="form-control">
					<option value="3" <?php echo (@$job_data['job_gender_id'] == 3)? 'selected="selected"':''; ?>>Any</option>
					<option value="1" <?php echo (@$job_data['job_gender_id'] == 1)? 'selected="selected"':''; ?>>Male</option>
					<option value="2" <?php echo (@$job_data['job_gender_id'] == 2)? 'selected="selected"':''; ?>>Female</option>
				  </select>
				</div>
			  </div>

			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-5 control-label" for="selectbasic">Country</label>
			  <div class="col-md-7">
				<select id="job_country_id" name="job_country_id" class="form-control">
				  <?php 
				  foreach($country as $row)
				  {?> 
					<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['job_country_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
				  <?php } ?>
				</select>
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-5 control-label" for="textinput">Job State</label>  
			  <div class="col-md-7">
				<select id="job_state_id" name="job_state_id" class="form-control">
				  <?php 
				  foreach($state as $row)
				  {?> 
					<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['state_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
					<?php } ?>
				</select>
			  </div>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-5 control-label" for="textinput">Job Location</label>  
			  <div class="col-md-7">
				<select id="job_location_id" name="job_location_id" class="form-control">
				  <?php 
				  foreach($location as $row)
				  {?> 
					<option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job_data['job_location_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
					<?php } ?>
				</select>
			  </div>
			</div>
			<?php if(isset($addBy)): ?>
			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-5 control-label" for="selectbasic">Job status</label>
			  <div class="col-md-7">
				<select id="job_status" name="job_status" class="form-control">
					<option value="1">Created</option>
					<option value="2">Approved</option>
					<option value="3">Expire</option>
					<option value="4">De-activated</option>
				</select>
			  </div>
			</div>
			
			<!-- Select Basic -->
			<div class="form-group">
			  <label class="col-md-5 control-label" for="selectbasic">Premium jobs</label>
			  <div class="col-md-7">
				<label class="checkbox-inline" for="checkbox-1">
					<input type="checkbox" name="premium_jobs" id="premium_jobs" value="1" <?php echo (@$job_data['premium_jobs'] == 1) ? 'checked="checked"':''?> style="position:relative;" > 
				</label>
			  </div>
			</div>
			<?php endif; ?>
		  </div>
			<?php if(!isset($addBy)): ?>
		   <div class="col-md-12">
			  <div>
				<div class="col-md-2"></div>  
				<input type="checkbox"  checked="checked" id="terms" value="2"> We agree to the <a>Terms of Use</a> &amp; <a>Privacy Policy</a>
			  </div>
		  </div>
			<?php endif; ?>

		  <div class="clearfix"></div>
		  <div class="form-group">
			<div class="col-md-12 text-center">

			   <input type="hidden" name="editId" value="<?php echo $editId ?>">
			   <input type="hidden" name="mode" id="mode" value="<?php echo $mode ?>">
			  <button  type="reset"  class="btn btn-default">Cancel</button>
			  <button type="submit" id="button2id"   class="btn btn-primary"><?php echo $submit_text ?></button>
			</div>
		  </div>
		</form>
	</div>        
  </div>
</div>
<div class="clearfix">&nbsp;</div>


<div class="modal" id="addDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Job Preview</h4>
			</div>
			<form class="form-horizontal" >
				<div class="modal-body">
					<div id="pre_about_company"></div>     
					<table class="table borderless">
						<tbody>
							<tr>
								<td width="25%">Job Description:</td>
								<td id="pre_job_desc"></td>
							</tr>
							<tr>
								<td>Experience:</td>
								<td><span id="pre_job_experience_from"> </span> - <span id="pre_job_experience_to"> </span>  Years </td>
							</tr>
							<tr>
								<td >No. of Position  :</td>
								<td id="pre_job_no_postition"></td>
							</tr>
							<tr>
								<td>Salary:</td>
								<td><span id="pre_job_salary_from"></span> - <span id="pre_job_salary_to"></span></td>
							</tr>
							<!--<tr>
								<td>Desired Profile :</td>
								<td id="desired_profile"></td>
							</tr>
							<tr>
								<td>Compensation:</td>
								<td>Not disclosed </td>
							</tr>-->
							<tr>
								<td>Industry Type:</td>
								<td id="pre_industry_name"></td>
							</tr>
							<tr>
								<td>Functional Area:</td>
								<td id="pre_functional_name"></td>
							</tr>
							<tr>
								<td>Education:</td>               
								<td id ="pre_education"></td>
							</tr>
							<tr>
								<td>Location:</td>
								<td id="pre_location_name"></td>
							</tr>
							<tr>
								<td>Key Skills:</td>
								<td id="pre_job_key_skill"></td>
							</tr>
							<tr>
								<td>Contact:</td>
								<td>HR Aster HR Solutions Pvt Ltd<!-- <span id="pre_company_name"></span> --></td>
							</tr>
							<!-- <tr>
							<td>Email:</td>
							<td>Lakhi.sharma@ust-global.com</td>
							</tr> 
							<tr>
							<td>Website:</td>
							<td>http://www.ust-global.com</td>
							</tr>-->
							<tr>
								<td>Job Posted:</td>
								<td><?php echo date('Y-m-d');?> </td>
							</tr>
						</tbody>
					</table>                  
				</div>
				<div class="modal-footer">          
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="button" onclick="postJobFrm()"  data-dismiss="modal"  class="btn btn-crm-blue" >Post</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
update_url= "<?php echo $update_url ?>";
gBaseUrl = "<?php echo base_url(); ?>";  
function reset_form()
{
	$('#postJob').trigger("reset");
}
function postjob()
{
	if($('#postJob').valid() == false)
		return false;
    if($('#terms').length && !$('#terms').is(":checked"))
    {
      alert('Please check terms and conditions');
      return false ;
    }
	if(!$('#job_key_skill').val())
    {
      alert('Please add aleast one key skills');
      return false ;
    }
    if($('#job_salary_from').val() || $('#job_salary_to').val())
    {
    	if(!$('#job_salary_from').val())
        {
          alert('Please enter minimum annual salary');
          return false ;
        }
        if(!$('#job_salary_to').val())
        {
            alert('Please enter maximum annual salary');
            return false ;
        }
    }
	if($('#job_experience_from').val() || $('#job_experience_to').val())
    {
    	if(!$('#job_experience_from').val())
        {
          alert('Please enter minimum job experience');
          return false ;
        }
        if(!$('#job_experience_to').val())
        {
            alert('Please enter maximum job experience');
            return false ;
        }
    }
    $('#pre_job_desc').html($('#job_desc').val());
    $('#pre_job_experience_from').html($('#job_experience_from').val()|0);
    $('#pre_job_experience_to').html($('#job_experience_to').val());
    $('#pre_job_no_postition').html($('#job_no_postition').val());
    $('#pre_job_salary_from').html($('#job_salary_from').val());
    $('#pre_job_salary_to').html($('#job_salary_to').val());
    $('#pre_industry_name').html($('#job_industry_id option:selected').text());
    $('#pre_functional_name').html($('#job_functional_id option:selected').text());
    $('#pre_location_name').html($('#job_location_id option:selected').text());
    $('#pre_education').html($('#job_education_id option:selected').text()+'-'+$('#job_education_spe').val());
    $('#pre_job_key_skill').html($('#job_key_skill').val());
    $('#pre_company_name').html($('#company_name').val());
    $('#pre_about_company').html($('#about_company').val());
   $('#addDialog').modal({'backdrop':'static'}).modal('show');
   return false ;      
}

function postJobFrm()
{
	if($('#postJob').valid() == false)
		return false;
	$.ajax({
	url: update_url,
	type: 'POST',
	data:$('#postJob').serialize(),
	dataType: 'json',
	success: function(response){
	  if(response.status == 'ok')
	  {             
		 //window.location=response.data;
		 $('#postJob').trigger("reset");
		 $('.alert-success').html(response.msg).show();

		 /* setTimeout(function(){
		  // $('.alert-danger').html(response.msg);
		  $('.alert-success').hide();
		  $('.input-lg').removeClass('input-alert');
		}, 3000);*/
	  }
	  else
	  {
		$('.alert-danger').html(response.msg).show();
		//$('.input-lg').addClass('input-alert');

		/*setTimeout(function(){
		  // $('.alert-danger').html(response.msg);
		  $('.alert-danger').hide();
		  $('.input-lg').removeClass('input-alert');
		}, 3000);*/
	  }

	},
	error: function(res){
	}
  });
}
function job_validation()
{
   
}
</script>

<?php echo $footer; ?>