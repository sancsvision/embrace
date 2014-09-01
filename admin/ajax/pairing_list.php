<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$d = array();


	$d_sql = "SELECT p.id, p.child_display_name, p.child_display_image, p.device_contact, p.pairing_date, a.app_udid AS parent, d.device_udid AS child  FROM pairing_info p JOIN app_info a on a.id = p.parent_id JOIN device_info d on d.id = p.child_id ";
	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['status'] = 'success';
		while ($r = mysql_fetch_array($d_result)){
			$e = array();
			$e['id']  = $r['id'];
			$e['p']  = $r['parent'];
			$e['c']  = $r['child'];
			$e['cn'] = $r['child_display_name'];			
			$e['i']  = '<img src="../apis/'.$r['child_display_image'].'" class="img-rounded" height="30" width="30" />';
			$e['ct'] = $r['device_contact'];
			$e['d']  = date('m/d/Y', strtotime($r['pairing_date']));
			$d[] = $e;		
		}
	}
	$result['l'] = $d;
 echo json_encode($result);
 die;
?>