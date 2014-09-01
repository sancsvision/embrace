<?php
$id = 0;
// My device token here (without spaces):
if(isset($_GET['id']) && $_GET['id'] != ''){
	$id = $_GET['id'];
}
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
// last location
// fence
// name 
// image

if($id >0){

	$d_sql  = '';
	$d_sql  = "SELECT p.child_id, p.child_display_name, p.child_display_image, a.device_token ";
	$d_sql .= "FROM pairing_info p ";
	$d_sql .= "JOIN app_info a ON a.id = p.parent_id ";
	$d_sql .= "WHERE p.id = ".$id;

	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['status'] = 'success';
		$r = mysql_fetch_array($d_result);
			$result['ci'] = $r['child_id'];
			$result['n'] = Ucfirst($r['child_display_name']);
			$result['img'] = $r['child_display_image'];
	}
//.................................................
	$d_sql  = '';
	$d_sql  = "SELECT f.name, f.measurement, f.type ";
	$d_sql .= "FROM fence_info f ";
	$d_sql .= "JOIN pairing_info p ON p.id = f.map_id ";
	$d_sql .= "WHERE p.id = ".$id;

	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['fence'] = 'success';
		while($r = mysql_fetch_array($d_result)){;
			$f = array();
			$f['n'] = Ucfirst($r['name']);
			$f['t'] = $r['type'];
			$arrMgmt = explode(',' , $r['measurement']);
			$f['lat']  = $arrMgmt[0];
			$f['long'] = $arrMgmt[1];
			$f['dist'] = $arrMgmt[2];
			$result['fencelist'][] = $f;
		}	
	}
//.......................................................	

	$d_sql  = '';
	$d_sql  = "SELECT l.lat_coord, l.long_coord, l.loc_date ";
	$d_sql .= "FROM location_info l ";
	$d_sql .= "JOIN pairing_info p ON p.child_id = l.child_id ";
	$d_sql .= "WHERE p.id = ".$id." ";
	$d_sql .= "ORDER BY l.loc_date DESC LIMIT 0,5 ";

	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['location'] = 'success';
		while($r = mysql_fetch_array($d_result)){;
			$l = array();
			$l['lat'] = $r['lat_coord'];
			$l['long'] = $r['long_coord'];
			$l['date'] = $r['loc_date'];
			$result['locationlist'][] = $l;
		}	
	}
	
 }
 echo json_encode($result);
 die;

?>