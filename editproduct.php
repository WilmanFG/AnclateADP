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
                        function subirFoto($imgV){
                            define("PATH", "img");
                         //Verificar que la matriz asociativa $_FILES["foto"] haya sido definida
                         if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["archivos"])){
                         //De ser así se procesa cada uno de los archivos.
                         //Para poder hacerlo es conveniente obtener la cantidad
                         //de elementos que tiene matriz $_FILES["archivos"]
                         
                         //este for recorre la matriz $_FILES
                        
                         //Las propiedades definidas para cada archivo son:
                         //1. 'tmp_dir': directorio temporal en el servidor donde se aloja el archivo
                         //2. 'name': nombre original del archivo seleccionado por el usuario
                         //3. 'size': tamaño en bytes del archivo
                         //Para recorrer uno a uno los archivos que se hayan decidido subir al servidor
                         //se utilizará el contador $i. En caso de que solo se suba un archivo el ciclo
                         //se ejecutará una sola vez.
                         $tmp_name = $_FILES["archivos"]["tmp_name"];
                         $name = $_FILES["archivos"]["name"];
                         $size = $_FILES["archivos"]["size"];
                         //echo "<h3>$size bytes</h3>";
                         if($size > 7340032){
                         echo "<h3>El tamaño del archivo es superior al admitido por el
                        servidor</h3><br>";
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                        $message .= "Descripción: El tamaño del archivo es superior al admitido por el
                        servidor <br>";
                        
                        $message .= "</div>";

                        echo $message;
                         }
                        
                         //Verificar la carpeta en el servidor donde se alojarán los archivos
                         //que se desean subir. Si no existe esta carpeta se creará y si no
                         //es posible crearla se lanzará un error y se terminará el script
                         if(!file_exists(PATH)){
                         //Crear el directorio y asignar los permisos al mismo
                         if(!mkdir(PATH, 0777, true)) {
                         die('No se ha podido crear el directorio');
                         }
                         }
                         //Una vez que es procesado cada archivo correctamente, se moverá
                         //a una carpeta específica en el servidor, en este caso se usará
                         //la carpeta files/.
                         if(move_uploaded_file($tmp_name, PATH . "/" . utf8_decode($name))){
                            unlink(PATH."/".$imgV);
                         }
                         else{
                         switch($_FILES['archivos']['error']){
                         //No hay error, pero puede ser un ataque
                        case UPLOAD_ERR_OK:
                         
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                        $message .= "Descripción: Se ha producido un problema con la carga del archivo.<br>";
                        
                        $message .= "</div>";

                        echo $message;
                        break;
                        //El tamaño del archivo es mayor que upload_max_filesize
                        case UPLOAD_ERR_INI_SIZE:
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                        $message .= "Descripción: El archivo es demasiado grande, no se puede cargar.<br>";
                        
                        $message .= "</div>";

                        echo $message;
                        break;
                        //El tamaño del archivo es mayor que MAX_FILE_SIZE
                        case UPLOAD_ERR_FORM_SIZE:
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                            $message .= "Descripción: El archivo es demasiado grande, no se puede cargar.<br>";
                            
                            $message .= "</div>";
    
                            echo $message;
                        break;
                        //Solo se ha cargado parte del archivo
                        case UPLOAD_ERR_PARTIAL:
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                            $message .= "Descripción: Solo se ha cargado una parte del archivo.<br>";
                            
                            $message .= "</div>";
    
                            echo $message;
                        break;
                        //No hay directorio temporal
                        case UPLOAD_ERR_NO_TMP_DIR:
                        
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                        $message .= "Descripción: Problema con el directorio temporal. Parece que no
                        existe.<br>";
                        
                        $message .= "</div>";

                        echo $message;
                        break;
                        default:
                        $message = "<div class='alert alert-danger' role='alert'>";
                        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no actualizado</h4>";
                        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo actualizar el producto. Por favor, inténtelo de nuevo. <br>";
                        $message .= "Se ha producido un problema al intentar mover el archivo "
                        . $name . "<br>";
                        
                        $message .= "</div>";

                        echo $message;
                        
                        break;
                        }
                        }
                        }
                        }
                        
                        $regexNum="/^[+]?([1-9]+)$/";

                        $idProducto = trim($_POST["idProducto"]);
                        $nombre = trim($_POST["nombre"]);
                        $descripcion = trim($_POST["descripcion"]);
                        $stock = trim($_POST["stock"]);
                        $idTipoProducto = trim($_POST["idTipoProducto"]);
                        $idMedida = trim($_POST["idMedida"]);
                        $imgV = trim($_POST["ima"]);
                        $name = $_FILES["archivos"]["name"];
                        $errores = array();
                        $database = new Database();
                        $dbconnection = $database->create_connection();

                        if(strlen($name) > 0){
                            subirFoto($imgV);
                        }

                        if(strlen($nombre) == 0 || strlen($nombre) == 0 || strlen($descripcion) == 0 || $stock < 0 ){
                            $message = "<div class='alert alert-danger' role='alert'>";
                            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Usuario no creado</h4>";
                                $message .= "<p>Datos Requeridos Vacíos.</p>";
                                $message .= "</div>";

                                echo $message;
                        }else{
                            if(!preg_match($regexNum,$stock)){
                                array_push($errores, "Stock debe ser entero positivo");    
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
                                
                                if(strlen($name) > 0){
                                    $sql = "UPDATE producto SET nombre = ?, descripcion = ?,imagen = ?, stock = ?, idTipoProducto = ?, idMedida = ? WHERE idProducto = ?";
                                    $statement = $dbconnection->prepare($sql);
                                    $statement->bindParam(1,$nombre);
                                    $statement->bindParam(2,$descripcion);
                                    $statement->bindParam(3,$name);
                                    $statement->bindParam(4,$stock);
                                    $statement->bindParam(5,$idTipoProducto);
                                    $statement->bindParam(6,$idMedida);
                                   
                                    $statement->bindParam(7,$idProducto);
                                }else{
                                    $sql = "UPDATE producto SET nombre = ?, descripcion = ?, stock = ?, idTipoProducto = ?, idMedida = ? WHERE idProducto = ?";
                                    $statement = $dbconnection->prepare($sql);
                                    $statement->bindParam(1,$nombre);
                                    $statement->bindParam(2,$descripcion);
                                    $statement->bindParam(3,$stock);
                                    $statement->bindParam(4,$idTipoProducto);
                                    $statement->bindParam(5,$idMedida);
                                   
                                    $statement->bindParam(6,$idProducto);
                                }
                                    
                              
                                
                                
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
                            <form class="contact100-form validate-form"  method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="ima" name="ima" value="<?php echo $row['imagen'];?>">
                        <div class="form-group">
                            <label for="idProducto">ID Producto: </label>
                            <input type="text" class="form-control" id="idProducto" readOnly name="idProducto" value="<?php echo $row['idProducto'];?>">
                        </div>

                        <div class="form-group">
                            <label for="nombres">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre'];?>">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción: </label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $row['descripcion'];?>">
                        </div>

                        <div class="wrap-input100 bg1">
                        
                            <span class="label-input100">Subir Imagen</span>
                            <br>
                            <img src="img/ <?php echo $row['imagen'];?>" height="200" width="200"/>
                            <br>
                            <input type="file" name="archivos" id="uploadBtn0" class="input100">
                            
                        </div>

                        <br>
                        <div class="form-group">
                            <label for="stock">Stock: </label>
                            <input type="number" min="1" step="1" class="form-control" id="stock" name="stock" value="<?php echo $row['stock'];?>">
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


                        <button type="submit" class="btn btn-primary" name="enviar"><i class="fa fa-plus"></i> Agregar producto</button>
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