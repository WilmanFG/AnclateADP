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

                    $database = new Database();
                    $dbconnection = $database->create_connection();
                    

                    $sql = "SELECT * FROM tipoProducto";
                    $sql2 = "SELECT * FROM medida";
                    

                    $result = $dbconnection->query($sql);
                    $result2 = $dbconnection->query($sql2);

                    if($result->rowCount() >0)
                    {
                    ?>

                    <form class="contact100-form validate-form" action="ingresarProducto.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="idProducto">ID Producto: </label>
                            <input type="text" class="form-control" id="idProducto" name="idProducto">
                        </div>

                        <div class="form-group">
                            <label for="nombres">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción: </label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>

                        <div class="wrap-input100 bg1">
                            <span class="label-input100">Subir Imagen</span>
                            <br>
                            <input type="file" name="archivos" id="uploadBtn0" class="input100">
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="stock">Stock: </label>
                            <input type="text" class="form-control" id="stock" name="stock">
                        </div>

                        <div class="form-group">
                            <label for="idTipoProducto">Categoría: </label>
                            <select class="form-control" id="idTipoProducto" name="idTipoProducto">
                                <?php
                                foreach($result as $fila){
                                   
                                        echo "<option value='" . $fila["idTipoProducto"] . "'>" . $fila["tipoProducto"] . "</option>";    
                                   
                                }
                                ?>
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <label for="idCargo">Medida: </label>
                            <select class="form-control" id="idMedida" name="idMedida">
                                <?php
                                foreach($result2 as $fila){
                                   
                                        echo "<option value='" . $fila["idMedida"] . "'>" . $fila["medida"] . "</option>";    
                                   
                                }
                                ?>
                            </select>
                            
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
                    <a href="verProductos.php" class="btn btn-success"><i class="fa fa-arrow-left"></i> Listar productos</a>

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