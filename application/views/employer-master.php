<?php echo $header; ?>
<!-- Begin page content -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 pad-lt-0 pad-top-10 page-header">
			<h3 class="light">Employer Management</h3>
		</div>
		<div class="col-md-6 pad-top-10 page-header">
			<div class="navbar-collapse collapse">
				<!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a>
							<label class="control-label" for="textinput">Filter: </label>
							<!--<select id="sa" onchange="filterData('status',this.value,0,draw_employer_master)">-->
							<select id="filterByStatus">
								<option value="">All</option>
								<option value="0">Waiting</option>
								<option value="2">Approve</option>
								<option value="1">Approved</option>
							</select>
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?php echo base_url();?>admin/addemployer">
							<i class="glyphicon glyphicon-plus"></i> Add Employer
						</a>
					</li>
					<li>
						<a onclick="common_delete(6)" >
							<i class="glyphicon glyphicon-trash"></i> Delete
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div> 
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="row">
	<div class="col-md-12">
		<table id="example" class="table table-striped" width="100%"></table>
	</div>
</div>
<!-- <div>
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
        <h4 class="modal-title" id="myModalLabel">Manage Employee</h4>
      </div>
      <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/add_update">
        <div class="modal-body">          
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Name</label>  
              <div class="col-md-6">
                <input id="name" name="name" type="text" placeholder="Enter Name" class="form-control input-md" required="">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="status">Status</label>  
              <div class="col-md-6">
                <select id="status" name="status" class="form-control input-md" required="">
                  <option value=''>Select Status</option>
                  <option value='1'>Active</option>
                  <option value='2'>Inactive</option> 
                </select>             
              </div>
            </div>            
        </div>

       <div class="modal-footer">
          <input type="hidden" name="mode" id="mode" value="create" />
          <input type="hidden" name="tableId" id="tableId" value="5" />
          <input type="hidden" name="editId" id="editId" value="" />
          <input type="hidden" name="redirect_url" id="redirect_url" value="admin/location" />
          <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
          <button type="submit" class="btn btn-crm-blue">Save</button>
        </div>
    </form>
    </div>
  </div>
</div> -->

<script type="text/javascript">
 /* gData=JSON.parse('<?php echo $list; ?>');
  draw_employer_master_header();
  draw_employer_master();  */
$(document).ready(function() {
	var DT = $('#example').DataTable( {
		data: <?php echo $list; ?>,
		order:[0],
		deferRender: true,
		columns: [
			{ title: '<input type="checkbox" class="checkheader" value="" >', orderable:false,  data: "id", render : function(data, type, row) { return '<input type="checkbox" class="checkitem" value="'+row.id+'" >'; } },
			{ title: '#',  data: "id", orderable:false },
			{ title: "Company Name",  data: "company_name" },
			{ title: "Email",  data: "email" },
			{ title: "Contact Name",  data: "contact_person" },
			{ title: "Contact No",  data: "contact_no", orderable:false },
			{ title: "Address",  data: "address", orderable:false },
			{ title: "City",  data: "city" },
			{ title: "Status",  data: "status_class", orderable:false, className:"text-center", render : function(data, type, row) { return '<a title ="'+row.status_code+'" class="glyphicon glyphicon-stop '+row.status_class+' tool-tip"></a>'; } },
			{ title: "Action",  data: "status_code", render : function(data, type, row) { return (row.status=="2") ? '<a onclick="approve_employer('+row.id+')" >'+row.status_code+'</a>': data; } },
			{ title: "Edit", orderable:false,  data: "id", render : function(data, type, row) { return '<a href="'+base_url+'admin/viewemployerprofile/'+data+'" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a>'; } }
		]
	} );
	
	DT.on( 'order.dt search.dt', function () {
        DT.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
	$("#filterByStatus").change(function(){
		var val = $(this).val() ? $.fn.dataTable.util.escapeRegex( $(this).find("option:selected").text() ) : '';
		DT.columns(9).search( val ? '^'+val+'$' : '', true, false ).draw();
	});
	$(".tool-tip").tooltip();
} );
</script>

<?php echo $footer; ?>