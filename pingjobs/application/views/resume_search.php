<?php echo $header; ?>
<link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
    <!-- Begin page content -->

      <div class="container pad-top-0">
      <div class="col-md-6">
        <div class="page-header">
        <h3 class="light">Search Candidate</h3>
        </div>
      </div>
      <div class="">
        <div class="col-md-6 pad-top-10">
        <div class="navbar-collapse collapse">
          <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
          <ul class="nav navbar-nav navbar-right">
                <li><a  data-toggle="modal" data-target="#addDialog"><i class="glyphicon glyphicon-search"></i> Search</a></li>
                <li><a onclick="" class=""><i class="glyphicon glyphicon-envelope"></i> Send Resume</a></li>
          </ul>
          <div class="clearfix"></div>
        </div> 
      </div>       
      </div>
<table class="table table-striped" >
          <thead id="master_table_header">
          </thead>
          <tbody id="master_table_data"> 
          <?php
          if(!empty($list))
          {
          ?>
         <tr>
           <td colspan="13">
             <p class="text-center">
               <svg class="spinner" width="48px" height="48px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">\
                 <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>\
              </svg>
              <div class="text-center">Please wait..</div>
             </p>
           </td>
         </tr>
         <?php
          }else{
            ?>
            <tr>
               <td colspan="10"><p class="text-center">No record found!</p></td>
               </tr>
            <?php
          }
          ?>
        </tbody>
        </table>
      <div>
       
      </div>
    </div>


    

<div class="modal " id="addDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Search</h4>
      </div>
     <form class="form-horizontal" method="POST" action="<?php echo base_url(); ?>employer/resume_search/<?php echo $type; ?>">
        <div class="modal-body">

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Skills</label>  
              <div class="col-md-6">
                <input id="skills" name="skills" type="text" placeholder="Enter Skill" class="form-control input-md">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Experience</label>  
              <div class="col-md-2">
                <input id="exp_from" name="exp_from" type="text" placeholder="Min" class="form-control input-md">              
              </div>
              <div class="col-md-2">
              <label class="col-md-1 control-label" for="name">To </label>  
              </div>
              <div class="col-md-2">
                <input id="exp_to" name="exp_to" type="text" placeholder="Max" class="form-control input-md">              
              </div>
            </div>


            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Salary</label>  
              <div class="col-md-2">
                <input id="salary_from" name="salary_from" type="text" placeholder="Min" class="form-control input-md">              
              </div>
              <div class="col-md-2">
              <label class="col-md-1 control-label" for="name">To </label>  
              </div>
              <div class="col-md-2">
                <input id="salary_to" name="salary_to" type="text" placeholder="Max" class="form-control input-md">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Current Location</label>  
              <div class="col-md-6">
                <input id="location" name="location" type="text" placeholder="Enter Location" class="form-control input-md">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Current Education</label>  
              <div class="col-md-6">
               <select id="education" name="education" class="form-control">
                <option value="0">Select Education</option>
                      <?php 
                      foreach($education as $row)
                      {?> 
                    <option value="<?php echo $row['id'];?>" <?php echo ($row['id'] == @$job[0]['job_location_id'])? 'selected="selected"':''; ?>><?php echo ucfirst($row['name']);?></option>
                  <?php } ?>

                    </select>         
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Notice Period <small>(in days)</small></label>  
              <div class="col-md-6">
                <input id="notice" name="notice" type="text" placeholder="Enter Notice" class="form-control input-md">              
              </div>
            </div>

          
        </div>

       <div class="modal-footer">
        <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
        <button type="submit" name="search" class="btn btn-crm-blue">Search</button>
        </div>
    </form>
    </div>

  </div>
</div>


<?php echo $footer; ?>


<script type="text/javascript">



  gData=JSON.parse('<?php echo $list; ?>');
  draw_employee_search_header();
  draw_employee_search();  

  $(document).ready(function(){
  $('#skills').tagsinput({
    maxTags: 5
  });

});
</script>

  </body>
</html>
