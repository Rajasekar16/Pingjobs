<?php echo $header; ?>
    <!-- Begin page content -->
	<div class="container container-home home-cats">
		<div class="row">
			<div class="col-md-2 pad-ltrt-0 mar-rt-0">
				<div class="home-aside" data-spy="affix" data-offset-top="185">
				  <h3>Jobs by Location</h3>
					<div class="box">
					  <ul>
						<?php foreach($location as $row) { ?>
							<li>
								<a href="<?php echo base_url(); ?>job/jobsearch/jobs-in/<?php echo strtolower($row['name']);?>">
									<?php echo ucfirst($row['name']);?>
								</a>
							</li>
						<?php } ?>
					  </ul>
					</div>
				</div>
			</div>
			<div class="col-md-6 pad-ltrt-0 home-margin border-left-2 border-right-2">
				<div id="myCarousel" class="carousel slide">
					<!--<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>-->
					<!-- Carousel items -->
					<div class="carousel-inner">
						<?php 
						if(empty($employer))
						{?>
							<div class="active item">
								<div class="text-center error"><?php echo "No employers found"; ?></div>
							</div>
						<?php }
						else
						{
							foreach ($employer AS $index=>$employers) { ?>
							<div class="<?php echo ($index==0) ? 'active' : ''; ?> item">
								<a href="<?php echo base_url(); ?>job/employer/<?php echo str_replace(" ","-",$employers['link']); ?>">
									<img src="./upload/logo/<?php echo $employers['logo'];?>" alt="<?php echo $employers['company_name'];?>" title="<?php echo $employers['company_name'];?>" />
								</a>
							</div>
						<?php } } ?>
					</div>
					<!-- Carousel nav -->
					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</div>
				<div id="premiumJobs" class="panel">
					<?php
					if(empty($jobs))
						echo "<center>No jobs found</center>";
					else {
						foreach($jobs as $job) { 
					?>
					<a href="<?php echo base_url(); ?>job/jobdetails/<?php echo @$job['job_name']; ?>">
						<div class="panel-body border-1 pad-lt-0">
							<div class="col-md-3">
								<img src="./upload/logo/<?php echo $job['company_logo']; ?>" alt="" title="" width="100" />
							</div>
							<div class="col-md-9 pad-lt-0">
								<div class="control-group">
									<label class="control-label col-md-12 pad-lt-0">
										<?php echo $job['job_title']; ?>
									</label>
								</div>
								<div class="control-group">
									<div class="controls col-md-12 pad-lt-0">
										<span class="help-inline"><?php echo $job['job_company_name']; ?></span>
									 </div>
								</div>
								<div class="clearfix">&nbsp;</div>
								<div class="control-group">
									<label class="control-label col-md-4 pad-lt-0">
										Location
									</label>
									<div class="controls col-md-8 pad-lt-0">
										: <span class="help-inline"><?php echo $job['location_name']; ?></span>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="control-group">
									<label class="control-label col-md-4 pad-lt-0">
										Key Skills
									</label>
									<div class="controls col-md-8 pad-lt-0">
										: <span class="help-inline"><?php echo $job['job_key_skill']; ?></span>
									 </div>
								</div>
								<div class="clearfix"></div>
								<div class="control-group">
									<label class="control-label col-md-4 pad-lt-0 pad-rt-0">
										Job Desecrition
									</label>
									<div class="controls col-md-8 pad-lt-0">
										: <span class="help-inline"><?php echo $job['job_desc']; ?></span>
									 </div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</a>
					<?php }
					} ?>
				</div>
			</div>
			<div class="col-md-3 pad-ltrt-0">
			    <div class="hero-unit home-aside"  data-spy="affix" data-offset-top="185">
					<?php
					echo form_open('login/subscribe',array('class'=>"form-horizontal","id"=>"postJob","onsubmit"=>"return postjob();"));
					?>
						<h3>To Get Job Alert </h3>
						<p>
							<input type="email" name="subscribe_email" class="form-control" placeholder="Email address" required title="Please enter email address" autofocus />
						</p>
						<?php echo $this->session->flashdata('msg'); ?>
						<p>
							<button type="submit" class="btn btn-primary btn-large">
								Subscribe
							</button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php echo $footer; ?>
	<script type="text/javascript">
		$('.carousel').carousel();
		$('.carousel .item').each(function(){
			var next = $(this).next();
			if(!next.length) {
				next=$(this).siblings(":first");
			}
			next.children(':first-child').clone().appendTo($(this));
			if(next.next().length > 0){
				next.next().children(':first-child').clone().appendTo($(this));
			}else{
				$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
			}
		});
		var loading  = false; //to prevents multipal ajax loads
		var noResult = false;
		var noOfJobs = $('#premiumJobs a').length;
		function lazzyLoad() {
		    $.ajax({
		      url	: "<?php echo base_url();?>?/login",
		      data	: { 'csrf_token_name':document.forms[0].csrf_token_name.value, 'noOfJobs':noOfJobs },
		      type	: 'POST',
		      dataType:'json',
		      success:function(data) {
			    loading = false;
		        if(data.jobs.length==0) {
		        	noResult = true;
		        	return false;
		        }
		        for(var x in data.jobs) {
		        	var htmlContent = $("#jobDet").html();
			        for(var y in data.jobs[x]) {
			        	var jobs = data.jobs[x][y];
			        	jobs = (y == 'company_logo') ? " src='./upload/logo/"+jobs+"' " : jobs;
					    htmlContent = htmlContent.replace('{'+y+'}',jobs);
			        }
				    $('#premiumJobs').append(htmlContent);
				    noOfJobs++;
		        }
		      }
		    });
		}
		$(document).ready(function() {
			$(window).scroll(function() {
			    if($(window).scrollTop() + $(window).height() == $(document).height()) {
			      if(noResult == false && loading==false) {
				      loading = true;
				      lazzyLoad();
			      }
			    }
			});
		});
	</script>
	<div id="jobDet" class="hide">
		<a href="<?php echo base_url(); ?>job/jobdetails/{job_name}">
			<div class="panel-body border-1 pad-lt-0">
				<div class="col-md-3">
				<object>
					<img {company_logo}" alt="Logo" title="" width="100" />
				</object>
				</div>
				<div class="col-md-9 pad-lt-0">
					<div class="control-group">
						<label class="control-label col-md-12 pad-lt-0">
							{job_title}
						</label>
					</div>
					<div class="control-group">
						<div class="controls col-md-12 pad-lt-0">
							<span class="help-inline">{job_company_name}</span>
						 </div>
					</div>
					<div class="clearfix">&nbsp;</div>
					<div class="control-group">
						<label class="control-label col-md-4 pad-lt-0">
							Location
						</label>
						<div class="controls col-md-8 pad-lt-0">
							: <span class="help-inline">{location_name}</span>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="control-group">
						<label class="control-label col-md-4 pad-lt-0">
							Key Skills
						</label>
						<div class="controls col-md-8 pad-lt-0">
							: <span class="help-inline">{job_key_skill}</span>
						 </div>
					</div>
					<div class="clearfix"></div>
					<div class="control-group">
						<label class="control-label col-md-4 pad-lt-0 pad-rt-0">
							Job Desecrition
						</label>
						<div class="controls col-md-8 pad-lt-0">
							: <span class="help-inline">{job_desc}</span>
						 </div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</a>
	</div>
  </body>
</html>
