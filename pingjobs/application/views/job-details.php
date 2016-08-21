<?php echo $header; ?>
    <!-- Begin page content -->
    <!-- Tag select reference http://timschlechter.github.io/bootstrap-tagsinput/examples/ -->
       
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-12 box">
          <h2 class="light page-header">Job Details</h2>
              <div class="col-md-12">
                  <div class="col-md-12 text-center job-detail-but">
                    <input type="hidden" value="<?php echo $data['id'];?>" id="job_id" name="job_id">
                    <input type="hidden" value="<?php echo $user_id ; ?>" id="user_id" name="user_id">
                    <?php
                    if($user_id!='')
                    { if($already_applied){ ?>       
                      <button type="button" id=""   onclick=""  class="btn btn-primary apply_job">Applied</button> &nbsp;&nbsp;&nbsp;
                        <?php }else{?>
                      <button type="button" id=""   onclick="apply_job()"  class="btn btn-primary apply_job">Apply</button> &nbsp;&nbsp;&nbsp;
                      <?php } ?>
                    <?php }else{?>
                   

                      <button data-toggle="modal" data-target="#employeelogin"  class="btn btn-primary">Login to Apply</button> &nbsp;&nbsp;&nbsp;
                    
                    <?php } ?>
                  </div>
              </div>
              <div class="col-md-12">
                <p><?php echo $data['about_company'];?></p>
                <table class="table borderless">
                  <tbody>
                    <tr>
                      <td>Job Description:</td>
                      <td><?php echo $data['job_desc'];?></td>
                    </tr>
                    <tr>
                      <td>Experience:</td>
                      <td><?php echo $data['job_experience_from'];?> - <?php echo $data['job_experience_to'];?> Years </td>
                    </tr>
                    <tr>
                      <td width="20%">No. of Position  :</td>
                      <td width="80%"> <?php echo $data['job_no_postition'];?>  </td>
                    </tr>
                    <tr>
                      <td>Salary:</td>
                      <td><?php echo $data['job_salary_from'] .' - '. $data['job_salary_to'] .'laks';?></td>
                    </tr>
                    <tr>
                      <td>Desired Profile :</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Industry Type:</td>
                      <td><?php echo $data['industry_name'];?></td>
                    </tr>
                    <!-- <tr>
                      <td>Role:</td>
                      <td><?php //echo $data['functional_name'];?> </td>
                    </tr> -->
                    <tr>
                      <td>Functional Area:</td>
                      <td><?php echo $data['functional_name'];?> </td>
                    </tr>
                    <tr>
                      <td>Education:</td>
                      <td>  <?php echo $data['education_name'];?> -  <?php echo $data['job_education_spe'];?>   
                      </td>
                    </tr>
                    <tr>
                      <td>Compensation:</td>
                      <td>Not disclosed </td>
                    </tr>
                    <tr>
                      <td>Location:</td>
                      <td><?php echo $data['location_name'];?> </td>
                    </tr>
                    <tr>
                      <td>Key Skills:</td>
                      <td><?php echo $data['job_key_skill'];?></td>
                    </tr>
                    <tr>
                      <td>Contact:</td>
                      <td><?php echo $data['company_name'];?> </td>
                    </tr>
                   <!--  <tr>
                      <td>Email:</td>
                      <td><?php echo $data['employer_email'];?></td>
                    </tr> -->
                    <tr>
                      <td>Website:</td>
                      <td><?php echo $data['employer_website'];?></td>
                    </tr>
                    <tr>
                      <td>Job Posted:</td>
                      <td><?php echo $data['post_date'];?> </td>
                    </tr>
                  </tbody>
                </table>
                <div class="col-md-12">
                  <div class="col-md-12 text-center job-detail-but">
                      <?php
                    if($user_id!='')
                    { 
                      if($already_applied){ ?>       
                      <button type="button" id=""   onclick=""  class="btn btn-primary apply_job">Applied</button> &nbsp;&nbsp;&nbsp;
                        <?php }else{?>
                      <button type="button" id=""   onclick="apply_job()"  class="btn btn-primary apply_job">Apply</button> &nbsp;&nbsp;&nbsp;
                      <?php } ?>
                    <?php }else{?>
                      <button type="submit" data-toggle="modal" data-target="#employerlogin"  class="btn btn-primary">Login to Apply</button> &nbsp;&nbsp;&nbsp;
                      
                    <?php } ?>
                  </div>
              </div>
              </div>
        </div>
        </div>
        
      </div>
    </div>

<?php echo $footer; ?>
<script type="text/javascript">

function job_validation()
{  
  if(!$('#terms').is(":checked"))
  {
    alert('Please check terms and conditions');
    return false ;
  } 
}




$(document).ready(function(){

  $('#keyskills').tagsinput({
    maxTags: 5
  });

});

</script>

  </body>
</html>
