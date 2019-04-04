<?php
	/******  Base64 Functions  ******/
	function base64_url_encode($input){
		return strtr(base64_encode($input), '+/', '-_');
	}
	function encodeBase64($data){
		$data = base64_encode($data);
		return $data;
	}
	function base64_url_decode($input){
		return base64_decode(strtr($input, '-_', '+/'));
	}
	function decodeBase64($data){
		$data = base64_decode($data);
		return $data;
	}
	
function encrypt_3DES($message, $key){
		// Se establece un IV por defecto
		$bytes = array(0,0,0,0,0,0,0,0); //byte [] IV = {0, 0, 0, 0, 0, 0, 0, 0}
		$iv = implode(array_map("chr", $bytes)); //PHP 4 >= 4.0.2
		// Se cifra
		$ciphertext = mcrypt_encrypt(MCRYPT_3DES, $key, $message, MCRYPT_MODE_CBC, $iv); //PHP 4 >= 4.0.2
		return $ciphertext;
	}

$key = decodeBase64($_POST['$key']);
$message = $_POST['$message'];
$respuesta =encrypt_3DES($message, $key);
//$respuesta =utf8_encode(encrypt_3DES($message, $key));
$bodytag = encodeBase64($respuesta);

//header('Content-type:text/json;charset=utf-8');
header('Content-type:text/plain');
echo $bodytag;

?>
