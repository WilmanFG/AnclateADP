<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Phpmailer/Exception.php';
    require 'Phpmailer/PHPMailer.php';
    require 'Phpmailer/SMTP.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'mrjgon23@gmail.com';                     // SMTP username
        $mail->Password   = 'cloroxps9';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('mrjgon23@gmail.com', 'Su contraseña es:', 'Administrador');
        $mail->addAddress('mrjgon23@gmail.com');     // Add a recipient
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'RECUPERACIÓN DE CUENTA DE ANCLATE';
        $mail->Body    = 'Hola este es tu token de contraseña ';
        $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
        $mail->send();
        echo 'El mensaje se envio correctamente';
    } catch (Exception $e) {
        echo "Hubo un error para enviar correo:", $mail->ErrorInfo;
    }
?>