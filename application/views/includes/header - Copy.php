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

 
    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo SITE_URL;?>css/plugin.css" rel="stylesheet">

    <link href="<?php echo SITE_URL;?>css/datepicker.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo SITE_URL;?>css/ping.css" rel="stylesheet">
    <link href="<?php echo SITE_URL;?>css/bootstrap-table.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo SITE_URL;?>js/jquery.min.js"></script>
    <script src="<?php echo SITE_URL;?>js/plugin.js"></script>
    <script src="<?php echo SITE_URL;?>js/bootstrap.min.js"></script>
    <script src="<?php echo SITE_URL;?>js/ping.js"></script>
	<script src="<?php echo SITE_URL;?>js/bootstrap-table.min.js"></script>
	<script src="<?php echo SITE_URL;?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo SITE_URL;?>js/jquery.validate.min.js"></script>
  </head>
  <style>
  .errorBox
  {
    color: #f00;
  }

  </style>

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
          <!-- <a  href ="<?php echo  SITE_URL; ?>"class="navbar-brand">PING Jobs</a> -->
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <ul class="nav navbar-nav navbar-right">
            <?php
            $loggedin_employer=(isset($this->session->userdata['loggedin_employer'])?$this->session->userdata['loggedin_employer']['loginemployer']:false);
            $loggedin_employer_id=(isset($this->session->userdata['loggedin_employer'])?$this->session->userdata['loggedin_employer']['id']:false);
            $loggedin_user=(isset($this->session->userdata['loggedin_user'])?$this->session->userdata['loggedin_user']['loginuser']:false);
            $loggedin_id=(isset($this->session->userdata['loggedin_user'])?$this->session->userdata['loggedin_user']['user_id']:false);
             if($loggedin_employer){?>
              <li class="<?php echo ($this->uri->segment(1)=='search')?'active':''?>"><a a href="<?php  echo base_url('search') ?>">Search Resume</a></li>
              <li class="<?php echo ($this->uri->segment(1)=='job')?'active':''?>"><a href="/job/listjobs">Jobs</a></li>
             <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo @$this->session->userdata['loggedin_employer']['email'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href ="<?php echo SITE_URL.'Employer/my_profile/'.$loggedin_employer_id; ?>" ><i class="glyphicon glyphicon-star color-ccc"></i> My Profile</a></li>
                <!-- <li><a><i class="glyphicon glyphicon-user color-ccc"></i> Users</a></li>
                <li><a><i class="glyphicon glyphicon-cog color-ccc"></i> Settings</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li> -->
                <li><a href="<?php  echo SITE_URL;?>employer/logout"><i class="glyphicon glyphicon-log-out color-ccc"></i> Signout</a></li>
              </ul>
            </li> 
            <?php } else if($loggedin_user){?>
              <li class="<?php echo ($this->uri->segment(1)=='job')?'active':''?>"><a href="/job/jobsearch">Jobs</a></li>
             <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> <?php echo @$this->session->userdata['loggedin_user']['employee_email'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href ="<?php echo SITE_URL.'Employee/my_profile/'.$loggedin_id; ?>"><i class="glyphicon glyphicon-star color-ccc"></i> My Profile</a></li>
                <li><a href="<?php  echo SITE_URL;?>employee/logout"><i class="glyphicon glyphicon-log-out color-ccc"></i> Signout</a></li>
              </ul>
            </li>
            <?php }else {?>
              <li><a data-toggle="modal" data-target="#employerlogin"><i class="glyphicon glyphicon-briefcase"></i> Employer Login</a></li>
              <li><a data-toggle="modal" data-target="#employeelogin"><i class="glyphicon glyphicon-user"></i> Employee Login</a></li>
            <?php }?> 
            </ul>
        </div>

      </div>
    </nav>
    <div class="container">
    <!-- <div class="message-div"></div> -->
    </div>
