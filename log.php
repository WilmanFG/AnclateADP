<?php
    session_start();

    if(isset($_SESSION["user"])){
        switch ($_SESSION["user"]["idCargo"]) {
            case 1:
                header("location:indexLogin.php");
                break;
            case 2:
                header("location:indexAc.php");
                break;
            case 3:
                header("location:indexVendedor.php");
                break;
        }

    }

?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/f6e8724f6b.js" crossorigin="anonymous"></script>
        <title>LOGIN</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Login</h1>

                    <br>
                    <?php
                        if(isset($_GET["e"]))
                        {
                            $message = "";
                            if($_GET["e"]==1)
                            {
                                $message .= "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Error</h4>";
                                $message .= "<p>Todos los campos son obligatorios</p>";
                                $message .= "</div>";
                            }

                            if($_GET["e"]==2)
                            {
                                $message .= "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Error</h4>";
                                $message .= "<p>La contraseña no es válida</p>";
                                $message .= "</div>";
                            }

                            if($_GET["e"]==3)
                            {
                                $message .= "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Error</h4>";
                                $message .= "<p>El Usuario no es válido</p>";
                                $message .= "</div>";
                            }
                            echo $message;
                        }



                    ?>
                    <div class="card">
                        <h5 class="card-header">Login</h5>
                        <div class="card-body">
                            <form action="login.php" method="POST">
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input type="text" class="form-control" id="correo" name="correo">
                                </div>
                                <div class="form-group">
                                    <label for="contra">Contraseña:</label>
                                    <input type="password" class="form-control" id="contra" name="contra">
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>



        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
