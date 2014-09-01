<?php
$name = 'Your child' ;
$deviceToken = '0be3dca58a08c098dc8231df2675dff382df1be1204b448a02f39ef89c2736e0';

// My device token here (without spaces):
if(isset($_GET['id']) && $_GET['id'] != ''){
$id = $_GET['id'];
include($_SERVER['DOCUMENT_ROOT']."/embrace/admin/include/secureConnection.php");
	$d_sql  = '';
	$d_sql  = "SELECT a.device_token,p.child_display_name ";
	$d_sql .= "FROM pairing_info p ";
	$d_sql .= "JOIN app_info a ON a.id = p.parent_id ";
	$d_sql .= "WHERE p.id = ".$id;

	$d_result = mysql_query($d_sql);
	if($d_result){
	$r = mysql_fetch_array($d_result);
	$deviceToken = $r['device_token'];
	$name = $r['child_display_name'];
	}
}




// My private key's passphrase here:
$passphrase = '1234';

// My alert message here:
$message = $name .' has moved out of fence.';
echo $message . PHP_EOL;
$pem = $_SERVER['DOCUMENT_ROOT']."/embrace/apis/include/ck.pem";

//badge
$badge = 1;

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', $pem);
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
    'ssl://gateway.sandbox.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
    'alert' => $message,
    'badge' => $badge,
    'sound' => 'newMessage.wav'
);

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result)
    echo 'Error, notification not sent' . PHP_EOL;
else
    echo 'notification sent!' . PHP_EOL;

// Close the connection to the server
fclose($fp);

?>