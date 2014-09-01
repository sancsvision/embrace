<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$d = array();
$index = 1;
$id = isset($_POST['id']) ? $_POST['id'] : '' ;
if($id != ''){

	$d_sql = "SELECT child_display_name, child_display_image, device_contact FROM pairing_info WHERE parent_id= ".$id." ";
	$d_result = mysql_query($d_sql);
	if($d_result){
		$result['status'] = 'success';
		while ($r = mysql_fetch_array($d_result)){
			$e = array();
			$e['i']  = $index;
			$e['n']  = $r['child_display_name'];
			$e['im']  = '<img src="../apis/'.$r['child_display_image'].'" class="img-rounded" height="30" width="30" />' ;
			$e['c']  = $r['device_contact'];
			$d[] = $e;
			$index++;
		}
	}
	$result['l'] = $d;
} 
 echo json_encode($result);
 die;
?>