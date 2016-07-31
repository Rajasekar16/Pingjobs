<?php echo $header; ?>
    <!-- Begin page content -->
    
    <div class="row">
      <div class="col-md-6">
        <div class="page-header">
        <h3 class="light">Employee Management</h3>
        </div>
      </div>
      
    </div>


    <div id="loading">  
   Please Wait ...<br />
   <img SRC ="<?php  echo SITE_URL ?>images/loading.gif"  alt="Processing" />
  </div>

    
<table id="eventsTable"  class ="table-striped"  style="display:none"     
       data-show-export="true"
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
        data-show-refresh="true"      >
    <thead>
    <tr>
       
        <th data-defaultsort="desc" data-sortable="true" data-field="id">id</th>
        <th data-field="employee_name">Name</th>        
        <th data-field="employee_skills">Skill</th>        
        <th data-field="expry">Exprience</th>        
    </tr>
   
    </thead>
</table>



      
    </div>

<?php echo $footer; ?>
<script type="text/javascript">  

                    $('#eventsTable').bootstrapTable({
                      url: '/index.php/admin/get_allemplyee',
                      method: 'post',
                      dataType:'json',
                    height: getHeight(),
                    onLoadSuccess: function(p){
                      // alert("hahah");
                      //console.log('ggggggggggg');
                      $('#loading').hide();
                      $('#eventsTable').show();
                    },

                    columns: [
                    {
                        field: 'id',
                        align: 'center',
                        valign: 'middle',
                        title: 'ID',
                        class :"col-md-1"
                    }, {
                        title: 'Name',
                        field: 'employee_name',
                        sortable: true,
                        class :"col-md-3",
                        formatter: operateFormatter
                    }, {
                        title: 'Skill',
                         field: 'employee_skills',
                         sortable: true,
                         class :"col-md-4"
                    },
                     {
                        title: 'Exprience',
                         field: 'expry',
                         sortable: true,
                         class :"col-md-2"
                    },
                    {
                        title: 'Details',
                         field: 'detail',
                         class :"col-md-3"
                    }
                    ],
                    }); 
    function getHeight() {
        return $(window).height() - 200;
    }
    function operateFormatter(value, row, index) {
       return [
       '<a data-toggle="tooltip"  data-placement ="left" data-original-title ="View"  onclick="view_employee('+row.id+')" class="">'+row.employee_name+'<a>'
        ].join('');
    }


    
</script>

  </body>
</html>
