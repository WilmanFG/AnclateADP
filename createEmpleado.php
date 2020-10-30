<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
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
        <link rel=StyleSheet HREF="css/style.css">
        <title>Anclate</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Anclate</h2>
                    <h3>Crear Empleado</h3>
                    
                    <br>

                    <?php
                    include_once "classes/Database.class.php";

                    if(isset($_POST["enviar"])){
                        //EXPRESIONES REGULARES
                        $regexDUI="/^[0-9]{8}-[0-9]{1}/";
                        $regexNombres="/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/";
                        $regexTel="/^[2,6,7]{1}[0-9]{3}-[0-9]{4}/";
                        
                        //VARIABLES
                        
                        $id = !empty($_POST["idEmpleado"]) ? $_POST["idEmpleado"] : "";
                        $dui = !empty($_POST["dui"]) ? $_POST["dui"] : "";
                        $nombres = !empty($_POST["nombres"]) ? $_POST["nombres"] : "";
                        $apellidos = !empty($_POST["apellidos"]) ? $_POST["apellidos"] : "";
                        $telefono = !empty($_POST["telefono"]) ? $_POST["telefono"] : "";
                        $idCargo = trim($_POST["idCargo"]);
                        $correo = !empty($_POST["correo"]) ? $_POST["correo"] : "";
                        $contra = !empty($_POST["contra"]) ? $_POST["contra"] : "";
                        $contra2 = !empty($_POST["contra2"]) ? $_POST["contra2"] : "";
                        $direccion = !empty($_POST["direccion"]) ? $_POST["direccion"] : "";
                        $contrasena_hash = "";
                        $idEstadoEmpleado = 1;
                        $database = new Database();
                        $errores = array();
                        $dbconnection = $database->create_connection();

                        //VALIDA QUE CAMPOS REQUERIDOS NO ESTEN EN BLANCO (SOLO LOS REQUERIDOS)
                        if(strlen($dui) == 0 || strlen($nombres) == 0 || strlen($apellidos) == 0 || strlen($telefono) == 0 || strlen($correo) == 0 || strlen($contra) == 0 || strlen($contra2) == 0 || strlen($direccion) == 0){
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no creado</h4>";
                                $message .= "<p>Datos Requeridos Vacíos.</p>";
                                $message .= "</div>";

                                echo $message;
                        }else{
                            
                            if(!preg_match($regexNombres,$nombres)){
                                array_push($errores, "Nombres");    
                            }
                            if(!preg_match($regexNombres,$apellidos)){
                                array_push($errores, "Apellidos");    
                            }
                            if(!preg_match($regexTel,$telefono)){
                                array_push($errores, "Teléfono");    
                            }
                            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                                array_push($errores, "Correo");    
                            }
                            if(!preg_match($regexDUI,$dui)){
                                array_push($errores, "DUI");    
                            }
                            if($contra == $contra2){
                                $contrasena_hash = password_hash($contra, PASSWORD_BCRYPT);
                            }else{
                                array_push($errores, "Contraseñas no coinciden");  
                            }

                            if(count($errores) > 0){
                                $message = "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no creado</h4>";
                                    $message .= "<p>Campos Ingresados Erroneamente</p>";
                                    $message .= "<ul>";
                                    foreach ($errores as $error) {
                                       $message .= "<li>" .$error. "</li>";
                                    }
                                    $message .= "</ul>";
                                    $message .= "</div>";
    
                                    echo $message;
                            }else{

                            
                        try
                        {


                            $sql = "INSERT INTO empleado (idEmpleado,nombres,apellidos,telefono,correo,dui,idCargo,idEstadoEmpleado,contra,direccion) VALUES (:idEmpleado,:nombres,:apellidos,:telefono,:correo,:dui,:idCargo,:idEstadoEmpleado,:contra,:direccion)";
                            $statement = $dbconnection->prepare($sql);
                            $statement->bindParam(":idEmpleado",$id);
                            $statement->bindParam(":nombres",$nombres);
                            $statement->bindParam(":apellidos",$apellidos);
                            $statement->bindParam(":telefono",$telefono);
                            $statement->bindParam(":correo",$correo);
                            $statement->bindParam(":dui",$dui);
                            $statement->bindParam(":idCargo",$idCargo);
                            $statement->bindParam(":idEstadoEmpleado",$idEstadoEmpleado);
                            $statement->bindParam(":contra",$contrasena_hash);
                            $statement->bindParam(":direccion",$direccion);
                            $statement->execute();

                            if($statement->rowCount() == 1)
                            {
                                $message = "<div class='alert alert-success' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-user-plus'></i> Usuario agregado</h4>";
                                $message .= "<p>Usuario agregado exitosamente.</p>";
                                $message .= "</div>";

                                echo $message;
                            }
                            else
                            {
                                $error = $dbconnection->errorInfo();
                                $message = "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no agregado</h4>";
                                $message .= "<p>Ocurrió un error procesando la consulta y no se pudo guardar el usuario. Por favor, inténtelo de nuevo. <br>";
                                $message .= "Descripción: " . $error[2] . " <br>";
                                $message .= "Código de error: " . $error[0] . "</p>";
                                $message .= "</div>";

                                echo $message;
                            }
                        }
                        catch(PDOException $e){
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no creado</h4>";
                            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo crear el usuario. Por favor, inténtelo de nuevo. <br>";
                            $message .= "Descripción: " . $e->getMessage() . " <br>";
                            $message .= "Código de error: " . $e->getCode() . "</p>";
                            $message .= "</div>";

                            echo $message;
                        }
                        finally{
                            $database->close_connection($dbconnection);    
                        }
                        }
                    }

                    }

                    $database = new Database();
                    $dbconnection = $database->create_connection();
                    

                    $sql = "SELECT * FROM cargo";
                    

                    $result = $dbconnection->query($sql);
                    

                    if($result->rowCount() >0)
                    {
                    ?>

                    <form method="POST">
                        <div class="form-group">
                            <label for="idEmpleado">ID Empleado: </label>
                            <input type="text" class="form-control" id="idEmpleado" name="idEmpleado">
                        </div>

                        <div class="form-group">
                            <label for="nombres">Nombres: </label>
                            <input type="text" class="form-control" id="nombres" name="nombres">
                        </div>

                        <div class="form-group">
                            <label for="apellidos">Apellidos: </label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos">
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono: </label>
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>

                        <div class="form-group">
                            <label for="correo">Correo: </label>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>

                        <div class="form-group">
                            <label for="dui">DUI</label>
                            <input type="text" class="form-control" id="dui" name="dui" placeholder="00000000-0">
                        </div>

                        <div class="form-group">
                            <label for="idCargo">Cargo: </label>
                            <select class="form-control" id="idCargo" name="idCargo">
                                <?php
                                foreach($result as $fila){
                                   
                                        echo "<option value='" . $fila["idCargo"] . "'>" . $fila["cargo"] . "</option>";    
                                   
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contra">Contraseña: </label>
                            <input type="password" class="form-control" id="contra" name="contra" placeholder="**********">
                        </div>
                        <div class="form-group">
                            <label for="contra2">Confirmar contraseña: </label>
                            <input type="password" class="form-control" id="contra2" name="contra2" placeholder="**********" onKeyUp="conErr()"> 
                            <label id="contraError"style="display:none">Contraseñas no coinciden</label>
                        </div>
                        
                        <div class="form-group">
                            <label for="dui">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion">
                        </div>

                        <button type="submit" class="btn btn-primary" name="enviar"><i class="fa fa-plus"></i> Agregar usuario</button>
                        <button type="reset" class="btn btn-warning"><i class="fa fa-ban"></i> Limpiar formulario</button>
                    </form>
                    <?php
                    }
                    else
                    {
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Disculpe las molestias</h4>";
                        $message .= "<p>En estos momentos no se puede agregar ningún usuario. Por favor, inténtelo de nuevo. </p>";
                        $message .= "</div>";
                        echo $message;
                    }
                    $database->close_connection($dbconnection);
                    ?>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="verEmpleados.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Listar usuarios</a>

                </div>
            </div>
        </div>

        <script type="text/javascript">

    function conErr()

    {

        var camp1= document.getElementById('contra');
        var camp2= document.getElementById('contra2');
        

        if (camp1.value != camp2.value) {

           document.getElementById("contraError").style.display="block";
        }else {
            document.getElementById("contraError").style.display="none";
        }
    }



</script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>