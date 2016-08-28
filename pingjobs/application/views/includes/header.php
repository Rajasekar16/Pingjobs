<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="favicon.ico"> -->

    <title>Ping Jobs</title>

	<?php echo $this->load->view('includes/common',array(),true); ?>
 
	<style>
	.errorBox
	{
		color: #f00;
	}
	</style>
  </head>

<script>
base_url='<?php echo base_url(); ?>';
aster_url='<?php echo ASTER_URL; ?>';
$(document).ready(function() {
  $('.message-div').hide();
  <?php if($this->session->flashdata('msg')){ ?>
  $('.message-div').html('<?php echo $this->session->flashdata("msg"); ?>').show();
  <?php } ?>
});


</script>
  <body>
  <?php
	$loggedin_employer=(isset($this->session->userdata['loggedin_employer'])?$this->session->userdata['loggedin_employer']['loginemployer']:false);
	$loggedin_employer_id=(isset($this->session->userdata['loggedin_employer'])?$this->session->userdata['loggedin_employer']['id']:false);
	$loggedin_user=(isset($this->session->userdata['loggedin_user'])?$this->session->userdata['loggedin_user']['loginuser']:false);
	$loggedin_id=(isset($this->session->userdata['loggedin_user'])?$this->session->userdata['loggedin_user']['user_id']:false);
  ?>
	<header class="ping-header-new">
		<div class="container">
			<div class="row">
				<div class="pingjobs-logo">
					<div class="col-md-3">
						<a href="<?php  echo SITE_URL;?>">
							<img src="<?php  echo SITE_URL;?>images/logo.png" class="img-polaroid">
						</a>
					</div>
					<div class="col-md-4">
					</div>
					<div class="col-md-5">
						<?php if(!$loggedin_employer && !$loggedin_user): ?>
						<a class="btn btn-primary ping-btn-primary" data-toggle="modal" data-target="#employerlogin">Employer Login</a>
						<a class="btn btn-primary ping-btn-primary" data-toggle="modal" data-target="#employeelogin">Employee Login</a>
						<?php elseif($loggedin_employer): ?>
						<a class="btn btn-primary ping-btn-primary" href="<?php echo SITE_URL.'Employer/my_profile'; ?>">
							<i class="glyphicon glyphicon-user"></i>
							<?php echo @$this->session->userdata['loggedin_employer']['email'];?>
						</a>
						<a class="btn btn-primary ping-btn-primary" href="<?php  echo SITE_URL;?>employer/logout">
							<i class="glyphicon glyphicon-log-out color-ccc"></i>
							Signout
						</a>
						<?php elseif($loggedin_user): ?>
						<a class="btn btn-primary ping-btn-primary" href="<?php echo SITE_URL.'employee/my_profile'; ?>">
							<i class="glyphicon glyphicon-user"></i>
							<?php echo @$this->session->userdata['loggedin_user']['employee_email'];?>
						</a>
						<a class="btn btn-primary ping-btn-primary" href="<?php  echo SITE_URL;?>employee/logout">
							<i class="glyphicon glyphicon-log-out color-ccc"></i>
							Signout
						</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</header>
    <!-- Fixed navbar -->
    <!--<nav class="navbar navbar-default navbar-fixed-top">-->
    <div class="static-height">
    <nav class="navbar navbar-default ping-navbar" data-spy="affix" data-offset-top="185">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a  href ="<?php echo  SITE_URL; ?>"class="navbar-brand">PING Jobs</a> -->
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav nav-margins">
          	  <li class="<?php echo ($this->uri->segment(4)=='it')?'active':''?>">
          	  	<a href="<?php  echo SITE_URL;?>job/jobsearch/industry/it">IT Jobs</a>
          	  </li>
              <li class="<?php echo ($this->uri->segment(4)=='bpo')?'active':''?>">
              	<a href="<?php  echo SITE_URL;?>job/jobsearch/industry/bpo">BPO</a>
              </li>
              <li class="<?php echo ($this->uri->segment(4)=='mba')?'active':''?>">
              	<a href="<?php  echo SITE_URL;?>job/jobsearch/education/mba">MBA</a>
              </li>
              <li class="<?php echo ($this->uri->segment(4)=='Govt-Jobs')?'active':''?>">
              	<a href="<?php  echo SITE_URL;?>job/jobsearch/jobs/Govt-Jobs">Govt</a>
              </li>
              <li class="<?php echo ($this->uri->segment(4)=='fresher')?'active':''?>">
             	 <a href="<?php  echo SITE_URL;?>job/jobsearch/jobs/fresher">Freshers</a>
              </li>
              <li class="<?php echo ($this->uri->segment(4)=='Walk-ins')?'active':''?>">
              	<a href="<?php  echo SITE_URL;?>job/jobsearch/jobs/Walk-ins">Walk-ins</a>
              </li>
             
            <?php
             if($loggedin_employer){?>
              <!--<li class="<?php echo ($this->uri->segment(1)=='search')?'active':''?>"><a a href="<?php  echo base_url('search') ?>">Search Resume</a></li>-->
              <li class="<?php echo ($this->uri->segment(1)=='job')?'active':''?>"><a href="<?php echo base_url();?>job/listjobs">Jobs</a></li>
			  <!-- <li>
				<a href ="<?php echo SITE_URL.'Employer/my_profile';//echo SITE_URL.'Employer/my_profile/'.$loggedin_employer_id; ?>" >
					<i class="glyphicon glyphicon-star color-ccc"></i> My Profile
				</a>
			  </li>
             <li class="dropdown pull-right">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              	<i class="glyphicon glyphicon-user"></i>
				<?php echo @$this->session->userdata['loggedin_employer']['email'];?>
				<span class="caret"></span>
			  </a>
              <ul class="dropdown-menu" role="menu">
                 <li><a><i class="glyphicon glyphicon-user color-ccc"></i> Users</a></li>
                <li><a><i class="glyphicon glyphicon-cog color-ccc"></i> Settings</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li> 
                <li><a href="<?php  echo SITE_URL;?>employer/logout"><i class="glyphicon glyphicon-log-out color-ccc"></i> Signout</a></li>
              </ul>
            </li> -->
            <?php } else if($loggedin_user){?>
              <li class="<?php echo ($this->uri->segment(1)=='job')?'active':''?>"><a href="<?php echo base_url();?>job/jobsearch">Jobs</a></li>
			 <!--  <li class="<?php echo ($this->uri->segment(2)=='my_profile')?'active':''?>"><a href ="<?php echo base_url().'Employee/my_profile/'.$loggedin_id; ?>"><i class="glyphicon glyphicon-star color-ccc"></i> My Profile</a></li>
             <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo @$this->session->userdata['loggedin_user']['employee_email'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php  echo SITE_URL;?>employee/logout"><i class="glyphicon glyphicon-log-out color-ccc"></i> Signout</a></li>
              </ul>
            </li>-->
            <?php }else {?>
              <!--<li><a data-toggle="modal" data-target="#employerlogin"><i class="glyphicon glyphicon-briefcase"></i> Employer Login</a></li>
              <li><a data-toggle="modal" data-target="#employeelogin"><i class="glyphicon glyphicon-user"></i> Employee Login</a></li>-->
            <?php }?> 
             <li><a>&nbsp;</a></li>
            </ul>
        </div>
      </div>
    </nav>
    </div>
    <!-- <div class="container">
		<div class="message-div"></div> 
    </div>-->
	<div class="container minHeight">
