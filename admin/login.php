<?php
session_start();
$msg = "Please login with your Username and Password.";
include('include/secureConnection.php'); 
if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != ''  ){
$msg = "Please login with correct credentials.";
$username= $_POST['username'];
$password= $_POST['password'];

$password = stripslashes($password);
$password = mysql_real_escape_string($password);
$username = stripslashes($username);
$username = mysql_real_escape_string($username);

//$password=md5($password);
$login_sql="SELECT * FROM user WHERE user='".$username."' and pwd='".$password."' ";
$login_result=mysql_query($login_sql);
$login_count=mysql_num_rows($login_result);
$sessionid= mt_rand();
	if($login_result == true && $login_count == 1){
		$_SESSION['admincookieid']=$sessionid;
		$_SESSION['adminusername']=$username;
		$_SESSION['adminusertype']='admin';		
		$login_red = '<script>window.location =  "index.php" ; </script>' ;
		print $login_red;
	}
}
$no_visible_elements=true;
      include('header.php'); 
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
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input usn='<?php echo $u ;?>' autofocus class="input-large span10" name="username" id="username" type="text" value="admin" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input pwd='<?php echo $p ;?>' class="input-large span10" name="password" id="password" type="password" value="password" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
							
							<p class="center span5">
							<a href='/embrace/admin/forgotPassword.php'>Forgot Password</a>
							</p>
							
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
<?php include('footer.php'); ?>