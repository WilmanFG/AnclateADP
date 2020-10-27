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
                    <h3>Editar Producto</h3>
                    
                    <br>

                    <?php
                    include_once "classes/Database.class.php";
                    $exception = 0;
                    if(isset($_POST["enviar"])){

                        
                        $idProducto = trim($_POST["idProducto"]);
                        $nombre = trim($_POST["nombre"]);
                        $descripcion = trim($_POST["descripcion"]);
                        $stock = trim($_POST["stock"]);
                        $idTipoProducto = trim($_POST["idTipoProducto"]);
                        $idMedida = trim($_POST["idMedida"]);

                        $database = new Database();
                        $dbconnection = $database->create_connection();

                        try{
                            $sql="";
                            $statement = null;
                            
                                $sql = "UPDATE producto SET nombre = ?, descripcion = ?, stock = ?, idTipoProducto = ?, idMedida = ? WHERE idProducto = ?";
                                $statement = $dbconnection->prepare($sql);
                                $statement->bindParam(1,$nombre);
                                $statement->bindParam(2,$descripcion);
                                $statement->bindParam(3,$stock);
                                $statement->bindParam(4,$idTipoProducto);
                                $statement->bindParam(5,$idMedida);
                               
                                $statement->bindParam(6,$idProducto);
                          
                            
                            
                            $statement->execute();
                        }
                        catch(PDOException $e)
                        {
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                            $message .= "Descripción: " . $e->getMessage() . " <br>";
                            $message .= "Código de error: " . $e->getCode() . "</p>";
                            $message .= "</div>";

                            echo $message;
                            $exception = 1;
                        }
                        if($statement->rowCount() == 1)
                        {
                            $message = "<div class='alert alert-success' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-user-edit'></i> Producto actualizado</h4>";
                            $message .= "<p>Producto actualizado exitosamente.</p>";
                            $message .= "</div>";

                            echo $message;
                        }
                        else
                        {
                            if($exception==0)
                            {
                                $message = "<div class='alert alert-danger' role='alert'>";
                                $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                                $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                                $message .= "Descripción: " . $dbconnection->errorInfo()[2] . " <br>";
                                $message .= "Código de error: " . $dbconnection->errorInfo()[0] . "</p>";
                                $message .= "</div>";
    
                                echo $message;
                            }
                        }

                        $database->close_connection($dbconnection);

                    }

                    if(isset($_GET["id"])){

                        $idProducto = trim($_GET["id"]);

                        $database = new Database();
                        $dbconnection = $database->create_connection();

                        $sql = "SELECT * FROM producto WHERE idProducto = ?";
                        $statement = $dbconnection->prepare($sql);
                        //vinculamos a los parámetros que vamos a enviar
                        $statement->bindParam(1,$idProducto);
                        $statement->execute();

                        $sql2 = "SELECT * FROM tipoProducto";
                        $sql3 = "SELECT * FROM medida";
                    
                        $result = $dbconnection->query($sql2);
                        $result2 = $dbconnection->query($sql3);

                        if($statement->rowCount() == 1)
                        {
                            $row=$statement->fetch();

                        ?>
                            <form method="POST">
                                <input type="hidden" class="form-control" id="idProducto" name="idProducto" value="<?php echo $row['idProducto'];?>">
                                <div class="form-group">
                                    <label for="producto">Producto:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="descripcion">Descripción: </label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"  value="<?php echo $row['descripcion'];?>">
                                </div>


                                <div class="form-group">
                                    <label for="stock">Stock: </label>
                                    <input type="stock" class="form-control" id="stock" name="stock" value="<?php echo $row['stock'];?>">
                                </div>

                                <div class="form-group">
                            <label for="idTipoProducto">Categoría: </label>
                            <select class="form-control" id="idTipoProducto" name="idTipoProducto">
                                <?php
                                foreach($result as $fila){
                                   if($fila["idTipoProducto"] == $row["idCargo"]){
                                        echo "<option value='" . $fila["idTipoProducto"] . "' selected>" . $fila["tipoProducto"] . "</option>";    
                                    }else{
                                        echo "<option value='" . $fila["idTipoProducto"] . "'>" . $fila["tipoProducto"] . "</option>";    
                                    }
                                }
                                ?>
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="idCargo">Medida: </label>
                            <select class="form-control" id="idMedida" name="idMedida">
                                <?php
                                foreach($result2 as $fila){
                                        if($fila["idMedida"] == $row["idCargo"]){
                                        echo "<option value='" . $fila["idMedida"] . "' selected>" . $fila["medida"] . "</option>";    
                                    }else{
                                        echo "<option value='" . $fila["idMedida"] . "'>" . $fila["medida"] . "</option>";    
                                    }
                                }
                                ?>
                            </select>
                            
                        </div>

                                <button type="submit" class="btn btn-primary" name="enviar"><i class="fa fa-edit"></i> Actualizar producto</button>
                            </form>
                        <?php
                        }
                        else
                        {
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Error, no se encontró el empleado</h4>";
                            $message .= "<p>El producto con id " . $idProducto . " no existe en la base de datos.</p>";
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
                    <a href="verProductos.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Listar Productos</a>

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