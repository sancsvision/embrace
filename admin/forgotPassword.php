<?php
	$no_visible_elements=true;
	include('header.php'); 
	$msg = "Please enter your registered email-id";
?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome to emBrace</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
						<?php echo $msg ; ?>
					</div>
					<form class="form-horizontal" action="#" method="post">
						<fieldset>
							<div class="input-prepend" title="Email Id" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input usn='<?php echo $u ;?>' autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Submit</button>
							</p>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>