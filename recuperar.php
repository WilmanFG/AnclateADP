<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <center><div class="container" style="margin: auto; position: relative; margin-top: 40px;">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-vertical" method="POST">
                        <fieldset>
                            <legend class="text-center header">Recuperar Contraseña</legend>   
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Enviar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div><center>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
<?php
    error_reporting(0);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Phpmailer/Exception.php';
    require 'Phpmailer/PHPMailer.php';
    require 'Phpmailer/SMTP.php';
    //Conexion
    $host = "localhost";
    $basededatos = "anclate";
    $usuariodb = "root";
    $clavedb = "";
    $conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);
    //Conexion
    if($conexion->connect_errno){
        echo '<script language="javascript">alert("Error en la conexion de la BDD");</script>';
        exit();
    }else{
    //echo $chain;
    $email = $_POST["email"];
    if($email == ""){
        echo '<script language="javascript">alert("No se captura nada");</script>';
    }else{
    $caracteres ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklnmopqrstuvwxyz0123456789';
    $r1 = rand(0,61);
    $r2 = rand(0,61);
    $r3 = rand(0,61);
    $r4 = rand(0,61);
    $r5 = rand(0,61);
    $r6 = rand(0,61);
    $r7 = rand(0,61);
    $r8 = rand(0,61);
    $r9 = rand(0,61);
    $r10 = rand(0,61);
    $chain = $caracteres[$r1] . $caracteres[$r2] . $caracteres[$r3] . $caracteres[$r4] . $caracteres[$r5] . $caracteres[$r6] . $caracteres[$r7] . $caracteres[$r8] . $caracteres[$r9] . $caracteres[$r10];
    $contra = password_hash($chain, PASSWORD_BCRYPT);
    $SELECT_SQL = "SELECT * FROM empleado WHERE correo = '". $email ."'";
    $consulta = mysqli_query($conexion,$SELECT_SQL);
    $num_rows = mysqli_num_rows($consulta);
    if($num_rows==0){
        echo '<center><div class="alert alert-danger" role="alert" style="width:40%; text-align:center;">Contraseña enviada correctamente</div><center>';
    }else{
        $UPDATE_SQL="UPDATE empleado SET contra = '". $contra ."' WHERE correo = '$email'";
        mysqli_query($conexion,$UPDATE_SQL);
        //echo '<center><div class="alert alert-primary" role="alert" style="width:40%; text-align:center;">Contraseña enviada correctamente</div><center>';
       
    }
    
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
        $mail->addAddress($email);     // Add a recipient
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'RECUPERACIÓN DE CUENTA DE ANCLATE';
        $mail->Body    = "<p style='font-size: 20px; color: #000000;'>Hola te saludamos desde Ánclate:</p><br> <p>Con esta contraseña podrás acceder a tu cuenta:</p><br> <strong><p>{$chain}</p><strong>";
        $mail->CharSet = 'UTF-8'; // Con esto ya funcionan los acentos
        $mail->send();
        echo '<div class="alert alert-primary" role="alert">Contraseña enviada correctamente</div>';
    } catch (Exception $e) {
        echo "Hubo un error para enviar correo:", $mail->ErrorInfo;
    }
}
    }
?>