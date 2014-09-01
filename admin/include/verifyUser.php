<?php
$sesid="".$_SESSION['admincookieid'] ."" ;
$usertype="".$_SESSION['adminusertype']."";
if($sesid != "" && $usertype == 'admin'){
}else{
    $red_windowsClose = '<script>window.location = "http://www.embrace4u.com/embrace/admin/login.php" ; </script>' ;
    print $red_windowsClose;
}	
?>
