 <?php echo $header; ?>
    <!-- Begin page content -->

    <div class="row">
      <div class="col-md-6">
        <div class="page-header">
        <h3 class="light">State Management</h3>
        </div>
      </div>
      <div class="col-md-6 pad-top-10">
        <div class="navbar-collapse collapse">
          <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
          <ul class="nav navbar-nav navbar-right">
                <li><a  data-toggle="modal" data-target="#addDialog"><i class="glyphicon glyphicon-plus"></i> Add State</a></li>
                <li><a onclick="common_delete(4)" ><i class="glyphicon glyphicon-trash"></i> Delete</a></li>
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

<div class="modal" id="addDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Manage States</h4>
      </div>
      <?php
	  echo form_open('admin/add_update',array('class'=>"form-horizontal"));
	  ?>
        <div class="modal-body">
			<div class="form-group required">
              <label class="col-md-4 control-label" for="name">Country</label>  
              <div class="col-md-6">
                <select id="country_id" name="country_id" class="form-control input-md" required="required">
                	<option value="">--Select Country--</option>
                	<?php foreach ($country as $countries) :?>
                	<option value="<?php echo $countries['id']; ?>"><?php echo $countries['name']; ?></option>
                	<?php endforeach;?>
                </select>              
              </div>
            </div>
            
            <div class="form-group required">
              <label class="col-md-4 control-label" for="name">Name</label>  
              <div class="col-md-6">
                <input id="name" name="name" type="text" placeholder="Enter Name" class="form-control input-md" required="required">              
              </div>
            </div>

            <div class="form-group required">
              <label class="col-md-4 control-label" for="status">Status</label>  
              <div class="col-md-6">
                <select id="status" name="status" class="form-control input-md" required="required">
                  <option value=''>--Select Status--</option>
                  <option value='1'>Active</option>
                  <option value='2'>Inactive</option> 
                </select>             
              </div>
            </div>            
        </div>

       <div class="modal-footer">
          <input type="hidden" name="mode" id="mode" value="create" />
          <input type="hidden" name="tableId" id="tableId" value="9" />
          <input type="hidden" name="editId" id="editId" value="" />
          <input type="hidden" name="redirect_url" id="redirect_url" value="admin/state" />
          <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
          <button type="submit" class="btn btn-crm-blue">Save</button>
        </div>
    </form>
    </div>

  </div>
</div>

<script type="text/javascript">
  gData=JSON.parse('<?php echo $list; ?>');

  function draw_state_master_header()
  {
  	var output=[];
  	output.push('<tr>\
  					<th><input type="checkbox" class="checkheader" value="" ></th>\
  					<th>#</th>\
  					<th>Country</th>\
  					<th>Name</th>\
  					<th>Status</th>\
  					<th></th>\
  				</tr>');
  	output=output.join('');
  	dom.getElementById('master_table_header').innerHTML=output;
  }

  function draw_state_master()
  {
  	var output=[];
  	var data=gData;	
  	var data_length=data.length;
  	if(data_length>0)
  	{
  		for(var i=0; i<data_length; i++)
  		{
  			var iplus=i+1;
  			output.push('<tr>\
  							<td><input type="checkbox" class="checkitem" value="'+data[i].id+'" ></td>\
  							<td>'+iplus+'</td>\
  							<td>'+data[i].country_name+'</td>\
  							<td>'+data[i].name+'</td>\
  							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
  							<td><a onclick="edit_industry('+data[i].id+',9)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
  						</tr>');
  		}
  	}else{
  		output.push('<tr>\
  	             <td colspan="10"><p class="text-center">No record found!</p></td>\
  	             </tr>');
  	}
  	output=output.join('');
  	dom.getElementById('master_table_data').innerHTML=output;
  }

  draw_state_master_header();
  draw_state_master();
</script>

<?php echo $footer; ?>
  </body>
</html>
