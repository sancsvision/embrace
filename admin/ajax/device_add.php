<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';

	$i = isset($_POST['i']) ? $_POST['i'] : '';
	$c = isset($_POST['c']) ? $_POST['c'] : '';
	$t = isset($_POST['t']) ? $_POST['t'] : '';
	if($i != '' && $c != '' && $t != '' )
	$d_sql = "INSERT INTO `device_info` (`device_udid`, `contact_no`, `device_type`) VALUES ('".$i."', '".$c."', '".$t."' )";
	$d_result = mysql_query($d_sql);
	if($d_result){
		$result['status'] = 'success';
	}
 echo json_encode($result);
 die;
?>