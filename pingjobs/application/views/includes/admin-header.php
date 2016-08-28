<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keyword" content="">
		<meta name="description" content="">
		<!-- <link rel="icon" href="favicon.ico"> -->

		<title>Ping Jobs - Admin</title>

		<?php echo $this->load->view('includes/common',array(),true); ?>

		<script>
		var base_url='<?php echo SITE_URL; ?>';
		var aster_url='<?php echo ASTER_URL; ?>';

		$(document).ready(function() {
			$('.message-div').hide();
			<?php if($this->session->flashdata('msg')){ ?>
			$('.message-div').html('<?php echo $this->session->flashdata("msg"); ?>').show();
			<?php } ?>
			
			$(".number-only").keypress(function (e){
				if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
				{
					$(this).next('.errorBox').html("Enter Number Only").show().fadeOut("slow").delay(6000);
					return false;
				}
			});
		});

		function clearAll(ele)
		{
			$(ele).closest('form').find("input[type=text], textarea,select,input[type=checkbox]").val("");
		}
		</script>
	</head>
	<body>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a  href ="<?php echo  SITE_URL; ?>"class="navbar-brand">PING Jobs</a> 
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">                
								<li>
									<a href=" <?php echo base_url('admin/logout') ?>">
										<i class="glyphicon glyphicon-log-out color-ccc"></i> Signout
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="<?php echo ($this->uri->segment(1)=='dashboard')?'active':''?>">
							<a href="<?php echo base_url('dashboard') ?>">Dashboard</a>
						</li>
						<li class="<?php echo ($this->uri->segment(2)=='employer')?'active':''?>">
							<a href="<?php echo base_url('admin/employer') ?>">Employer</a>
						</li>
						<!--  <li class="<?php echo ($this->uri->segment(2)=='employee')?'active':''?>">
							<a a href="<?php echo base_url('admin/employeenew') ?>">Employee</a>
						</li> -->
						<li class="<?php echo ($this->uri->segment(2)=='jobs')?'active':''?>">
							<a a href="<?php echo base_url('admin/jobs') ?>">Jobs</a>
						</li>
						<li class="<?php echo ($this->uri->segment(2)=='applied_job')?'active':''?>">
							<a a href="<?php echo base_url('admin/applied_job') ?>">Applied Jobs</a>
						</li>
						<li class="<?php echo ($this->uri->segment(1)=='search')?'active':''?>">
							<a a href="<?php  echo base_url('search') ?>">Search Resume</a>
						</li>
						<li class="dropdown <?php echo ($this->uri->segment(1)=='')?'active':''?>">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Masters <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url('admin/skillset') ?>">Primary Skills Master</a></li>
								<li><a href="<?php echo base_url('admin/education') ?>">Education Master</a></li>
								<li><a href="<?php echo base_url('admin/industry') ?>">Industry Master</a></li>
								<li><a href="<?php echo base_url('admin/functional') ?>">Functional Master</a></li>
								<li><a href="<?php echo base_url('admin/country') ?>">Country Master</a></li>
								<li><a href="<?php echo base_url('admin/state') ?>">State Master</a></li>
								<li><a href="<?php echo base_url('admin/location') ?>">Location Master</a></li>
								<!-- <li class="divider"></li> -->
								<!-- <li class="dropdown-header">Nav header</li> -->
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row"></div>
		</div>
		<div class="container pad-top-0" >
			<!--<div class="row">
				<div class="message-div"></div>
			</div>-->