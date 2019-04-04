
                
<!--https://mailgun.com/sessions/new Ver implementación en residenciasAC-->
<?php
//include 'ChromePhp.php';
//    ChromePhp::log($_SERVER);
//       ChromePhp::log($_POST);

// $data is the example var, object; here an array.
    

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
/*
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
*/
    
session_start();

	$to = $_POST['mail_to']; // Replace with your email	
	$cc = 'f.caja@telegestion.com'; // Replace with your email	
	$subject = $_POST['subject'] . '('.$_POST['cuenta'].')';
	$headers = 'From: ' . $_POST['correoelectronico'] . "\r\n" . 'Reply-To: ' . $_POST['correoelectronico'] . "\r\n" .'Cc: ' . $cc . "\r\n";

    $headers .= "MIME-Version: 1.0\r\n";
//    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $headers .= "Content-Type: text/html; charset=UTF-8";

	if( $_POST['copy'] == 'on' )
	{
        
        $message =  'Alta en el SIT mediante: ' . $_POST['alta'] . "\n" .
                    'Nombre: ' . $_POST['nombre'] . " " . $_POST['apellidos'] . "\n" .
	               'Empresa: ' . $_POST['cuenta'] . "\n" .
	               'telefono: ' . $_POST['telefono'] . "\n" .
	               'Observaciones: ' . $_POST['observaciones'] . "\n" .
	               'E-mail: ' . $_POST['correoelectronico'] . "\n";   
//        $message = 'Alta en el SIT mediante: ' . $_POST['alta'] . "\n";
        $message =    $_POST['html'] . "\n"; 
//        $message .= 'JSON: ' . $_POST['json'];
		mail($to, $subject, $message, $headers);
	}else{
        
        $message = $_POST['json'];
       	mail($to, $subject, $message, $headers);
    }



?>