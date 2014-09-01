<?php 
	$batteryPerc	= 0 ;
	include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");

// list all pairing
// verify settings: location, battery, emergency, sms
// verify last sent notification
// prepare messages
// sent notification

	$sql = "SELECT p.id, parent_id, child_id, child_display_name, device_contact, mode, alert, notification_time, device_token FROM pairing_info p JOIN app_info a ON a.id = p.parent_id ORDER BY p.id ASC";
	$result = mysql_query($sql);
	if($result){
		while($r = mysql_fetch_array($result)){

			$map_id 		= $r['id'];
			$parent_id 		= $r['parent_id'];
			$child_id 		= $r['child_id'];
			$name 			= Ucfirst($r['child_display_name']);
			$contact		= $r['device_contact'];
			$token			= $r['device_token'];
			$battery		= $r['mode'][0];
			$emergency		= $r['mode'][1];
			$sms			= $r['mode'][2];
			$alert			= $r['alert'];
			$not_time		= ( $r['notification_time'] != NULL ) ? strtotime($r['notification_time']) : 0;
			$curr_time      = strtotime( date('Y-m-d h:i:s a') ); 
			//echo $r['notification_time'].'--'.$not_time.'=='.date('Y-m-d h:i:s').'--'. $curr_time.'-'.($curr_time - $not_time).'--'.$alert.'</br>' ;
			if($alert > 0 ){ 
			
				$msg = 'Name- '.$name.'.'; echo ($alert * 60).''.($curr_time - $not_time);
				if( ($alert * 60) < ($curr_time - $not_time) ){
			
					$s = "SELECT lat_coord, long_coord, battery, loc_date FROM location_info WHERE child_id = ".$child_id." ORDER BY loc_date LIMIT 0,1 ";
					$r = mysql_query($s);
					if($r){
						$r = mysql_fetch_array($r) ;
						$lat  = $r['lat_coord'];
						$long = $r['long_coord'];
						$batteryPerc = $r['battery'];
						$loc_date = date( 'm/d/Y h:i:s A', strtotime($r['loc_date']) );
						
						//$msg .= "Location on ".$loc_date."'- ( ".$lat.', '.$long.' ).';	
						$address = getAddressFromLatLong($lat, $long);
						$msg .= "Location on ".$loc_date."'- ( ".$address.' ).';							
					/*	$sf = 'SELECT name, measurement, type FROM fence_info WHERE app_id = '.$parent_id.' ';
						$rf = mysql_query($sf);
						if($rf){
							$mf = '';
							$nrow = mysql_num_rows($rf);
							while($rw = mysql_fetch_array($rf)){
								$f_name = $rw['name'];
								$measurement = $rw['measurement'];	
								$type = $rw['type'];	

								$m = verifyChildLocation($lat, $long, $measurement, $type, $f_name);							
								$mf .= $m.' and ';								
							}
							$mf = substr($mf, 0, -4);
							//..........
							$mf = substr($mf, 0, -2);
							$search = ',';
							$replace = ', and';
							$mf =  strrev(implode(strrev(' and '), explode(',', strrev($mf), 2)));
							//..........
							$msg .= $mf.'.';
						}
					*/	
					}				
						
					if($battery == 1){
						$msg .= 'The battery level - '. $batteryPerc.'% .';		
					}		
					if($sms == 1){
						$msg .= 'An SMS is also sent to '. $contact.' .';		
					}
					$msg .= 'Thank you.';
					echo "</br>".$msg.'-'.$token;
					if($token != '' || $token != NULL){
						sentNotification($msg, $token);
						$curr_time = date('Y-m-d h:i:s a', $curr_time);
						$su = 'UPDATE pairing_info SET notification_time = "'.$curr_time.'" WHERE id = '.$map_id.''; 
						mysql_query($su);
						
					}

				}

			} 
			//echo $msg ;
		}	

	}
	
	
	function verifyChildLocation($lat, $long, $measurement, $type, $f_name) {
		$message = ''; 
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
			$gapDistance = $distance - $disCenter ;
			$gapDistance = number_format((float)$gapDistance, 2, '.', '');
			if(0 <= $gapDistance){
				$message =  $gapDistance. ' m  inside '.$f_name.' boundary';		
			}else{
				$message =  $gapDistance. ' m  outside '.$f_name.' boundary';	
			}
		}
		return $message ;
	}	
	
	function sentNotification($message, $token){
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

	function getAddressFromLatLong($lat, $long){
		$address = '';
		$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=true";
		$data = @file_get_contents($url);
		$jsondata = json_decode($data,true);
		if(is_array($jsondata) && $jsondata['status'] == "OK")
		{
			$address= $jsondata['results'][0]['formatted_address'];
		}
		return $address;
	}	
?>
