<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$d = array();
$index = 1;


	$d_sql = "SELECT id,contact_no, status, app_date FROM app_info ";
	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['status'] = 'success';
		while ($r = mysql_fetch_array($d_result)){
			$e = array();
			$e['i']  = $index;
			$e['id']  = $r['id'];
			$e['c']  = $r['contact_no'];
			$e['s']  = ($r['status'] == 1) ? 'Active' : 'Inactive';
			$e['d']  = date('m/d/Y h:i:s a', strtotime($r['app_date']));
			$d[] = $e;
			$index++;
		}
	}
	$result['data'] = $d;
 echo json_encode($result);
 die;
?>