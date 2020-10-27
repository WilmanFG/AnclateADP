<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }

?>

<?php
    
    include_once "classes/Database.class.php";

    $database = new Database();
    $dbconnection = $database->create_connection();
    
    $sql = null;

    //recibiendo dato desde json
    //$value = json_decode($_POST['param1']);


    //verificar el tipo de usuario (parametro)

        $sql = "SELECT * FROM producto AS p INNER JOIN tipoproducto AS tp ON p.idTipoProducto= tp.idTipoProducto INNER JOIN medida AS m ON p.idMedida = m.idMedida ORDER BY tp.tipoProducto";
 

    
    $result = $dbconnection->query($sql);
    
    $response = null;
    $html = "";

    if($result->rowCount() >0)
    {
        
        //Si hay datos, vamos a obtener el resultado en forma de objeto
        //Cada fila será una propiedad en el objeto $row
        
        $response["status"]=1;
        foreach($result as $fila){

            $html .= "<tr>";
            $html .= "<td>" . $fila["idProducto"] . "</td>";
            $html .= "<td>" . $fila["nombre"] . "</td>";
            $html .= "<td>" . $fila["descripcion"] . "</td>";
            $html .= "<td>" . $fila["stock"] . "</td>";
            $html .= "<td>" . $fila["tipoProducto"] . "</td>";
            $html .= "<td>" . $fila["medida"] . "</td>";
            $html .= "<td><img src='img/" . $fila["imagen"] . "' height='200' width='200'/></td>";
            $html .= "<td>";
            $html .= "<a href='editproduct.php?id=" . $fila["idProducto"] . "' class='btn btn-warning'><i class='fa fa-edit'></i> Editar</a> ";
            $html .= "<a href='#' id='" . $fila["idProducto"] . "' class='btn btn-danger delete-user' data-toggle='modal' data-target='#exampleModal' id='delete-button'><i class='fa fa-trash'></i> Eliminar</a>";
            $html .= "</td>";
            $html .= "</tr>";

        }
        
    }
    else
    {
        $response["status"]=0;
        $html="";
        $html .= "<tr><td colspan='8' class='text-center'>No hay datos que mostrar</td></tr>";
    }

    $response["data"]= $html;
    $database->close_connection($dbconnection);

    header('Content-Type: application/json');

    echo json_encode($response);

?>
