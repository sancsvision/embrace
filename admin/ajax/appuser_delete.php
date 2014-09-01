<?php
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
$id = isset($_POST['id']) ? $_POST['id'] : '' ;
if($id != ''){
$result['status'] = 'success';
	/*$d_sql = "DELETE * FROM app_info WHERE id= ".$id." ";
	$d_result = mysql_query($d_sql);
	if($d_result){
		$result['status'] = 'success';
	}*/
} 
 echo json_encode($result);
 die;
?>