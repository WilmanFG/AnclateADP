<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }

?>

<!doctype html>
<html lang="es">
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
                    <h1>Anclate Administrador</h1>
                    <h3>Editar Empleado</h3>
                    
                    <br>

                    <?php
                    include_once "classes/Database.class.php";
                    $exception = 0;
                    if(isset($_POST["enviar"])){
                        //EXPRESIONES REGULARES
                        $regexDUI="/^[0-9]{8}-[0-9]{1}/";
                        $regexNombres="/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/";
                        $regexTel="/^[2,6,7]{1}[0-9]{3}-[0-9]{4}/";
                        
                        //VARIABLES

                        
                        $idEmpleado = !empty($_POST["idEmpleado"]) ? $_POST["idEmpleado"] : "";
                        $dui = !empty($_POST["dui"]) ? $_POST["dui"] : "";
                        $nombres = !empty($_POST["nombres"]) ? $_POST["nombres"] : "";
                        $apellidos = !empty($_POST["apellidos"]) ? $_POST["apellidos"] : "";
                        $telefono = !empty($_POST["telefono"]) ? $_POST["telefono"] : "";
                        $idCargo = trim($_POST["idCargo"]);
                        $correo = !empty($_POST["correo"]) ? $_POST["correo"] : "";
                        $contra = !empty($_POST["contra"]) ? $_POST["contra"] : "";
                        $contra2 = !empty($_POST["contra2"]) ? $_POST["contra2"] : "";
                        $direccion = !empty($_POST["direccion"]) ? $_POST["direccion"] : "";
                        $idEstadoEmpleado = !empty($_POST["idEstadoEmpleado"]) ? $_POST["idEstadoEmpleado"] : "";
                        $errores = array();

                        $database = new Database();
                        $dbconnection = $database->create_connection();

                         //VALIDA QUE CAMPOS REQUERIDOS NO ESTEN EN BLANCO (SOLO LOS REQUERIDOS)
                         if(strlen($dui) == 0 || strlen($nombres) == 0 || strlen($apellidos) == 0 || strlen($telefono) == 0 || strlen($correo) == 0 || strlen($direccion) == 0){
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
                            if(strlen($contra) > 0){
                                if(strlen($contra2) > 0){
                                    if($contra == $contra2){
                                        $contrasena_hash = password_hash($contra, PASSWORD_BCRYPT);
                                    }else{
                                        array_push($errores, "Contraseñas no coinciden");  
                                    }
                                }else{
                                    array_push($errores, "Contraseña confirmación vacía");  
                                }
                            }else{
                                if(strlen($contra2) > 0){
                                    array_push($errores, "Contraseña vacía");  
                                }
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

                        try{
                            $sql="";
                            $statement = null;
                            if(!empty($contra))
                            {
                                $sql = "UPDATE empleado SET dui = ?, nombres = ?, apellidos = ?, correo = ?, idCargo = ?, telefono = ?, contra = ?, idEstadoEmpleado=?, direccion=?  WHERE idEmpleado = ?";
                                $statement = $dbconnection->prepare($sql);
                                $statement->bindParam(1,$dui);
                                $statement->bindParam(2,$nombres);
                                $statement->bindParam(3,$apellidos);
                                $statement->bindParam(4,$correo);
                                $statement->bindParam(5,$idCargo);
                                $statement->bindParam(6,$telefono);
                                $statement->bindParam(7,$contrasena_hash);
                                $statement->bindParam(8,$idEstadoEmpleado);
                                $statement->bindParam(9,$direccion);
                                $statement->bindParam(10,$idEmpleado);
                                
                            }
                            else
                            {
                                $sql = "UPDATE empleado SET dui = ?, nombres = ?, apellidos = ?, correo = ?, idCargo = ?, telefono = ?, idEstadoEmpleado=?, direccion=?  WHERE idEmpleado = ?";
                                $statement = $dbconnection->prepare($sql);
                                $statement->bindParam(1,$dui);
                                $statement->bindParam(2,$nombres);
                                $statement->bindParam(3,$apellidos);
                                $statement->bindParam(4,$correo);
                                $statement->bindParam(5,$idCargo);
                                $statement->bindParam(6,$telefono);
                                $statement->bindParam(7,$idEstadoEmpleado);
                                $statement->bindParam(8,$direccion);
                                $statement->bindParam(9,$idEmpleado);
                            }
                            
                            
                            $statement->execute();
                        }
                        catch(PDOException $e)
                        {
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no actualizado</h4>";
                            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el usuario. Por favor, inténtelo de nuevo. <br>";
                            $message .= "Descripción: " . $e->getMessage() . " <br>";
                            $message .= "Código de error: " . $e->getCode() . "</p>";
                            $message .= "</div>";

                            echo $message;
                            $exception = 1;
                        }
                        if($statement->rowCount() == 1)
                        {
                            $message = "<div class='alert alert-success' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-user-edit'></i> Usuario actualizado</h4>";
                            $message .= "<p>Usuario actualizado exitosamente.</p>";
                            $message .= "</div>";

                            echo $message;
                        }else{
                            if($exception==0)
                            {
                                $message = "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no actualizado</h4>";
                                $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el usuario. Por favor, inténtelo de nuevo. <br>";
                                $message .= "Descripción: " . $dbconnection->errorInfo()[2] . " <br>";
                                $message .= "Código de error: " . $dbconnection->errorInfo()[0] . "</p>";
                                $message .= "</div>";
    
                                echo $message;
                            }
                        }

                        $database->close_connection($dbconnection);
                        }
                    }
                    }

                    if(isset($_GET["id"])){

                        $idEmpleado = trim($_GET["id"]);

                        $database = new Database();
                        $dbconnection = $database->create_connection();

                        $sql = "SELECT * FROM empleado WHERE idEmpleado = ?";
                        $statement = $dbconnection->prepare($sql);
                        //vinculamos a los parámetros que vamos a enviar
                        $statement->bindParam(1,$idEmpleado);
                        $statement->execute();

                        $sql2 = "SELECT * FROM cargo";
                        $result = $dbconnection->query($sql2);

                        $sql3 = "SELECT * FROM estadoempleado";
                        $result3 = $dbconnection->query($sql3);

                        if($statement->rowCount() == 1)
                        {
                            $row=$statement->fetch();

                        ?>
                            <form method="POST">
                                <input type="hidden" class="form-control" id="idEmpleado" name="idEmpleado" readOnly value="<?php echo $row['idEmpleado'];?>">
                                <div class="form-group">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $row['nombres'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos: </label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"  value="<?php echo $row['apellidos'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="telefono">Teléfono: </label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="0000-0000" value="<?php echo $row['telefono'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="correo">Correo: </label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row['correo'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="dui">DUI: </label>
                                    <input type="text" class="form-control" id="dui" name="dui" placeholder="00000000-0" value="<?php echo $row['dui'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="idCargo">Cargo: </label>
                                    <select class="form-control" id="idCargo" name="idCargo">
                                        <?php
                                        foreach($result as $fila){
                                            if($fila["idCargo"] == $row["idCargo"])
                                            {
                                                echo "<option value='" . $fila["idCargo"] . "' selected>" . $fila["cargo"] . "</option>";    
                                            }
                                            else
                                            {
                                                echo "<option value='" . $fila["idCargo"] . "'>" . $fila["cargo"] . "</option>";
                                            }
                                            
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="idEstadoEmpleado">Estado Empleado: </label>
                                    <select class="form-control" id="idEstadoEmpleado" name="idEstadoEmpleado">
                                        <?php
                                        foreach($result3 as $fila){
                                            if($fila["idEstadoEmpleado"] == $row["idEstadoEmpleado"])
                                            {
                                                echo "<option value='" . $fila["idEstadoEmpleado"] . "' selected>" . $fila["estadoEmpleado"] . "</option>";    
                                            }
                                            else
                                            {
                                                echo "<option value='" . $fila["idEstadoEmpleado"] . "'>" . $fila["estadoEmpleado"] . "</option>";
                                                
                                            }
                                            
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="contra">Contraseña: </label>
                                    <input type="password" class="form-control" id="contra" name="contra" >
                                    <small>Si deja la contraseña vacía, no se actualizará</small>
                                </div>

                                <div class="form-group">
                                    <label for="contra2">Confirmar contraseña: </label>
                                    <input type="password" class="form-control" id="contra2" name="contra2" placeholder="**********" onKeyUp="conErr()"> 
                                    <label id="contraError"style="display:none">Contraseñas no coinciden</label>
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row['direccion'];?>">
                                </div>

                                <button type="submit" class="btn btn-primary" name="enviar"><i class="fa fa-edit"></i> Actualizar empleado</button>
                            </form>
                        <?php
                        }
                        else
                        {
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Error, no se encontró el empleado</h4>";
                            $message .= "<p>El usuario con id " . $idEmpleado . " no existe en la base de datos.</p>";
                            $message .= "</div>";

                            echo $message;
                        }

                        $database->close_connection($dbconnection);

                    }
                    ?>

                    
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="verEmpleados.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Listar Empleado</a>

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