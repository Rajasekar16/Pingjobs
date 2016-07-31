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

    <title>Ping Jobs - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL;?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo SITE_URL;?>css/cover.css" rel="stylesheet">
    <link href="<?php echo SITE_URL;?>css/ping.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<div class="container">
		<div class="page-header">
			<h1>Ping jobs</h1>
		</div>
		<div class="message-div"></div>
		<div class="row">&nbsp;</div>
		<div class="site-wrapper">
		  <div class="site-wrapper-inner">
			<div class="cover-container">
			  <div class="masthead clearfix">
				<div class="inner">
				</div>
			  </div>
			<!-----CUSTOM MESSAGE START------>
			<?php echo validation_errors(); ?>
			<!-----CUSTOM MESSAGE END------>
			  <?php echo form_open("admin/login");?>
				<div class="inner cover">
				  <div class="form-group">
					<span> <i class="glyphicon glyphicon-lock"></i> Admin Login</span>
					</div>
				  <div class="form-group">
					<input id="username" name="username" type="email" placeholder="Email" class="form-control input-md" autofocus required />
				  </div>
				  <div class="form-group">
					<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required />
				  </div>
				  <div class="form-group">
					<input id="login" name="login" type="submit" value="Login" class="btn btn-crm-blue">
				  </div>
				</div>
			  </form>
				<div class="mastfoot">
					<div class="inner">
						<p class="text-center">&copy; Ping jobs-India</p>
					</div>
				</div>
			</div>
		  </div>
		</div>
    </div>
    <script src="<?php echo SITE_URL;?>js/jquery.min.js"></script>
    <script src="<?php echo SITE_URL;?>js/bootstrap.min.js"></script>
	<script src="<?php echo SITE_URL;?>js/jquery.validate.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	  $('form').validate();
	  $('.message-div').hide();
	  <?php if($this->session->flashdata('msg')){ ?>
	  $('.message-div').html('<?php echo $this->session->flashdata("msg"); ?>').show();
	  <?php } ?>
	});
	</script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
  </body>
</html>