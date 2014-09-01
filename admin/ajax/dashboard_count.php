<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$today = date('Y-m-d');

	$d_sql = "SELECT id FROM device_info";
	$d_result = mysql_query($d_sql);
	$c = mysql_num_rows($d_result);
	$result['d'] = ($d_result) ? $c : 0;

	$a_sql="SELECT id FROM app_info";
	$a_result=mysql_query($a_sql);
	$c = mysql_num_rows($a_result);	
	$result['a'] = ($a_result) ? $c : 0;

	$p_sql="SELECT id FROM pairing_info";
	$p_result=mysql_query($p_sql);
	$c = mysql_num_rows($p_result);	
	$result['p'] = ($p_result) ? $c : 0;

	$f_sql="SELECT id FROM fence_info";
	$f_result=mysql_query($f_sql);
	$c = mysql_num_rows($f_result);	
	$result['f'] = ($f_result) ? $c : 0;
	
	$d_sql = "SELECT id FROM device_info WHERE device_date >= '".$today."'";
	$d_result = mysql_query($d_sql);
	$c = mysql_num_rows($d_result);
	$result['td'] = ($d_result) ? $c : 0;

	$a_sql="SELECT id FROM app_info WHERE app_date >= '".$today."'";
	$a_result=mysql_query($a_sql);
	$c = mysql_num_rows($a_result);	
	$result['ta'] = ($a_result) ? $c : 0;

	$p_sql="SELECT id FROM pairing_info WHERE pairing_date >= '".$today."'";
	$p_result=mysql_query($p_sql);
	$c = mysql_num_rows($p_result);	
	$result['tp'] = ($p_result) ? $c : 0;

	$f_sql="SELECT id FROM fence_info WHERE create_date >= '".$today."'";
	$f_result=mysql_query($f_sql);
	$c = mysql_num_rows($f_result);	
	$result['tf'] = ($f_result) ? $c : 0;	

 echo json_encode($result);
 die;
?>