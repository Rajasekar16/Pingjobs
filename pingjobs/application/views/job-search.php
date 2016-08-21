<?php echo $header;
echo form_open('job/job_ajax',array('class'=>"form-horizontal","id"=>"searchJobs","onsubmit"=>"return false;"));
?>
    <!-- Begin page content -->
    <!-- Tag select reference http://timschlechter.github.io/bootstrap-tagsinput/examples/ -->
    <div class="container container-home signup-forms">
      <div class="row">
        <div class="col-md-2 pad-lt-0">
          <div class="sidebar">
            <h4 class="page-header">Refine Results</h4>
            <h5 class="page-header">Freshness</h5>
            <select id="last_days" class="selectbox width100" onchange="applyFilter()">
              <option value="">Select</option>
              <option value="30">Last 30 Days</option>
              <option value="15">Last 15 Days</option>
              <option value="7">Last 7 Days</option>
              <option value="3">Last 3 Days</option>
              <option value="1">Last 1 Day</option>
            </select>

            <h5 class="page-header tog-header transition" data-toggle="collapse" data-target="#sLocation"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>Location</h5>
            <div id="sLocation" class="collapse in">
              <ul class="list-group" id="location_filter">
                <?php
                if(count($location)>0)
                {
                  foreach($location as $row)
                  {?>
                  <li class="checkbox">
                  	<input onchange="applyFilter()" value="<?php echo $row['id']; ?>" <?php echo ($searchLocation == $row['id']) ? 'checked': ''; ?> class="check_location" type="checkbox" id="" />
                  	<label for="">
                  		<?php echo $row['name']; ?>
                  	</label>
                  </li>
                <?php }
                }
                ?>
              </ul>
            </div>

            <h5 class="page-header tog-header transition" data-toggle="collapse" data-target="#sIndustry"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>Industry</h5>
            <div id="sIndustry" class="collapse in">
              <ul class="list-group" id="industry_filter">
                <?php
                if(count($industry)>0)
                {
                  foreach($industry as $row)
                  {?>
                  	<li class="checkbox">
                  		<input class="check_industry" value="<?php echo $row['id']; ?>" type="checkbox" onchange="applyFilter()" id="<?php echo $row['id']; ?>" />
						<label ><?php echo $row['name']; ?></label>
					</li>
                <?php }
                }
                ?>
              </ul>
            </div>

            <h5 class="page-header tog-header transition" data-toggle="collapse" data-target="#sSalary"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span>Salary</h5>
            <div id="sSalary" class="collapse in">
              <ul class="list-group">
                <li class="checkbox"><input onchange="applyFilter()" class="check_salary" type="checkbox" id="salary-1" value="0-3" /> <label for="salary-1">0-3 Lakhs</label></li>
                <li class="checkbox"><input onchange="applyFilter()" class="check_salary" type="checkbox" id="salary-2" value="3-6" /> <label for="salary-2">3-6 Lakhs</label></li>
                <li class="checkbox"><input onchange="applyFilter()" class="check_salary" type="checkbox" id="salary-3" value="6-10" /> <label for="salary-3">6-10 Lakhs</label></li>
              </ul>
            </div>

          </div>
        </div>
        <div class="col-md-10 box">
          <h2 class="light page-header">Job Lists</h2>
              <div class="emp-job-sortby">
                Sort By: 
                  <select class="selectbox" onchange="sortBy(this.value)">
                    <option value="">Relavance</option>
                    <option value="post_date">Date</option>
                    <option value="location_name">Location</option>
                    <option value="industry_name">Industry</option>
                  </select>
              </div>
              <div id="job_list" class="col-md-12">
                
              </div>
        </div>
      </div>
    </div>
    <input type="hidden" value="<?php echo $searchSkills;?>" id="postSkills"/>
    <input type="hidden" value="<?php echo $searchLocation;?>" id="postLocation"/>
    <input type="hidden" value="<?php echo $searchIndustry;?>" id="postIndustry"/>
    <input type="hidden" value="<?php echo $searchOrderby;?>" id="postOrderby"/>
    <input type="hidden" value="<?php echo $searchExperience;?>" id="postExperience"/>
    <input type="hidden" value="<?php echo $searchJobType;?>" id="postJobsType"/>
    <input type="hidden" value="<?php echo $searchEducation;?>" id="postEducation"/>
    <input type="hidden" value="<?php echo @$employerId;?>" id="employer_id"/>
    <input type="hidden" value="" id="postLastDays"/>
    <input type="hidden" value="" id="postSalary"/>
</form>
<!-- <script type="text/javascript">
// gData=JSON.parse('<?php //echo $list; ?>');
// draw_jobs();
// job_filters();
</script>-->

<script type="text/javascript">
	function applyFilter()
	{
	  dom.getElementById('postLastDays').value=dom.getElementById('last_days').value;
	
	  var locationArr=get_checked_ids('check_location');
	  var searchLocation=locationArr.join();
	  dom.getElementById('postLocation').value=searchLocation;
	
	  var industryArr=get_checked_ids('check_industry');
	  var searchIndustry=industryArr.join();
	  dom.getElementById('postIndustry').value=searchIndustry;
	  
	  var salaryArr=get_checked_ids('check_salary');
	  var searchSalary=salaryArr.join();
	  dom.getElementById('postSalary').value=searchSalary;
	  onLoad();
	}
	
	function sortBy(val)
	{
	  dom.getElementById('postOrderby').value=val;
	  onLoad();
	}
	
	function onLoad()
	{
	    var skills = dom.getElementById('postSkills').value;
	    var location = dom.getElementById('postLocation').value;
	    var industry = dom.getElementById('postIndustry').value;
	    var experience = dom.getElementById('postExperience').value;
	    var last_days = dom.getElementById('postLastDays').value;
	    var orderby = dom.getElementById('postOrderby').value;
	    var salary = dom.getElementById('postSalary').value;
	    var employerId = dom.getElementById('employer_id').value;
	    var postJobsType = dom.getElementById('postJobsType').value;
	    var postEducation = dom.getElementById('postEducation').value;
	    var csrfTokenName = document.forms[0].csrf_token_name.value;
	    group_load = 0;
	    $.ajax({
	      url:base_url+"job/job_ajax",
	      data : { 'employer_id':employerId, 'job_type':postJobsType, 'education':postEducation, 'csrf_token_name':csrfTokenName, 'group_no':group_load, 'get_total_group':1, 'orderby':orderby, 'skills':skills, 'location':location, 'industry':industry, 'experience':experience, 'last_days':last_days, 'salary':salary },
	      type:'POST',
	      dataType:'json',
	      success:function(data){
	        drawData=draw_jobs_ajax(data.job); 
	        dom.getElementById('job_list').innerHTML=drawData;
	        total_group=data.total_group;
	        group_load++;
	      }
	    });
	}
	
	function lazzyLoad()
	{
	    var skills = dom.getElementById('postSkills').value;
	    var location = dom.getElementById('postLocation').value;
	    var industry = dom.getElementById('postIndustry').value;
	    var experience = dom.getElementById('postExperience').value;
	    var last_days = dom.getElementById('postLastDays').value;
	    var orderby = dom.getElementById('postOrderby').value;
	    var salary = dom.getElementById('postSalary').value;
	    var employerId = dom.getElementById('employer_id').value;
	    var postJobsType = dom.getElementById('postJobsType').value;
	    var postEducation = dom.getElementById('postEducation').value;
	    var csrfTokenName = document.forms[0].csrf_token_name.value;
	    $.ajax({
	      url:base_url+"job/job_ajax",
	      data : { 'employer_id':employerId,  'job_type':postJobsType, 'education':postEducation, 'csrf_token_name':csrfTokenName, 'group_no':group_load, 'orderby':orderby, 'skills':skills, 'location':location, 'industry':industry, 'experience':experience, 'last_days':last_days, 'salary':salary },
	      type:'POST',
	      dataType:'json',
	      success:function(data){
	        if(data.job.length>0)
	        {
	          drawData=draw_jobs_ajax(data.job); 
	          dom.getElementById('job_list').innerHTML+=drawData;
	        }
	          group_load++;
	      }
	    });
	}
	
	/*function onLoad(flag)
	{
	    var datas={'group_no':group_load}
	    if(flag)
	    {
	      datas['get_total_group']=1;
	    }
	    group_load = 0;
	    loading=false;
	    $.ajax({
	      url:base_url+"job/job_ajax",
	      data:datas,
	      type:'POST',
	      dataType:'json',
	      success:function(data){
	        drawData=draw_jobs_ajax(data.job);        
	        if(flag)
	        {
	          dom.getElementById('job_list').innerHTML=drawData;
	          total_group=data.total_group;
	        }else
	        {
	          if(data.job.length>0)
	          {
	            dom.getElementById('job_list').innerHTML+=drawData;
	          }
	        }
	        group_load++;
	        loading=true;
	      }
	    });
	}*/
	
	var group_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_group = -1;
	$(document).ready(function() {
	   //total record group(s)
	  onLoad();
	  
	  $(window).scroll(function() {
	    if($(window).scrollTop() + $(window).height() == $(document).height())
	    {
	      if(group_load <= total_group && loading==false) 
	      {
	        lazzyLoad();
	      }
	    }
	  });
	});
</script>
<?php echo $footer; ?>
  </body>
</html>