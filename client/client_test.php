<?php

/* VARIABLES */
$serverUrl		= 'MOODLE URL';				//URL of your moodle instance homepage
$emailAddress	= 'USER EMAIL ADDRESS'; 	//of the user you want to send reset email for
$privateKey		= 'PRIVATE KEY'; 			//set in moodle as a plugin setting

/* MAKE PRIVATE KEY */
$encryptedKey 	= sha1(md5($emailAddress . $privateKey));
$serverUrl 		= trim($serverUrl, "/");		//removes trailing / in your serverUrl (just incase)
$serverUrl 		= $serverUrl.'/local/resetpassword/reset.php';

/* DATA FOR CURL REQUEST */
$postData = '';
$params = array(
	'e' => $emailAddress,
	'k' => $encryptedKey
);

foreach($params as $k => $v){ 
	$postData .= $k . '='.$v.'&'; 
}
rtrim($postData, '&');

/* SET CURL REQUEST */
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $serverUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_POST, count($postData));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

/* EXECUTE CURL & GET RESULT */
$output = curl_exec($ch);

/* CLOSE CURL */
curl_close($ch);

/* OUTPUT RESULT */
echo $output;

?>