<?php echo $header; ?>
<link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
    <!-- Begin page content -->
    <div class="container pad-top-0">
      <div class="page-header">
        <h2 class="light">Jobs</h2>
      </div>
      <div class="">
        <div class="navbar-collapse collapse">
      <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
     <ul class="nav navbar-nav navbar-left">
      <li>
        <a>
            <label class="control-label" for="textinput">Filter: </label>
            <select id="sa" onchange="filterData('job_status',this.value,0,draw_admin_jobs_grid)">
              <option value="">All</option>
              <option value="1">Created</option>
              <option value="2">Approved</option>
              <option value="4">Expired</option>
            </select>
        </a>
      </li>
     </ul>
          <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url();?>/admin/postjob/" ><i class="glyphicon glyphicon-envelope"></i> Post jobs</a></li>
                <li><a onclick="job_approve()" ><i class="glyphicon glyphicon-ok"></i> Approve</a></li>
                <li><a onclick="common_delete(8)" ><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
          </ul>
          <div class="clearfix"></div>
        </div>        
      </div>

      <div>
        <table class="table table-striped">
         <thead id="master_table_header">
         <!-- companies header-->
         </thead>
         <tbody id="master_table_data"> 
         <!-- companies Data Grid-->
         <?php
          if(!empty($jobs))
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
               <td colspan="10"><p class="text-center">No jobs found!</p></td>
               </tr>
            <?php
          }
          ?>
         </tbody>
     </table>
      </div>
    </div>
<script type="text/javascript">
  gData=JSON.parse('<?php echo $jobs; ?>');
  draw_admin_jobs_header();
  draw_admin_jobs_grid();
</script>
<?php echo $footer; ?>
  </body>
</html>
