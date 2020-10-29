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

                        
                        $idEmpleado = trim($_POST["idEmpleado"]);
                        $nombres = trim($_POST["nombres"]);
                        $apellidos = trim($_POST["apellidos"]);
                        $telefono = trim($_POST["telefono"]);
                        $correo = trim($_POST["correo"]);
                        $dui = trim($_POST["dui"]);
                        $idCargo = trim($_POST["idCargo"]);
                        $idEstadoEmpleado = trim($_POST["idEstadoEmpleado"]);
                        $contra = trim($_POST["contra"]);
                        $direccion = trim($_POST["direccion"]);
                        
                        $contrasena_hash = password_hash($contra, PASSWORD_BCRYPT);

                        $database = new Database();
                        $dbconnection = $database->create_connection();

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
                        }
                        else
                        {
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
                                <input type="hidden" class="form-control" id="idEmpleado" name="idEmpleado" placeholder="00000000-0" readOnly value="<?php echo $row['idEmpleado'];?>">
                                <div class="form-group">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $row['nombres'];?>">
                                    <small id="emailHelp" class="form-text text-muted">Ingrese su dui sin guiones</small>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">Apellidos: </label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"  value="<?php echo $row['nombres'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="correo">Teléfono: </label>
                                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="0000-0000" value="<?php echo $row['telefono'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="apellidos">Correo: </label>
                                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $row['correo'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="usuario">DUI: </label>
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
                                    <label for="contrasena">Contraseña: </label>
                                    <input type="password" class="form-control" id="contra" name="contra" >
                                    <small>Si deja la contraseña vacía, no se actualizará</small>
                                </div>

                                <div class="form-group">
                                    <label for="dui">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion">
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

        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>