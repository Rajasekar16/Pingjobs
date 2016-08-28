<?php echo $header; ?>
<link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
<!-- Begin page content -->
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6 pad-lt-0 pad-top-10 page-header">
			<h3 class="light">Jobs</h3>
		</div>
		<div class="col-md-6 pad-top-10 page-header">
			<div class="navbar-collapse collapse">
				<!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a>
							<label class="control-label" for="textinput">Filter: </label>
							<!--<select id="sa" onchange="filterData('job_status',this.value,0,draw_jobs_grid)">-->
							<select id="filterByStatus">
								<option value="">All</option>
								<option value="1">Created</option>
								<option value="2">Approved</option>
								<option value="4">Expired</option>
							</select>                  
						</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="<?php echo base_url();?>admin/<?php echo (isset($admin)) ? 'postjob' : 'postjobs'; ?>/">
							<i class="glyphicon glyphicon-envelope"></i> Post Job
						</a>
					</li>
					<!--<li>
						<a href="<?php echo base_url().'job/postjob' ?>">
							<i class="glyphicon glyphicon-envelope"></i> Post Job
						</a>
					</li>-->
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
	<div class="col-md-12 message-div"></div>
	<div class="col-md-12">
		<table id="example" class="table table-striped" width="100%"></table>
	</div>
</div>
<script type="text/javascript">
<?php
/* gData=JSON.parse('echo $jobs; ');
  draw_jobs_header();
  draw_jobs_grid();*/
?>
$(document).ready(function() {
	var DT = $('#example').DataTable( {
		data: <?php echo $jobs; ?>,
		order:[0],
		deferRender: true,
		columns: [
			{ title: '<input type="checkbox" class="checkheader" value="" >', orderable:false,  data: "id", render : function(data, type, row) { return '<input type="checkbox" class="checkitem" value="'+row.id+'" >'; } },
			{ title: '#',  data: "id", orderable:false },
			{ title: "Company",  data: "company_name" },
			{ title: "Title",  data: "job_title" },
			{ title: "Job Type",  data: "job_type_name" },
			{ title: "Skills",  data: "primary_skills", className:"lavender", render : function(data, type, row) { return data+'<br>('+row.job_key_skill+')'; } },
			//{ title: "Experience",  data: "job_experience_from", render : function(data, type, row) { if(!data) return 0; return data+' - '+ row.job_experience_to; } },
			//{ title: "Salary",  data: "job_salary_from", render : function(data, type, row) { if(!data) return 0; return data+' - '+ row.job_salary_to; } },
			{ title: "Positions",  data: "job_no_postition" },
			{ title: "Industry",  data: "industry_name" },
			{ title: "Functional",  data: "functional_name" },
			{ title: "Location",  data: "location_name" },
			{ title: "Applied Count",  data: "applied_count", className:"text-center", render:function(data, type, row){
				return '<?php echo str_replace("\n","",form_open("job/applied_employee",array("id"=>"job_'+row.id+'"))); ?><input type="hidden" name="job_id" value="'+row.id+'"><a onclick="$(\'#job_'+row.id+'\').submit()" data-toggle="tooltip" data-placement="top" title="'+data+' Candidates Applied"><strong>'+data+'</strong> <i class="glyphicon glyphicon-new-window"></i></a></form>';
			} },
			{ title: "Status",  data: "status_str", className:"text-center", visible:false },
			{ title: "Status",  data: "status_str", className:"text-center", render : function(data, type, row) { return '<a title ="'+row.status_str+'" class="glyphicon glyphicon-stop '+row.status_class+' tool-tip"></a>'; } },
			{ title: "Manage", orderable:false,  data: "id", render : function(data, type, row) { return '<a data-toggle="tooltip" data-placement="left" title="Edit" href="'+base_url+'admin/<?php echo (isset($admin)) ? 'postjob' : 'postjobs'; ?>/'+row.id+'/"  class="glyphicon glyphicon-edit btn btn-primary btn-action"></a><a onclick="delete_job('+row.id+')" data-toggle="tooltip" data-placement="right" title="Remove" class="glyphicon glyphicon-remove btn btn-danger btn-action"></a>'; } }
		],
		"createdRow": function( row, data, dataIndex ) {
			$(row).attr("id", 'job_row_'+data.id );
 		}
	} );
	
	DT.on( 'order.dt search.dt', function () {
        DT.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
	$("#filterByStatus").change(function(){
		var val = $(this).val() ? $.fn.dataTable.util.escapeRegex( $(this).find("option:selected").text() ) : '';
		console.log(val);
		DT.columns(11).search( val ? '^'+val+'$' : '', true, false ).draw();
	});
	$(".tool-tip").tooltip();
} );
</script>
<?php echo $footer; ?>