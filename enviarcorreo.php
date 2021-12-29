<?php
$suscriptor = htmlspecialchars($_POST['s'],ENT_QUOTES,'UTF-8');
$email = htmlspecialchars($_POST['e'],ENT_QUOTES,'UTF-8');
$contenido = htmlspecialchars($_POST['c'],ENT_QUOTES,'UTF-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    $mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
	);
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'juandiegovelan2004@gmail.com';                     // SMTP username
    $mail->Password   = 'velandia2004';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('juandiegovelan2004@gmail.com', 'JUAN DIEGO VELANDIA ');
    $mail->addAddress($email, $suscriptor);     // Add a recipient             

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'BIENVENIDO A NUESTRO SERVICIO DE ALQUILER'.$suscriptor;
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <table style="border: 1px solid black;width: 100%;">
            <thead>
                <tr>
                    <td style="text-align: center;background: red;color:#FFFFFF" colspan="2">
                        <h1><b>SU PRODUCTO SE SEPARO CON EXITO '.$suscriptor.'</b></h1>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" width="20%">
                        <img src="https://ibb.co/1mPzLmD/" alt="">
                    </td>
                    <td style="text-align: left;" align="justify"><span style="font-size: 25px;">MUCHAS GRACIAS POR USAR NUESTRO SISTEMA DE PRESTAMOS</span></td>
                </tr>
            </thead>
        </table>
    </body>
    </html>';

    $mail->send();
    echo 1;
} catch (Exception $e) {
    echo 0;
}