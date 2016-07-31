<?php echo $header; ?>
    <!-- Begin page content -->
    
    <div class="row">
      <div class="col-md-6">
        <div class="page-header">
        <h3 class="light">Applied Jobs</h3>
        </div>
      </div>
      <div class="col-md-6 pad-top-10">
        <div class="navbar-collapse collapse">
          <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
          <ul class="nav navbar-nav navbar-right">
                <!-- <li><a  data-toggle="modal" data-target="#addDialog"><i class="glyphicon glyphicon-plus"></i> Add Location</a></li> -->
                <li><a onclick="common_delete(9)" ><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
          </ul>
          <div class="clearfix"></div>
        </div> 
      </div>
    </div>

      <div>
        <table class="table table-striped">
          <thead id="master_table_header">
          </thead>
          <tbody id="master_table_data"> 
          <?php
          if(!empty($list))
          {
          ?>
         <tr>
           <td colspan="10">
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
      </div>
    </div>

<?php echo $footer; ?>


<script type="text/javascript">
  gData=JSON.parse('<?php echo $list; ?>');
  draw_applied_job_approve_header();
  draw_applied_job_approve();  
</script>

  </body>
</html>
