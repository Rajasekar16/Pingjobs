<header class="ping-header">
       <div class="ping-search-fprm container">
         <div class="form-group">
         <form id="searchFrm" action="<?php echo base_url(); ?>job/jobsearch" method="post">
            <div class="col-md-1 pad-ltrt-2">
            </div>
            <div class="col-md-3 pad-ltrt-2">
              <input id="skills" name="skills" type="text" value="<?php echo @$searchSkills;?>" placeholder="Enter Key Skills" class="form-control input-md">              
            </div>
            <div class="col-md-1 pad-ltrt-2">
              <select id="location" name="location" class="form-control">
                <option value="0">Location</option>
                <?php 
                foreach($location as $row)
                {?>
                <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-1 pad-ltrt-2">
              <select id="experience" name="experience" class="form-control">
                <option value="0">Experience</option>
                <?php 
                for($i=1;$i<10;$i++)
                {?>
                  <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-1 pad-ltrt-2">
            <a onclick="$('#searchFrm').submit()" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Search</a>
            </div>
          </form>
          </div>
       </div>
      </header>