<?php
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
?>