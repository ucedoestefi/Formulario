<?php

$nombre = $_POST["nombre"]; //$_POST nos permite recuperar datos enviados desde formularios 
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$asunto = $_POST["asunto"];
$mensaje = $_POST["mensaje"];


//aca esta la solucion que faltaba
$archivo = $_FILES['archivo'];
//


$body = "Nombre: " . $nombre . "<br>Apellido: " . $apellido . "<br>Correo: " . $correo .  
"<br>Asunto: " . $asunto . "<br>Mensaje:" . $mensaje; // Se concatenen las variables y se usa <br> para 
                                                      //salto de linea

use PHPMailer\PHPMailer\PHPMailer; //usamos para enviar mail desde host local
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      							// Como se comporta a medida que creamos el correo. desactivado en 0
    $mail->isSMTP();                                      				// Protocolo que usamos para enviar SMTP
    $mail->Host       = 'smtp.gmail.com';                 				// El servidor del servicio que voy a usar
    $mail->SMTPAuth   = true;                             				// habilitar autenticacion SMTP 
	$mail->Username   = '@gmail.com'; 					 				// SMTP usuario que vamos a usar
    $mail->Password   = 'contraseña';                      				   		// SMTP contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   				// Habilitar encriptacion TLS; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587; //proba con este sino 465                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('juanm2587@gmail.com', $nombre); //aregue la variable $nombre	//Quien lo manda, desde mi correo,usuario
    $mail->AddAddress('juanm2587@gmail.com', $correo); //aregue la variable $correo           			// A quien se va a enviar el correo

    // Content
    $mail->isHTML(true);                                   						// Permite HTML
    $mail->Subject = $asunto; //aregue la variable $asunto          			//Asunto
    $mail->Body    = $body;  //agregue la variable $body						//Pongo la variable body, el cuerpo del msj
    
    // Adjuntos 


	//aca esta la solucion que faltaba
    $mail -> AddAttachment($archivo['tmp_name'], $archivo['name']);       // Agregar archivos adjuntos 
	//

	
    $mail->send();
    echo '<script>
        alert("El mensaje se envio correctamente");
        window.history.go(-1);
        </script>';                          //El -1 es para que regrese a la pagina
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}