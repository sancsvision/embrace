<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$id = isset($_POST['id']) ? $_POST['id'] : '' ;
$contact = isset($_POST['contact']) ? $_POST['contact'] : '' ;
$status = isset($_POST['status']) ? $_POST['status'] : '' ;
$status = ($status == 'Active') ? 1 : 0;
if($id != ''){

	$d_sql = "UPDATE app_info SET contact_no= ".$contact.", status= ".$status."  WHERE id= ".$id." ";
	$d_result = mysql_query($d_sql);
	if($d_result){
		$result['status'] = 'success';
	}
} 
 echo json_encode($result);
 die;
?>