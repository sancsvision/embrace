<?php
$id = 0;
// My device token here (without spaces):
if(isset($_GET['id']) && $_GET['id'] != ''){
	$id   = $_GET['id'];
	$lat  = $_GET['lat'];
	$long = $_GET['long'];
}
$child_id = '';
$name = '';
$token = '';
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
$result = array();
$result['status'] = 'fail';
if($id >0){

	$d_sql  = '';
	$d_sql  = "SELECT p.child_id, p.child_display_name, a.device_token ";
	$d_sql .= "FROM pairing_info p ";
	$d_sql .= "JOIN app_info a ON a.id = p.parent_id ";
	$d_sql .= "WHERE p.id = ".$id;

	$d_result = mysql_query($d_sql);
	if($d_result){
	$result['status'] = 'success';
		$r = mysql_fetch_array($d_result);
			$child_id = $r['child_id'];
			$name = Ucfirst($r['child_display_name']);
			$token = $r['device_token'];
	}
	if($child_id != ''){
	$arrLoc = array();
		$sql = "INSERT INTO location_info (child_id, lat_coord, long_coord) values(".$child_id.", ".$lat.", ".$long.")";
		$d_result = mysql_query($sql);
		if($d_result){
			$sql = 'SELECT p.parent_id, p.child_display_name, p.child_display_image, p.device_contact, f.name, f.measurement, f.type FROM fence_info f JOIN pairing_info p on p.id = f.map_id WHERE p.child_id = '.$child_id.' ';
			$d_result = mysql_query($sql);
			if($d_result){
				while($r = mysql_fetch_array($d_result)){
					$measurement = $r['measurement'];
					$type = $r['type'];
					$f_name = $r['name'];
	
					$verifyMsg = verifyChildLocation($lat, $long, $measurement, $type, $name, $token, $f_name);
					$arrLoc[] 	 	= $verifyMsg;
				}
			}
		}
		$result['tok'] = $token;
		$result['msg'] = $arrLoc;
	}
 }
 echo json_encode($result);
 die;

 
 function verifyChildLocation($lat, $long, $measurement, $type, $name, $token, $f_name) {
		$message = 'Invalid fence.'; 
		if($type == 'CIRCLE'){
			$arrMgmt = explode(',' , $measurement);
			$latCenter 	= $arrMgmt[0];
			$longCenter = $arrMgmt[1];
			$disCenter 	= $arrMgmt[2]; // unit is meter 
			// calculation
			$radEarth = 6371000; // unit is meter
			
			//  Vincenty formula: start
			$latFrom = deg2rad($latCenter);
			$lonFrom = deg2rad($longCenter);
			$latTo = deg2rad($lat);
			$lonTo = deg2rad($long);

			$lonDelta = $lonTo - $lonFrom;
			$a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
			$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
			$angle = atan2(sqrt($a), $b);
			$distance =  $angle * $radEarth;
			//  Vincenty formula: end
			$gapDistance = $distance -$disCenter ;
			$message = $name .'`s current location is  inside '.$f_name.' boundary.';
			if(0 <= $gapDistance){
				$message = $name .'`s current location is  '.$gapDistance.' meter away from '.$f_name.' boundary.'; // My alert message here:			
				// notification
				$passphrase = '1234';// My private key's passphrase here:

				$pem = $_SERVER['DOCUMENT_ROOT']."/embrace/apis/include/ck.pem";
				$badge = 1; //badge

				$ctx = stream_context_create();
				stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);
				stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

				// Open a connection to the APNS server
				$fp = stream_socket_client(
					'ssl://gateway.sandbox.push.apple.com:2195', $err,
					$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
				if ($fp){
				// Create the payload body
					$body['aps'] = array(
						'alert' => $message,
						'badge' => $badge,
						'sound' => 'newMessage.wav'
					);
					$payload = json_encode($body)  ; // Encode the payload as JSON
					// Build the binary notification
					$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
					// Send it to the server
					$result = fwrite($fp, $msg, strlen($msg));
				}	
				// Close the connection to the server
				fclose($fp);
			}
		}
		return $message ;
	}	
	
?>