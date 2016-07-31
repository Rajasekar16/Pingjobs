dom=document;
gFilterData=[];
gFilterFlag=false;
gData='';
gSortAsc=true;


$(document).ready(function (){
	$(".number-only").keypress(function (e){
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
		{
			$(this).next('.errorBox').html("Enter Number Only").show().fadeOut("slow").delay(6000);
			return false;
		}
	});

	$(".number-dot-only").keypress(function (e){
		if ( (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) &&  e.which != 46 ) 
		{
			$(this).next('.errorBox').html("Enter Number Only").show().fadeOut("slow").delay(6000);
			return false;
		}
	});

	$(".char-only").keypress(function (e){
		var letters = /^[A-Za-z]+$/;
		if(inputtxt.value.match(letters))
		{
			return true;
		}
		else
		{
			alert("message");
			return false;
		}
	});
});

$(function(){
	//Email validation
	$.validator.addMethod("email", function(value, element) 
	{
		if(value == '') 
			return true;
		var temp1;
		temp1 = true;
		var ind = value.indexOf('@');
		var str2=value.substr(ind+1);
		var str3=str2.substr(0,str2.indexOf('.'));
		if(str3.lastIndexOf('-')==(str3.length-1)||(str3.indexOf('-')!=str3.lastIndexOf('-')))
			return false;
		var str1=value.substr(0,ind);
		if((str1.lastIndexOf('_')==(str1.length-1))||(str1.lastIndexOf('.')==(str1.length-1))||(str1.lastIndexOf('-')==(str1.length-1)))
			return false;
		str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
		temp1 = str.test(value);
		return temp1;
	}, "Please enter valid email.");
	
	//Required validation
	$.validator.addMethod("required", function(value, element) 
	{
		if($.trim(value) != '') 
			return true;
		//$(this.lastActive).val($.trim(value));
		return false;
	}, "This field is required.");
	
	//To validate the form using jquery validation
	$("form").attr("autocomplete","off").validate({
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );

			if ( element.prop( "type" ) === "checkbox" ) {
				error.insertAfter( element.parent( "label" ) );
			} else {
				error.insertAfter( element );
			}
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parent( "div" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parent( "div" ).addClass( "has-success" ).removeClass( "has-error" );
		}
	});
});

$(function(){
	var windowHeight=$(window).height();
	var contentHeight=windowHeight-270;
	
	/*$('.datepicker').datetimepicker({
		format:'D-MM-YYYY',
		minDate:new Date()
	});*/



	$('[data-toggle="tooltip"]').tooltip();  
	$('[data-toggle="popover"]').popover();
	$(document).on('click','.checkheader',function(){
    	if(this.checked)
    	{
    		$('.checkitem').prop('checked', true);
    	}else{
    		$('.checkitem').prop('checked', false);    		
    	}
    });

    $(document).on('click','.checkitem',function(){

    	var  numberNotChecked = $('input.checkitem:not(":checked")').length
    	if(numberNotChecked>0)
    	{
    		$('.checkheader').prop('checked', false);    		
    	}else{
    		$('.checkheader').prop('checked', true);
    	}
    });

});

function get_delete_ids()
{
	var checkedValues = $('input.checkitem:checked').map(function() {
		    return this.value;
		}).get();
	return checkedValues;
}

function clearAll(ele)
{
	$(ele).closest('form').find("input[type=text], textarea,select,input[type=checkbox]").val("");
	$(ele).closest('form').find('#editId').val('');
	$(ele).closest('form').find('#mode').val('create');
}

function CRMinlineLoader()
{
	dom.getElementById('lsaloader').style.display="block";
}

function CRMhideinlineLoader()
{
	dom.getElementById('lsaloader').style.display="none";
}


function vload(element)
{
	$('#vreloader').modal({'backdrop':'static'}).modal('show');
}

function vunload(element)
{
	$('#vreloader').modal('hide');
}

function draw_education_master_header()
{
	var output=[];
	output.push('<tr>\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name</th>\
					<th>Level</th>\
					<th>Status</th>\
					<th></th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_education_master()
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
							<td>'+data[i].name+'</td>\
							<td>'+data[i].level_name+'</td>\
							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td><a onclick="edit_education('+data[i].id+',1)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
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

function edit_education(id,tableId)
{
	$.ajax({
                url:base_url+'common/getDetail',
                data: {'id':id,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	if(response.status=='ok')
                    	{
	                		var data=response.data;

	                		dom.getElementById('name').value=data.name;
	                		dom.getElementById('level').value=data.level;	                		
	                		dom.getElementById('editId').value=id;
							dom.getElementById('mode').value='edit';

	                    	$('#addDialog').modal({'backdrop':'static'}).modal('show');
                    	}
                        // window.location.reload();
                    }
            });
}

function draw_functional_master_header()
{
	var output=[];
	output.push('<tr>\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name</th>\
					<th>Status</th>\
					<th></th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_functional_master()
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
							<td>'+data[i].name+'</td>\
							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td><a onclick="edit_functional('+data[i].id+',2)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
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

function edit_functional(id,tableId)
{
	$.ajax({
                url:base_url+'common/getDetail',
                data: {'id':id,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	if(response.status=='ok')
                    	{
	                		var data=response.data;
	                		dom.getElementById('name').value=data.name;
	                		dom.getElementById('status').value=data.status;	                		
	                		dom.getElementById('editId').value=id;
							dom.getElementById('mode').value='edit';

	                    	$('#addDialog').modal({'backdrop':'static'}).modal('show');
                    	}
                        // window.location.reload();
                    }
            });
}

function draw_industry_master_header()
{
	var output=[];
	output.push('<tr>\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name</th>\
					<th>Status</th>\
					<th></th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_industry_master()
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
							<td>'+data[i].name+'</td>\
							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td><a onclick="edit_industry('+data[i].id+',3)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
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

function edit_industry(id,tableId)
{
	$.ajax({
                url:base_url+'common/getDetail',
                data: {'id':id,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	if(response.status=='ok')
                    	{
	                		var data=response.data;
	                		dom.getElementById('name').value=data.name;
	                		dom.getElementById('status').value=data.status;	                		
	                		dom.getElementById('editId').value=id;
							dom.getElementById('mode').value='edit';
	                    	$('#addDialog').modal({'backdrop':'static'}).modal('show');
                    	}
                        // window.location.reload();
                    }
            });
}

function draw_location_master_header()
{
	var output=[];
	output.push('<tr>\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name</th>\
					<th>Status</th>\
					<th></th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_location_master()
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
							<td>'+data[i].name+'</td>\
							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td><a onclick="edit_industry('+data[i].id+',4)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
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

function edit_location(id,tableId)
{
	$.ajax({
                url:base_url+'common/getDetail',
                data: {'id':id,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
	            	if(response.status=='ok')
	            	{
	            		var data=response.data;
	            		dom.getElementById('name').value=data.name;
	            		dom.getElementById('status').value=data.status;	                		
	            		dom.getElementById('editId').value=id;
						dom.getElementById('mode').value='edit';
	                	$('#addDialog').modal({'backdrop':'static'}).modal('show');
	            	}
	                // window.location.reload();
	            }
            });
}


function draw_employee_master_header()
{
	var output=[];
	output.push('<tr class="gridHeader">\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name <a onclick="sortData(\'employee_name\',\'char\',draw_employee_master)" class="glyphicon glyphicon-sort"></a> </th>\
					<th>Skills</th>\
					<th>Experience <a onclick="sortData(\'expry\',\'char\',draw_employee_master)" class="glyphicon glyphicon-sort"></a> </th>\
					<th>detail <a onclick="sortData(\'employee_city\',\'char\',draw_employee_master)" class="glyphicon glyphicon-sort"></a></th>\
					</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_employee_master()
{
	var output=[];
	var data=gData;	
	var data_length=data.length;
	var approve='';
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
			var status ='<td><a data-toggle="tooltip"  data-placement ="top" data-original-title ="'+data[i].status_title+'"  class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>';

			if(data[i].status_class =='grey')
			{
				//<a onclick="approve_job_applied(5)">Approve</a>
				status ='<td><button  onclick="approve_job_applied('+data[i].job_applied_id+')"  type="button" class="btn btn-primary">Approve</button> </td>';
			}
			 
			output.push('<tr>\
							<td><input type="checkbox" class="checkitem" value="'+data[i].id+'" ></td>\
							<td>'+data[i].id+'</td>\
							<td> <a data-toggle="tooltip"  data-placement ="left" data-original-title ="View"  onclick="view_employee('+data[i].id+')" class="">'+data[i].employee_name+'<a></td>\
							<td>'+data[i].employee_skills+'</td>\
							<td>'+data[i].expry+'.'+data[i].exprm+' Yrs</td>\
							<td>'+data[i].employee_email+'<BR>'+data[i].employee_mobile_no+'</td>\
							</td>\
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
/*
function draw_employer_master_header()
{
	var output=[];
	output.push('<tr class="gridHeader">\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Company Name <a onclick="sortData(\'company_name\',\'char\',draw_employer_master)" class="glyphicon glyphicon-sort"></a></th>\
					<th>Email</th>\
					<th>Contact Name</th>\
					<th>Contact No</th>\
					<th>City <a onclick="sortData(\'city\',\'char\',draw_employer_master)" class="glyphicon glyphicon-sort"></a></th>\
					<th>Address</th>\
					<th>Status <a onclick="sortData(\'status\',\'char\',draw_employer_master)" class="glyphicon glyphicon-sort"></a></th>\
					<th>Action</th>\
					<th>Edit</th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_employer_master()
{
	var output=[];
	var data=gData;	
	if(gFilterData!='' || gFilterFlag)
  {
    data=gFilterData;
  }else{
    data=gData;   
  }
  
	var data_length=data.length;
	var approve='';
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
			
			approve=(data[i].status==2) ? '<a onclick="approve_employer('+data[i].id+')" >'+data[i].status_code+'</a>': data[i].status_code; 
			output.push('<tr>\
							<td><input type="checkbox" class="checkitem" value="'+data[i].id+'" ></td>\
							<td>'+iplus+'</td>\
							<td>'+data[i].company_name+'</td>\
							<td>'+data[i].email+'</td>\
							<td>'+data[i].contact_person+'</td>\
							<td>'+data[i].contact_no+'</td>\
							<td>'+data[i].city+'</td>\
							<td>'+data[i].address+'</td>\
							<td><a data-toggle="tooltip"  data-placement ="top" data-original-title ="'+data[i].status_code+'"  class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td>'+approve+'</td>\
							<td><a href="'+base_url+'admin/viewemployerprofile/'+data[i].id+'" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
						</tr>');
		}
	}else{
		output.push('<tr>\
	             <td colspan="10"><p class="text-center">No record found!</p></td>\
	             </tr>');
	}
	output=output.join('');
	dom.getElementById('master_table_data').innerHTML=output;
}*/

function approve_employer(id)
{
	$.ajax({
		url:base_url+'admin/approve_employer',
		data: {'id':id},
		dataType:'json',
		method: 'POST',
		beforeSend: function(){
			$('#loader').modal({backdrop:'static'}).modal('show');
		},
		success: function(response){
			if(response.status=='ok')
			{
				window.location.reload();
			}else{
				alert('Approve action failed..');
			}
		}
	});
}

function draw_country_master_header()
{
	var output=[];
	output.push('<tr>\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name</th>\
					<th>Status</th>\
					<th></th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_country_master()
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
							<td>'+data[i].name+'</td>\
							<td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
							<td><a onclick="edit_country('+data[i].id+',7)" class="btn btn-default btn-action"><i class="glyphicon glyphicon-edit"></i></a></td>\
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

function edit_country(id,tableId)
{
	$.ajax({
                url:base_url+'common/getDetail',
                data: {'id':id,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	if(response.status=='ok')
                    	{
	                		var data=response.data;
	                		dom.getElementById('name').value=data.name;
	                		dom.getElementById('status').value=data.status;	                		
	                		dom.getElementById('editId').value=id;
							dom.getElementById('mode').value='edit';
	                    	$('#addDialog').modal({'backdrop':'static'}).modal('show');
                    	}
                        // window.location.reload();
                    }
            });
}


function draw_jobs_grid()
{
	var output=[];
	var data=[];
	if(gFilterData!='' || gFilterFlag)
	{
		data=gFilterData;
	}else{
		data=gData;		
	}
	var data_length=data.length;
	var iplus=0;
	var gender='';
	var applied='';
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			iplus=i+1;
			if(data[i].job_gender_id==1){
				gender="Male"
			}else if(data[i].job_gender_id==2){
				gender="Female"
			}else{
				gender="Any"
			}
				         // <td>'+data[i].job_desc+'</td>\
				         // <td>'+gender+'</td>\
				         // <td>'+data[i].country_name+'</td>\
         	if(data[i].applied_count>0)
			{

				applied='<form id="job_'+data[i].id+'" action="'+base_url+'job/applied_employee" method="post"><input type="hidden" name="job_id" value="'+data[i].id+'"><a onclick="$(\'#job_'+data[i].id+'\').submit()" data-toggle="tooltip" data-placement="top" title="'+data[i].applied_count+' Candidates Applied"><strong>'+data[i].applied_count+'</strong> <i class="glyphicon glyphicon-new-window"></i></a></form>';
			}else
			{
				applied=data[i].applied_count;
			}
			output.push('<tr id="job_row_'+data[i].id+'">\
						<td><input  type="checkbox" value="'+data[i].id+'" class="checkitem" /></td>\
				         <td>'+iplus+'</td>\
				         <td><a class="lavender">'+data[i].job_title+'</a></td>\
				         <td>'+data[i].job_key_skill+'</td>\
				         <td>'+data[i].job_experience_from+' - '+ data[i].job_experience_to +'</td>\
				         <td>'+data[i].job_salary_from+' - '+ data[i].job_salary_to +'</td>\
				         <td>'+data[i].job_no_postition+'</td>\
				         <td>'+data[i].functional_name+'</td>\
				         <td>'+data[i].location_name+'</td>\
				         <td>'+applied+'</td>\
				         <td class="'+data[i].status_class+'">'+data[i].status_str+'</td>\
				         <td>\
				         <a data-toggle="tooltip" data-placement="right" title="Edit" href="'+base_url+'job/postjob/'+data[i].id+'/" class="glyphicon glyphicon-edit btn btn-primary btn-action"></a>\
		               <a onclick="delete_job('+data[i].id+')" data-toggle="tooltip" data-placement="right" title="Remove" class="glyphicon glyphicon-remove btn btn-danger btn-action"></a>\
				         </td>\
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

function draw_jobs_header()
{
	
	var output=[];
				// <th>Description</th>\
				// <th>Gender</th>\
				// <th>Country</th>\
	output.push('<tr class="gridHeader">\
				<th><input type="checkbox"  class="checkheader"  /></th>\
				<th>#</th>\
				<th>Title <a onclick="sortData(\'job_title\',\'char\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Key Skills <a onclick="sortData(\'job_key_skill\',\'char\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Experience <a onclick="sortData(\'job_experience_from\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Salary <a onclick="sortData(\'job_salary_from\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Positions <a onclick="sortData(\'job_no_postition\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Functional </th>\
				<th>Location <a onclick="sortData(\'job_title\',\'char\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Applied Count<a onclick="sortData(\'applied_count\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Status <a onclick="sortData(\'job_status\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Manage</th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_admin_jobs_grid()
{
	var output=[];
	var data=[];
	if(gFilterData!='' || gFilterFlag)
	{
		data=gFilterData;
	}else{
		data=gData;		
	}
	gFilterFlag=false;
	var data_length=data.length;
	var iplus=0;
	var gender='';
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			iplus=i+1;
			if(data[i].job_gender_id==1){
				gender="Male"
			}else if(data[i].job_gender_id==2){
				gender="Female"
			}else{
				gender="Any"
			}
				         // <td>'+data[i].job_desc+'</td>\
				         // <td>'+gender+'</td>\
				         // <td>'+data[i].country_name+'</td>\
				         // <td>'+data[i].job_salary_from+' - '+ data[i].job_salary_to +'</td>\
				         // <td>'+data[i].functional_name+'</td>\

         	if(data[i].applied_count>0)
			{

				applied='<form id="job_'+data[i].id+'" action="'+base_url+'job/applied_employee" method="post"><input type="hidden" name="job_id" value="'+data[i].id+'"><a onclick="$(\'#job_'+data[i].id+'\').submit()" data-toggle="tooltip" data-placement="top" title="'+data[i].applied_count+' Candidates Applied"><strong>'+data[i].applied_count+'</strong> <i class="glyphicon glyphicon-new-window"></i></a></form>';
			}else
			{
				applied=data[i].applied_count;
			}


			output.push('<tr id="job_row_'+data[i].id+'">\
						<td><input  type="checkbox" value="'+data[i].id+'" class="checkitem" /></td>\
				         <td>'+iplus+'</td>\
				         <td><a class="lavender">'+data[i].company_name+'</a></td>\
				         <td><a class="lavender">'+data[i].job_title+'</a></td>\
				         <td>'+data[i].job_key_skill+'</td>\
				         <td>'+data[i].job_experience_from+' - '+ data[i].job_experience_to +'</td>\
				         <td>'+data[i].job_no_postition+'</td>\
				         <td>'+data[i].location_name+'</td>\
				         <td>'+applied+'</td>\
				         <td class="'+data[i].status_class+'">'+data[i].status_str+'</td>\
				         <td>\
				         <a data-toggle="tooltip" data-placement="left" title="Edit" href="'+base_url+'admin/postjob/'+data[i].id+'/"  class="glyphicon glyphicon-edit btn btn-primary btn-action"></a>\
		               <a onclick="delete_job('+data[i].id+')" data-toggle="tooltip" data-placement="right" title="Remove" class="glyphicon glyphicon-remove btn btn-danger btn-action"></a>\
				         </td>\
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

function draw_admin_jobs_header()
{
	

	var output=[];
	var company=[];
	var data =gData;
	for(var i=0,len=data.length;i<len;i++ )
	{
		company.push(data[i].company_name);
	}
	
	var company_li=make_filter_list(company,'company_name','draw_admin_jobs_grid');

				// <th>Description</th>\
				// <th>Gender</th>\
				// <th>Country</th>\
				// <th>Functional </th>\
				// <th>Salary <a onclick="sortData(\'job_salary_from\',\'int\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
	output.push('<tr class="gridHeader">\
				<th><input type="checkbox"  class="checkheader"  /></th>\
				<th>#</th>\
				<th><div class="btn-group">Company Name <a onclick="sortData(\'company_name\',\'char\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a> <a class="glyphicon glyphicon-filter dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></a>\
				<ul class="dropdown-menu filter-ul" role="menu">'+company_li+'\
					<li class="divider"></li>\
				<li><a>Cancel</a></li>\
				</ul>\
				</div>\
				</th>\
				<th>Job Title <a onclick="sortData(\'job_title\',\'char\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Key Skills <a onclick="sortData(\'job_key_skill\',\'char\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Experience <a onclick="sortData(\'job_experience_from\',\'int\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Positions <a onclick="sortData(\'job_no_postition\',\'int\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Location <a onclick="sortData(\'job_title\',\'char\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Applied <a onclick="sortData(\'applied_count\',\'int\',draw_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Status <a onclick="sortData(\'job_status\',\'int\',draw_admin_jobs_grid)" class="glyphicon glyphicon-sort"></a></th>\
				<th>Manage</th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function delete_job(id)
{
	if(id>0)
	{
		if(confirm('Are you sure you want to delete this Job ?'))
		{
			$.ajax({
		        url: base_url+'job/delete_job/',
		        data: 'id='+id,
		        type: 'POST',
		        dataType: 'json',
		        beforeSend: function(msg){
		        	// vload();
		        },
		        success: function( response ){
		        	if(response.status=='ok')
		        	{
		        		$('.message-div').append('<div class="alert alert-success text-center">Job Deleted successfully!</div>').show();
		        		$('#job_row_'+id).slideUp().remove();
		        	}
		        }
		    });
		}
	}
}

function common_delete(tableId)
{
	var delete_id_arr=get_delete_ids();
	var url='';
	var arrLength=delete_id_arr.length;
	var sendData='';
	if(arrLength>0)
	{
		if(confirm('Are you sure you want to delete ?'))
        {
			var id_json =JSON.stringify(delete_id_arr);
            $.ajax({
                url:base_url+'common/deleteRecord',
                data: {'ids':id_json,'tableId':tableId},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	/*for(var i=0; i<arrLength;i++)
                    	{
                       		$('#row_'+delete_id_arr[i]).slideUp().remove();
                    	}*/
                        window.location.reload();
                    }
            });
        }

	}else{
		alert('Please select atleast one item');
	}
}
function job_approve()
{
	var delete_id_arr=get_delete_ids();
	var url='';
	var arrLength=delete_id_arr.length;
	var sendData='';
	if(arrLength>0)
	{
		var id_json =JSON.stringify(delete_id_arr);
        $.ajax({
            url:base_url+'job/jobApprove',
            data: {'ids':id_json},
            dataType:'json',
            method: 'POST',
            beforeSend: function(){
                $('#loader').modal({backdrop:'static'}).modal('show');
            },
            success: function(response){                    	
                    window.location.reload();
                }
        });
	}else{
		alert('Please select atleast one item');
	}
}

function job_filters()
{
	var output=[];
	var location_name=[];	
	var industry_name=[];	

	var data =gData;
	for(var i=0,len=data.length;i<len;i++ )
	{
		location_name.push(data[i].location_name);
		industry_name.push(data[i].industry_name);
	}

	var location_name_li=make_side_filter_list(location_name,'location_name','draw_jobs');
	var industry_name_li=make_side_filter_list(industry_name,'industry_name','draw_jobs');
	$('#location_filter').html(location_name_li);
	$('#industry_filter').html(industry_name_li);
	// $('#industry_filter').html(industry_name_li);
}

function draw_jobs()
{	
	var output=[];
	var data=gData;	
	if(gFilterData!='' || gFilterFlag)
	{
		data=gFilterData;
	}
	var data_length=data.length;
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
			output.push('<div class="emp-job-holder">\
                    <div class="col-md-12">\
                      <h3>'+Ucfirst(data[i].job_title)+'</h3>\
                      <p>'+Ucfirst(data[i].company_name)+'</p>\
                    </div>\
                    <div class="col-md-7">\
                    <table class="table emp-job-list-table borderless">\
                      <tbody>\
                        <tr>\
                          <td>Location:</td>\
                          <td>'+Ucfirst(data[i].location_name)+'</td>\
                        </tr>\
                        <tr>\
                          <td>Keyskills:</td>\
                          <td>'+data[i].job_key_skill+'</td>\
                        </tr>\
                        <tr>\
                          <td>Job Description:</td>\
                          <td> '+Ucfirst(data[i].job_desc)+'</td>\
                        </tr>\
                      </tbody>\
                    </table>\
                    </div>\
                    <div class="col-md-5">\
                      <h4>About Company</h4>\
                      <p>'+Ucfirst(data[i].about_company)+'</p>\
                    </div>\
                    <div class="col-md-12 emp-job-buttons">\
                      <span class="emp-job-postedby">Posted by <strong>HR, '+data[i].days_ago_str+'</strong></span>\
                      <a href="'+base_url+'job/jobdetails/'+data[i].id+'" id=""  class="btn btn-primary pull-right">View Job</a>\
                    </div>\
                  </div>');
		}
	}else{
		output.push('<tr>\
	             <td colspan="10"><p class="text-center">No record found!</p></td>\
	             </tr>');
	}
	output=output.join('');
	dom.getElementById('job_list').innerHTML=output;
}

function draw_jobs_ajax(data)
{	
	var output=[];
	var data_length=data.length;
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
			//var day_text = (data[i].days_ago_str == 0)?'Today':data[i].days_ago_str;
			output.push('<div class="emp-job-holder">\
                    <div class="col-md-12">\
                      <h3>'+Ucfirst(data[i].job_title)+'</h3>\
                      <p>'+Ucfirst(data[i].company_name)+'</p>\
                    </div>\
                    <div class="col-md-7">\
                    <table class="table emp-job-list-table borderless">\
                      <tbody>\
                        <tr>\
                          <td>Location:</td>\
                          <td>'+Ucfirst(data[i].location_name)+'</td>\
                        </tr>\
                        <tr>\
                          <td>Keyskills:</td>\
                          <td>'+data[i].job_key_skill+'</td>\
                        </tr>\
                        <tr>\
                          <td>Job Description:</td>\
                          <td> '+Ucfirst(data[i].job_desc)+'</td>\
                        </tr>\
                      </tbody>\
                    </table>\
                    </div>\
                    <div class="col-md-5">\
                      <h4>About Company</h4>\
                      <p>'+(data[i].about_company)+'</p>\
                    </div>\
                    <div class="col-md-12 emp-job-buttons">\
                      <span class="emp-job-postedby">Posted by <strong>HR, '+data[i].days_ago_str+'</strong></span>\
                      <a href="'+base_url+'job/jobdetails/'+data[i].id+'" id=""  class="btn btn-primary pull-right">View Job</a>\
                    </div>\
                  </div>');
		}
	}else{
		output.push('<tr>\
	             <td colspan="10"><p class="text-center">No record found!</p></td>\
	             </tr>');
	}
	output=output.join('');
	return output;
	// dom.getElementById('job_list').innerHTML=output;
}

function sort_jobs(data)
{
	var dataArr=data.split('@')
	if(dataArr.length==2)
	{
		var value=dataArr[0];
		var dataType=dataArr[1];
		sortData(value,dataType,draw_jobs)
	}
}

function apply_job()
{
	var job_id=$('#job_id').val();
	var user_id=$('#user_id').val();
	$.ajax({
		url:base_url+'job/apply_job',
		data:'user_id='+user_id+'&job_id='+job_id,
		dataType:'json',
		method: 'POST',
		success:function(data)
		{
			if(data.status=='ok')
			{
				// alert('Applied successfully');
				$('.apply_job').html('Applied').attr('onclick','');
			}
		}
	});
}



function draw_applied_job_approve_header()
{
	var output=[];
	output.push('<tr class="gridHeader">\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Company Name <a onclick="sortData(\'company_name\',\'char\',draw_applied_job_approve)" class="glyphicon glyphicon-sort"></a></th>\
					<th>Employee </th>\
					<th>Action</th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_applied_job_approve()
{
	var output=[];
	var data=gData;	
	var data_length=data.length;
	var approve='';
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
			approve='<a onclick="approve_job_applied('+data[i].id+')" >Approve</a>'; 
			output.push('<tr>\
							<td><input type="checkbox" class="checkitem" value="'+data[i].id+'" ></td>\
							<td>'+iplus+'</td>\
							<td>'+data[i].company_name+'</td>\
							<td>'+data[i].employee_name+'('+data[i].employee_email+')</td>\
							<td>'+approve+'</td>\
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

function approve_job_applied(id)
{
	$.ajax({
                url:base_url+'admin/approve_job_applied',
                data: {'id':id},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                	if(response.status=='ok')
                	{
                        window.location.reload();
                	}else{
                		alert('Approve action failed..');
                	}
                }
        });
}



function draw_employee_search_header()
{
					// <th>Address</th>\
					// <th>Status <a onclick="sortData(\'employee_status\',\'char\',draw_employee_master)" class="glyphicon glyphicon-sort"></a></th>\
	var output=[];
	output.push('<tr class="gridHeader">\
					<th><input type="checkbox" class="checkheader" value="" ></th>\
					<th>#</th>\
					<th>Name <a onclick="sortData(\'employee_name\',\'char\',draw_employee_search)" class="glyphicon glyphicon-sort"></a> </th>\
					<th>Exprience</th>\
					<th>Contact <a onclick="sortData(\'employee_city\',\'char\',draw_employee_search)" class="glyphicon glyphicon-sort"></a></th>\
					<th>Resume</th>\
					<th>Action</th>\
				</tr>');
	output=output.join('');
	dom.getElementById('master_table_header').innerHTML=output;
}

function draw_employee_search()
{
	var output=[];
	var data=gData;	
	var data_length=data.length;
	var approve='';
	var resume="";
	if(data_length>0)
	{
		for(var i=0; i<data_length; i++)
		{
			var iplus=i+1;
							// <td>'+data[i].employee_address+'</td>\
							// <td><a class="glyphicon glyphicon-stop '+data[i].status_class+'"></a></td>\
			 resume="";
			 if(data[i].employee_resume_url!='')
			 {
			 	resume='<a data-toggle="tooltip"  data-placement ="top" data-original-title ="Download Resume" target="_blank" download href="'+aster_url+'upload/'+data[i].employee_resume_url+'"><i class="glyphicon glyphicon-download-alt"></i> '+data[i].employee_resume_name;
			 }
			output.push('<tr>\
							<td><input type="checkbox" class="checkitem" value="'+data[i].id+'" ></td>\
							<td>'+data[i].id+'</td>\
							<td>'+data[i].employee_name+'<BR>'+data[i].employee_skills+'</td>\
							<td>'+data[i].employee_exp_year+'.'+data[i].employee_exp_month+' Yrs <BR> '+data[i].employee_notice+' Days</td>\
							<td>'+data[i].employee_email+'<BR>'+data[i].employee_mobile_no+' <BR> '+data[i].employee_city+'</td>\
							<td>'+resume+'</td>\
							<td><a data-toggle="tooltip"  data-placement ="right" data-original-title ="View" onclick="view_employee('+data[i].id+')" class="glyphicon glyphicon-list btn btn-primary btn-action"></a></td>\
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

function view_employee(id)
{
	$.ajax({
                url:base_url+'index.php/employee/getDetail',
                data: {'id':id},
                dataType:'json',
                method: 'POST',
                beforeSend: function(){
                    $('#loader').modal({backdrop:'static'}).modal('show');
                },
                success: function(response){
                    	if(response.status=='ok')
                    	{
	                		var data=response.data;
	                		$('#view_employee_name').html(data.employee_name);
	                		$('#view_employee_mobile_no').html(data.employee_mobile_no);
	                		$('#view_employee_notice').html(data.employee_notice);
	                		if(data.employee_resume_url!='')
	                		{
	                			$('#view_employee_resume_url').attr('href',aster_url+'upload/'+data.employee_resume_url);
	                			$('#view_employee_resume_name').html(data.employee_resume_name);
	                		}else{
	                			$('#view_employee_resume_url').hide();
	                		}
	                		
	                		$('#view_employee_skills').html(data.employee_skills);
	                		$('#view_employee_job_title').html(data.employee_job_title);
	                		$('#view_employee_expected_salary').html(data.employee_expected_salary);
	                		$('#view_employee_exp_year').html(data.employee_exp_year);
	                		$('#view_employee_exp_month').html(data.employee_exp_month);
	                		$('#view_employee_email').html(data.employee_email);
	                		$('#view_employee_edu_master').html(data.master);
	                		$('#view_employee_edu_basic').html(data.basic);
	                		$('#view_employee_current_salary').html(data.employee_current_salary);
	                		$('#view_employee_current_desig').html(data.employee_current_desig);
	                		$('#view_employee_current_company').html(data.employee_current_company);
	                		$('#view_employee_city').html(data.employee_city);
	                		$('#view_preferred_location').html(data.preferred_location);
	                		$('#view_employee_Linkedin_url').html(data.Linkedin_url);
	                		$('#view_employee_address').html(data.employee_address);
	                		$('#view_created_date').html(data.created_date);
	                		$('#employeeViewDialog').modal('show');

	                    	//$('#employeeViewDialog').modal({'backdrop':'static'}).modal('show');
                    	}
                        // window.location.reload();
                    }
            });
}


// Sort and Filter Start

var sort_by = function(field, reverse, primer){
	    var key = primer ? 
	         function(x) {return primer(x[field]); }:
	         function(x) {return x[field] };
	    reverse = [-1, 1][+!!reverse];
	    return function (a, b) {
	        a = key(a);
	        b = key(b);
	        return a==b ? 0 : reverse * ((a > b) - (b > a));
	    }
	}

function sortData(sortKey,keyDataType,drawFunction)
{	
	var data='';
	if(gFilterData!='')
	{
		data=gFilterData;
	}else
	{
		data=gData;
	}

	if(keyDataType=='int')
	{
		data.sort(sort_by(sortKey, gSortAsc, parseInt));
	}else
	{
		data.sort(sort_by(sortKey, gSortAsc, function(a){ return a.toUpperCase();}));
	}

	gFilterData=data;
  	gSortAsc=!gSortAsc;

	if ($.isFunction(drawFunction)) 
	{
	    drawFunction.call();
  	}
}

function make_side_filter_list(dataArr,field,drawFunction)
{
	var listArr=[];
	var list='';
	var counts=[];
	$.each(dataArr, function(key,value) {
		if (!counts.hasOwnProperty(value)) {
			counts[value] = 1;
		} else {
			counts[value]++;
		}
	});
	dataArr=$.unique(dataArr);
	for(var i=0,len=dataArr.length;i<len;i++)
	{
		// listArr.push('<li class="checkbox"><input type="checkbox" id="location-1" /> <label for="location-1">Chennai (24)</label></li>');
		listArr.push('<li class="checkbox"><input onclick="setFilter(\''+field+'\','+drawFunction+')" class="field-'+field+' filter-clear"  type="checkbox" value="'+dataArr[i]+'" /> <label for="location-1">'+Ucfirst(dataArr[i])+' ('+counts[dataArr[i]]+')</label></li>');
	}
	list=listArr.join('');
	return list;
}
function make_filter_list(dataArr,field,drawFunction)
{
	var listArr=[];
	var list='';
	dataArr=$.unique(dataArr);
	for(var i=0,len=dataArr.length;i<len;i++)
	{
		listArr.push('<li><a><input onclick="setFilter(\''+field+'\','+drawFunction+')" class="field-'+field+' filter-clear"  type="checkbox" value="'+dataArr[i]+'" /> '+dataArr[i]+'</a></li>');
	}
	list=listArr.join('');
	return list;
}

function setFilter(field,drawFunction)
{
	var valueArr=[];
	$('.field-'+field).each(function(){
		var thisElem=$(this);
		if(thisElem.is(":checked"))
		{
			valueArr.push(thisElem.val());
		}
	});	
	
	filterData(field,valueArr,0,drawFunction);
	$('.filter-clear').not('.field-'+field).attr('checked',false);
}

function filterData(field,filterValue,joinFilter,drawFunction)
{
	gFilterFlag=true;
	var data=gData;
	var res=[];
	var value='';
	if(joinFilter==1)
	{
		if(gFilterData!='')
		{
			data=gFilterData;
		}
	}
	switch (field)
	{
		case 'days_ago' :
			if(filterValue!='')
			{
				for(var i=0,len=data.length;i<len;i++)
				{				
					value=data[i][field];
					if(value<=filterValue)
					{
						res.push(data[i]);
					}
				}
			}else
			{
				res=data;
			}
			 break;
		 /*case 'salary_range' :
			if(filterValue!='')
			{
				var sal_arr=filterValue.split();
				var from=sal_arr[0];
				var to=sal_arr[1];
				var job_salary_from='';
				var job_salary_to='';
				var append=false;
				for(var i=0,len=data.length;i<len;i++)
				{				
					append=false;
					job_salary_from=data[i]['job_salary_from'];
					job_salary_to=data[i]['job_salary_to'];
					if(from<=job_salary_from || to>=job_salary_from)
					{
						append=true;
					}
					if(to<=job_salary_to)
					{
						append=true;
					}
					if(append)
					{
						res.push(data[i]);
					}
				}
			}else
			{
				res=data;
			}
			 break;*/
		default : 
			if($.isArray(filterValue))
			{
				if(filterValue.length>0)
				{
					for(var i=0,len=data.length;i<len;i++)
					{
						value=data[i][field];
						if($.inArray(value,filterValue)>-1)
						{
							res.push(data[i]);
						}
					}
				}else
				{
					res=data;
				}
			}
			else
			{
				if(filterValue!='')
				{
					for(var i=0,len=data.length;i<len;i++)
					{
						value=data[i][field];
						if(value==filterValue)
						{
							res.push(data[i]);
						}
					}	
				}
				else
				{
					res=data;
				}
			}
	}
	gFilterData=res;

	if ($.isFunction(drawFunction)) 
	{
	    drawFunction.call();
  	}
}

// Sort and Filter Ends 
// Ucfirst in javascript

function Ucfirst(string) {
	if(string != '' &&  string != null)
	{
	
    return string.charAt(0).toUpperCase() + string.slice(1);
	}
}

$(function(){
	$('#uploadresumetrigger').click(function(){
        $('#resume_upload').trigger('click');
    });
 $('#resume_upload').change(function(){
         var file = this.files[0];
        var name = file.name;
        var size = file.size;
        var type = file.type;
        //Your validation

        var formData = new FormData($('#resume_upload_form')[0]);
        $.ajax({
            url: base_url+'employee/upload_resume/',  //Server script to process data
            type: 'POST',
            dataType:'json',
            xhr: function() {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){ // Check if upload property exists
                    myXhr.upload.addEventListener('progress',vload, false); // For handling the progress of the upload
                }
                return myXhr;
            },
            //Ajax events
            beforeSend: function(){
            	vload();
                // $('#uploadResume').modal({backdrop:'static'}).modal('show');
            },
            success: function(response){
                if(response.status=='ok')
                {
                	//var file_name =response.filename+ response.extention;
                	$('#employee_resume_url').val(response.urlname);
                	//var file_name
                	//
                	$('.employee_resume_name').html(response.filename);
                	$('.employee_resume_name').val(response.filename);
                	//$('#').html(response.filename);
                }
                else
                {
                	alert(response.msg)
                }
                
                //vunload();
            },
            error: function(){},
            // Form data
            data: formData,
            //Options to tell jQuery not to process data or worry about content-type.
            cache: false,
            contentType: false,
            processData: false
        });
    });
});

function get_checked_ids(className)
{
	var checkedValues = $('input.'+className+':checked').map(function() {
		    return this.value;
		}).get();
	return checkedValues;
}
