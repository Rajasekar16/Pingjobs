<?php echo $header; ?>
    <!-- Begin page content -->


    <div class="row">
      <div class="col-md-6">
        <div class="page-header">
        <h3 class="light">Functional Management</h3>
        </div>
      </div>
      <div class="col-md-6 pad-top-10">
        <div class="navbar-collapse collapse">
          <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
          <ul class="nav navbar-nav navbar-right">
                <li><a  data-toggle="modal" data-target="#addDialog"><i class="glyphicon glyphicon-plus"></i> Add Functional</a></li>
                <li><a onclick="common_delete(2)" ><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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

<?php echo $footer; ?>

<div class="modal" id="addDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manage Functional</h4>
      </div>
      <?php
	  echo form_open('admin/add_update',array('class'=>"form-horizontal"));
	  ?>
        <div class="modal-body">          
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Name</label>  
              <div class="col-md-6">
                <input id="name" name="name" type="text" placeholder="Enter Name" class="form-control input-md" required="required">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="status">Status</label>  
              <div class="col-md-6">
                <select id="status" name="status" class="form-control input-md" required="required">
                  <option value=''>Select Status</option>
                  <option value='1'>Active</option>
                  <option value='2'>Inactive</option>
                </select>             
              </div>
            </div>            
        </div>

       <div class="modal-footer">
          <input type="hidden" name="mode" id="mode" value="create" />
          <input type="hidden" name="tableId" id="tableId" value="2" />
          <input type="hidden" name="editId" id="editId" value="" />
          <input type="hidden" name="redirect_url" id="redirect_url" value="admin/functional" />
          <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
          <button type="submit" class="btn btn-crm-blue">Save</button>
        </div>
    </form>
    </div>

  </div>
</div>

<script type="text/javascript">
  gData=JSON.parse('<?php echo $list; ?>');
  draw_functional_master_header();
  draw_functional_master();  
</script>

  </body>
</html>
