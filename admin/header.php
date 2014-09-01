<?php session_start(); 
     // include($path.'include/secureConnection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>emBrace : Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="*******">

	<!-- The styles -->
	<link id="bs-css" href="<?php echo $path ; ?>css/bootstrap-united.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo $path ; ?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo $path ; ?>css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo $path ; ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo $path ; ?>css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo $path ; ?>css/chosen.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo $path ; ?>css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>
	<?php if(!isset($no_visible_elements) || !$no_visible_elements)	{ ?>
	<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"> <img alt="Charisma Logo" src="img/logo20.png" /> <span>emBrace</span></a>
				
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse hide">
					<ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
	<?php } ?>
	<div class="container-fluid">
		<div class="row-fluid">
		<?php if(!isset($no_visible_elements) || !$no_visible_elements) { ?>
		
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="index.php"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a class="ajax-link" href="app-user.php"><i class="icon-edit"></i><span class="hidden-tablet"> App User</span></a></li>
						<li><a class="ajax-link" href="devices.php"><i class="icon-edit"></i><span class="hidden-tablet"> Devices</span></a></li>
						<li><a class="ajax-link" href="simulator.php"><i class="icon-eye-open"></i><span class="hidden-tablet"> Simulator</span></a></li>
						<!--
						<li><a class="ajax-link" href="fence.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Fence</span></a></li>
						<li class="nav-header hidden-tablet">Reports</li>
						<li><a class="ajax-link" href="dev_reports.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Devices</span></a></li>
						<li><a class="ajax-link" href="fence.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Fence</span></a></li>
						<li><a class="ajax-link" href="fence.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Fence</span></a></li>
						-->
						<li class="nav-header hidden-tablet">Settings</li>
						<li><a class="ajax-link" href="users.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Users</span></a></li>						
						<li><a class="ajax-link" href="roles.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Roles</span></a></li>
						<li><a class="ajax-link" href="messages.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Messages</span></a></li>
						<li><a class="ajax-link" href="actionitems.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Action Items</span></a></li>						
						<!--
						<li><a class="ajax-link" href="typography.php"><i class="icon-font"></i><span class="hidden-tablet"> Typography</span></a></li>
						<li><a class="ajax-link" href="gallery.php"><i class="icon-picture"></i><span class="hidden-tablet"> Gallery</span></a></li>
						<li class="nav-header hidden-tablet">Sample Section</li>
						<li><a class="ajax-link" href="table.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a class="ajax-link" href="calendar.php"><i class="icon-calendar"></i><span class="hidden-tablet"> Calendar</span></a></li>
						<li><a class="ajax-link" href="grid.php"><i class="icon-th"></i><span class="hidden-tablet"> Grid</span></a></li>
						<li><a class="ajax-link" href="file-manager.php"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
						<li><a href="tour.php"><i class="icon-globe"></i><span class="hidden-tablet"> Tour</span></a></li>
						<li><a class="ajax-link" href="icon.php"><i class="icon-star"></i><span class="hidden-tablet"> Icons</span></a></li>
						<li><a href="error.php"><i class="icon-ban-circle"></i><span class="hidden-tablet"> Error Page</span></a></li>
						<li><a href="login.php"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li>
						-->
					</ul>
					<label id="for-is-ajax" class="hidden-tablet hide" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			<?php } ?>
