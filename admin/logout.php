<?php
session_start();
$_SESSION['admincookieid'] = '';
$_SESSION['adminusername'] = '';
$_SESSION['adminusertype'] = '';
unset($_SESSION['admincookieid']);
unset($_SESSION['adminusername']);
unset($_SESSION['adminusertype']);
$red = '<script>window.location = "login.php" ; </script>' ;
print $red;
?>