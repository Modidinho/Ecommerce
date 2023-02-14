<?php
require '../../assets/libs/PHPMailer/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
  
$mail = new PHPMailer(true);



try
{
    $mail->SMTPDebug = 0;                   // Enable verbose debug output
    $mail->isSMTP();                        // Set mailer to use SMTP
    $mail->Host       = '';    // Specify main SMTP server
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = '';     // SMTP username
    $mail->Password   = 'Taitanfarm';         // SMTP password
    $mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
    $mail->Port       = 587;                // TCP port to connect to
    $mail->isHTML(true); 
    
    $mail->setFrom('', 'Taitan Farm System');           // Set sender of the mail
}
catch (Exception $e)
{
    exit('mail-not-sent');
}

?>