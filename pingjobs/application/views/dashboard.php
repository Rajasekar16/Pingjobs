<?php echo $header; ?>
<!-- MetisMenu CSS -->
<link href="<?php echo SITE_URL;?>dashboard-design/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

<!-- Timeline CSS -->
<link href="<?php echo SITE_URL;?>dashboard-design/dist/css/timeline.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="<?php echo SITE_URL;?>dashboard-design/dist/css/sb-admin-2.css" rel="stylesheet">

<!-- Morris Charts CSS -->
<link href="<?php echo SITE_URL;?>dashboard-design/bower_components/morrisjs/morris.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="<?php echo SITE_URL;?>dashboard-design/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>css/admin.css" rel="stylesheet">
<!-- Begin page content -->

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo @$count['employeecount']; ?></div>
						<div>Total Employee!</div>
					</div>
				</div>
			</div>
			<a href="<?php echo SITE_URL;?>search">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-green">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-user fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo @$count['employercount']; ?></div>
						<div>Total Employer!</div>
					</div>
				</div>
			</div>
			<a href="<?php echo SITE_URL;?>admin/employer">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-yellow">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-graduation-cap fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo @$count['jobcount']; ?></div>
						<div>Total Job Post!</div>
					</div>
				</div>
			</div>
			<a href="<?php echo SITE_URL;?>admin/jobs">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-red">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-graduation-cap fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge"><?php echo @$count['jobcount']; ?></div>
						<div>Total Applied Job!</div>
					</div>
				</div>
			</div>
			<a href="<?php echo SITE_URL;?>admin/applied_job">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Registration by Total
				<!--<div class="pull-right">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							Actions
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Action</a>
							</li>
							<li><a href="#">Another action</a>
							</li>
							<li><a href="#">Something else here</a>
							</li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a>
							</li>
						</ul>
					</div>
				</div>-->
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div id="morris-area-chart"></div>
			</div>
			<!-- /.panel-body -->
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Registration by Location (Bangalore,Chennai,Hyderabad,..)
				<!--<div class="pull-right">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							Actions
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li><a href="#">Vishakapatnam</a>
							</li> 
							<li><a href="#">Noida</a>
							</li>
							<li><a href="#">Mumbai</a>
							</li>
							<li><a href="#">Trivendram</a>
							</li>
							<li><a href="#">Pune</a>
							</li>
							<li class="divider"></li>
							<li><a href="#">Separated link</a>
							</li>
						</ul>
					</div>
				</div>-->
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div id="morris-area-location-chart"></div>
			</div>
			<!-- /.panel-body -->
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Registration by Skill (Testing,Java,.Net, PHP,..)
				<!--<div class="pull-right">
					<div class="btn-group">
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							Actions
							<span class="caret"></span>
						</button>
						
					</div>
				</div>-->
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div id="morris-area-skill-chart"></div>
			</div>
			<!-- /.panel-body -->
		</div>
	<!-- /.panel -->
	</div>
	<div class="col-lg-4">
		<!-- /.panel -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-bar-chart-o fa-fw"></i> Experience chat
			</div>
			<div class="panel-body">
				<div id="morris-donut-chart"></div>
				<a href="#" class="btn btn-default btn-block">View Details</a>
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<!-- /.panel .chat-panel -->
	</div>
	<!-- /.col-lg-4 -->
</div>
<br/>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo SITE_URL;?>dashboard-design/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo SITE_URL;?>dashboard-design/bower_components/raphael/raphael-min.js"></script>
<script src="<?php echo SITE_URL;?>dashboard-design/bower_components/morrisjs/morris.min.js"></script>
<script type="text/javascript">
	var ar = <?php echo $countdata ?>;
	var arlocation = <?php echo $locationdata ?>;
	var arskill = <?php echo $skilldata ?>;
	var arexprience = <?php echo $expriencedata ?>;
</script>
<script src="<?php echo SITE_URL;?>dashboard-design/js/morris-data.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo SITE_URL;?>dashboard-design/dist/js/sb-admin-2.js"></script>

<?php echo $footer; ?>