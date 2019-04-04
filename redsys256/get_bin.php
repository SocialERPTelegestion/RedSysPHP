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
	
/******  MAC Function ******/
	function mac256($ent,$key){
		$res = hash_hmac('sha256', $ent, $key, true);//(PHP 5 >= 5.1.2)
		return $res;
	}
	
function encrypt_3DES($message, $key){
		// Se establece un IV por defecto
		$bytes = array(0,0,0,0,0,0,0,0); //byte [] IV = {0, 0, 0, 0, 0, 0, 0, 0}
		$iv = implode(array_map("chr", $bytes)); //PHP 4 >= 4.0.2
		// Se cifra
		$ciphertext = mcrypt_encrypt(MCRYPT_3DES, $key, $message, MCRYPT_MODE_CBC, $iv); //PHP 4 >= 4.0.2
		return $ciphertext;
	}
	
	function createMerchantSignature($key){//A modo de muestra
		// Se decodifica la clave 
		$key = $this->decodeBase64($key);
		// Se genera el parámetro Ds_MerchantParameters
		$ent = $this->createMerchantParameters();
		$order = $this->getOrder();
		// Se diversifica la clave con el Número de Pedido
		$key = $this->encrypt_3DES($order, $key);
		// MAC256 del parámetro Ds_MerchantParameters
		$res = $this->mac256($ent, $key);
		$result = $this->encodeBase64($res);
		// Se codifican los datos Base64
		return $result;
	}
	
		/******  Obtener Número de pedido ******/
	function getOrder(){
		$numPedido = strval(time());
		return $numPedido;
	}
	
	function generarFirma (){
		$key = decodeBase64($_POST['$key']);
		$message = $_POST['$message'];	
		$ent = $_POST['$DS_MerchantParameters'];
		$clave = encrypt_3DES($message, $key);
		$res = mac256($ent, $clave);
		$result = encodeBase64($res);
		header('Content-type:text/plain;charset=utf-8');
		return $result;
	}
	
	echo generarFirma ();
?>
