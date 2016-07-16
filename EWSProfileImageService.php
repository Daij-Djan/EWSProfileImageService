<?php
$oncli = (php_sapi_name() === 'cli');

if($oncli) {
	//get server data
	$email = "dpich@sapient.com";//test
	$size = "HR48x48";//test
}
else {
	//get server data
	$email = $_GET["email"];
	$size = $_GET["size"];
}

$host = "webmail.sapient.com";//fix
$user = "TODO";//fix
$password = "TODO";//fix

$target = "https://".$host."/ews/Exchange.asmx/s/GetUserPhoto?email=".$email."&size=".$size;

//do curl call
function HandleHeaderLine( $curl, $header_line ) {
 	$new_line = strstr($header_line, "Content-Type: ");
	if($new_line)	
	  	header("Content-Type: " . $new_line);
    return strlen($header_line);
}

$ch = curl_init($target);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
if($oncli) {
	curl_setopt($ch, CURLOPT_VERBOSE, true);
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_HEADERFUNCTION, "HandleHeaderLine");

//this does the correct NTLM authentication 
curl_setopt($ch,CURLOPT_USERNAME, ANYUSER);
curl_setopt($ch,CURLOPT_USERNAME, ANYPWD);
curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$password);
curl_setopt($ch,CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
$output = curl_exec($ch);

//error handling
$curl_errno = curl_errno($ch);
$curl_error = curl_error($ch);
curl_close($ch);

if ($curl_errno > 0) {
	echo "cURL Error ($curl_errno): $curl_error\n";
}

//output
if($contentType) {
}
if(strlen($output)) {
	echo $output;
}
else {
	echo "<error>No Data</error>";
}
?>