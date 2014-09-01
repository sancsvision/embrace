<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$d = array();


	$d_sql = "SELECT * FROM device_info";
	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['status'] = 'success';
		while ($r = mysql_fetch_array($d_result)){
			$e = array();
			$e['i'] = $r['device_udid'];
			$e['c'] = $r['contact_no'];
			$e['t'] = $r['device_type'];
			$e['d'] = date('m/d/Y', strtotime($r['device_date']));
			$d[] = $e;		
		}
	}
	$result['l'] = $d;
 echo json_encode($result);
 die;
?>