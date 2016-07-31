 <?php echo $header; ?>
<link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
    <!-- Begin page content -->

   <div class="row">
      <div class="col-md-4">
        <div class="page-header">
        <h3 class="light">Employee Management</h3>
        </div>
      </div>

        <div class="col-md-8 pad-top-10">
        <div class="navbar-collapse collapse">
          <!-- <div class="col-md-4"><small><strong>48</strong> Clients Found</small></div> -->
          <ul class="nav navbar-nav navbar-left">

          <div class="alert alert-danger" style="display:none">
                      <strong>Error!</strong> The email/username and password you entered don't match .
                    </div>
                    <div class="alert alert-success" style="display:none">
                      <strong>Error!</strong> The email/username and password you entered don't match .
                    </div>


          <div class="clearfix"></div>
        </div> 
      </div>       
      

      
    </div>


 

<div id="toolbar">
        <button id="remove" class="btn btn-primary" onclick ="export_data()" >
            <i class="glyphicon glyphicon-cloud-download "></i> Export
        </button>
        <button id="remove" class="btn btn-primary"  data-toggle="modal" data-target="#sendmail"  >
        <i class="glyphicon glyphicon-envelope"></i> Send Resume            
        </button>
    </div>
    <div id="toolbar">
        
    </div>


    
<table id="eventsTable"  class ="table-striped"  style="display:none" data-show-export="true"
       data-sort-name ="id"
       data-sort-order ="desc" 
       data-pagination="true"
       data-search="true"      
       data-show-toggle="true"
       data-show-columns="true"
       data-show-export="true"
       data-page-size ="20"
       data-smart-display ="true"
       data-show-columns ="true"
       data-click-to-select ="true"
       data-sortable ="true"
       data-toolbar="#toolbar"
        data-show-refresh="true"        
           >
    <thead>
    <tr>       
        <th  data-field="state"  data-checkbox="true" ></th>
        <th data-defaultsort="desc" data-sortable="true" data-field="id">id</th>
        <th data-field="employee_name">Name</th>        
        <th data-field="employee_skills">Skill</th>        
        <th data-field="expry">Exprience</th>        
    </tr>
   
    </thead>
</table>



      
    </div>


    <div class="modal" id="employeeViewDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel1">Employee Details</h4>
      </div>
     <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>admin/resume_search">
        <div class="modal-body">

          <div class="form-group">
            <label class="col-md-4 control-label pad-top-0" for="name">Name : </label>
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_name"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label pad-top-0" for="name">Mobile No : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_mobile_no"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Email : </label>  
            <div class="col-md-6">
              <span class="control-label" for="name" id="view_employee_email"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Resume : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name"> <a target="_blank" download href="" id="view_employee_resume_url"><i class="glyphicon glyphicon-download-alt"></i> <span id="view_employee_resume_name"></span></a></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Skills : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_skills"></span>  
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Job Apply For: </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_job_title"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Experience : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name"><span id="view_employee_exp_year"></span>.<span id="view_employee_exp_month"></span> <small>years</small></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current Company : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_current_company"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current Salary</label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_current_salary"> </span>  <small>(laks/annum)</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Expected Salary : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_expected_salary"></span>  <small>(laks/annum)</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Notice Period : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_notice"></span>  <small>days</small>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Education Master : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_edu_master"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Education Basic : </label>  
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_edu_basic"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Current City : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_city"></span>  
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Preferred City : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_preferred_location"></span>  
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Linkedin URL : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_Linkedin_url"></span>  
            </div>
          </div>

           <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Posted On : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_created_date"></span>  
            </div>
          </div>



          <div class="form-group">
            <label class="col-md-4 pad-top-0 control-label" for="name">Address : </label> 
            <div class="col-md-6">
              <span class=" control-label" for="name" id="view_employee_address"></span>  
            </div>
          </div>
        </div>
       <div class="modal-footer">
        <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </form>
    </div>
  </div>
</div>





    <div class="modal " id="addDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Search</h4>
      </div>
     <form class="form-horizontal"  onsubmit=" return false;" id ="search-form">
     
     <input type="hidden"  name="job" id ="job" value ="<?php echo ($job_id >0 ) ? $job_id :0 ?>" /> 
        <div class="modal-body">

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Skills</label>  
              <div class="col-md-6">
                <input id="skills" name="skills" type="text" placeholder="Enter Skill" class="form-control input-md">              
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Candidate Name</label>  
              <div class="col-md-6">
                <input id="employee_name" name="employee_name" type="text" placeholder="Enter Candidate Name" class="form-control input-md">              
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="name">Company Name</label>  
              <div class="col-md-6">
                <input id="employee_current_company" name="employee_current_company" type="text" placeholder="Enter Company Name" class="form-control input-md">              
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

             <div class="form-group">
              <label class="col-md-4 control-label" for="name">Date Range</label>  
              <div class="col-md-4">

              <div class='input-group date' id='datetimepicker6' >
                <input type='text' class="form-control" name ='from_date' />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>

              </div>
              
              <div class="col-md-4">
                <div class='input-group date' id='datetimepicker7' >
                <input type='text' class="form-control" name ='to_date' />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>               
            </div>

            

          
        </div>

       <div class="modal-footer">
        <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
        <button type="button" onclick ="search_resume()" name="search" class="btn btn-crm-blue">Search</button>
        </div>
    </form>
    </div>

  </div>
</div>



 <div class="modal " id="sendmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Email</h4>
      </div>
	  <?php echo form_open($action,array('class'=>"form-horizontal","id"=>"email-form","onsubmit"=>"return false;"));?>
        <div class="modal-body">

            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Email Id</label>  
              <div class="col-md-9">
                <input id="sendemail" name="sendemail" required ="" type="email"  type="text" placeholder="Enter Skill" class="form-control input-md">              
              </div>
            </div>   

            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Email Content</label>  
              <div class="col-md-9">
              <textarea class="form-control" rows="5" id="comment"></textarea>            
              </div>
            </div>
            </div>        

       <div class="modal-footer">
        <button type="button" onclick="clearAll(this)"  class="btn btn-default" data-dismiss="modal">Clear</button>
        <button type="button" onclick ="send_email()" name="search" class="btn btn-crm-blue">Send</button>
        </div>
    </form>
    </div>

  </div>
</div>
<?php echo $footer; ?>



<script type="text/javascript">

gBaseUrl = "<?php echo base_url(); ?>"; 
    pathArray = window.location.pathname.split( '/' ); 
     console.log(pathArray.length);
     if(pathArray.length >=2)
     {
      if(pathArray[2] =='job')
      {
        search_resume();
        $('#addDialog').modal('hide');
      }
      else
      {
        $('#addDialog').modal('show');
      }
        //jQuery('#ext_post_id').val(pathArray[2]);
        //jQuery('#employee_job_title').val(pathArray[3]);
        //console.log('set id');
     }


 $(function () {
        $('#datetimepicker6').datetimepicker({
                 format: 'MM/DD/YYYY',
                  defaultDate: new Date().setDate(new Date().getDate()-30)
           });
        $('#datetimepicker7').datetimepicker({
          format: 'MM/DD/YYYY',
            useCurrent: false, //Important! See issue #1075
            defaultDate: new Date()
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });


checkedRows = [];
checkedRowsindex = [];
function search_resume() {
    $button = $('#remove');
    var $table = $('#eventsTable');
    var input_data = $('#search-form').serialize();
    $('#eventsTable').bootstrapTable({
        url: gBaseUrl+'/search/resume_search?' + input_data,
        method: 'post',
		data:{'csrf_token_name':$("[name=csrf_token_name]").val()},
        dataType: 'json',
        height: getHeight(),
        onLoadSuccess: function(p) {
            $('#eventsTable').show();
        },
        rowAttributes: function(row) {
            return {
                class: 'id' + row.id
            };
        },
        columns: [{
                field: 'employee_id',
                align: 'center',
                valign: 'middle',
                value: 'id',
                title: '',
                class: "col-md-1",
              },

            {
                field: 'id',
                align: 'center',
                valign: 'middle',
                title: 'ID',
                class: "col-md-1"
            }, {
                title: 'Name',
                field: 'employee_name',
                sortable: true,
                class: "col-md-3",
                formatter: operateFormatter
            }, {
                title: 'Skill',
                field: 'employee_skills',
                sortable: true,
                class: "col-md-4"
            }, {
                title: 'Exprience',
                field: 'expry',
                sortable: true,
                class: "col-md-2"
            }, {
                title: 'Details',
                field: 'detail',
                class: "col-md-3"
            }
        ],
    });
    $table.on('page-change.bs.table', function(e, row, index) {
        for (var i = checkedRows.length; i--;) {
            $('.id' + checkedRows[i]).find(":checkbox").prop('checked', true);
        }
    });
    $table.on('check.bs.table', function(e, row, index) {
        checkedRows.push(row.id);
        checkedRowsindex.push(index);       
    });
    $table.on('uncheck.bs.table', function(e, row) {
        for (var i = checkedRows.length; i--;) {
            if (checkedRows[i] === row.id) {
                checkedRows.splice(i, 1);
                checkedRowsindex.splice(i, 1);
            }
        }
    });

    $table.on('check-all.bs.table', function(e, row) {
      var GetallData = $('#eventsTable').bootstrapTable('getData');
        checkedRows = [];
        for (var i = GetallData.length; i--;) {
            checkedRows.push(GetallData[i].id); 
        }
    });
    $table.on('uncheck-all.bs.table', function(e, row) {
        checkedRows = [];
        checkedRowsindex = [];
    });
    $('#addDialog').modal('hide');

}

function getHeight() {
    return $(window).height() - 200;
}

function operateFormatter(value, row, index) {
    return [
        '<a data-toggle="tooltip"  data-placement ="left" data-original-title ="View"  onclick="view_employee(' + row.id + ')" class="">' + row.employee_name + '</a> <BR>'+' Posted On <I>'+row.created_date+'</I> <br> Job Apply For:'+row.employee_job_title
    ].join('');
}

function operateFormatterCheck(value, row, index) {
    return [
        '<input data-index="0"  value ="' + row.id + '" class ="emplyee_id" name="btSelectItem" type="checkbox">'
    ].join('');
}

function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function(row) {
        return row.id
        console.log
    });
}



$(function() {

});
function rowAttributes(value, row, index) {
    return {
        classes: 'text-nowrap another-class',
        css: {
            "color": "blue",
            "font-size": "50px"
        }
    };
}function send_email() {

    var mail = $('#sendemail').val();
    var comment =$('#comment').val();
    if( mail == '')
    {
       $.alert({
        closeIcon: true,
        content:"Please enter email"
        });

      return true;
    }
    //alert(comment);
    var jc = $.confirm({
    backgroundDismiss: true,
    title: false, // hides the title.
    cancelButton: false, // hides the cancel button.
    confirmButton: false, // hides the confirm button.
    closeIcon: false, // hides the close icon.
    content:' <strong> Sending the Email...</strong>', // hides content block.
  });

    $.ajax({
        url: gBaseUrl+'/search/export?id='+checkedRows+'&email='+mail+'&type=email&msg='+comment,
        //data: datObj,
        dataType: 'json',
        method: 'POST',
        beforeSend:function(){
            $('#sendmail').modal('hide');
        },
        success: function(response) {
          jc.close();

        $.alert({
        closeIcon: true,
        content:response.msg
        });

            //$('.alert-success').html(response.msg).show();
        }
    });
     return false;

}

function export_data() {
    if (checkedRows.length) {
        window.open(gBaseUrl+'/search/export?id=' + checkedRows + '&type=export', '_blank');
    } else {
        alert("Please select some  resume to Export ");
    }
}

function responseHandler(res) {
    //selections['1984']
    $.each(res.rows, function(i, row) {
        row.state = $.inArray(row.id, selections) !== -1;
    });
    return res;
}

$(function() {
    $('#remove').click(function() {

    });
});
$(document).ready(function() {
    

    $('#skills').tagsinput({
        maxTags: 5
    });
    $('#sendemail').tagsinput({
        maxTags: 5
    });

});
</script>


  </body>
</html>
