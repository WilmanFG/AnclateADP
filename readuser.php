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
    if($_SESSION["user"]["idCargo"]==1)
    {
        $sql = "SELECT * FROM empleado AS e INNER JOIN cargo AS c ON e.idCargo= c.idCargo WHERE e.correo<>'" . $_SESSION["user"]["correo"] . "'; ORDER BY e.idCargo";
    }
    else
    {
        $sql = "SELECT * FROM usuario AS u INNER JOIN tipousuario AS b ON u.idtipousuario = b.idtipousuario WHERE u.usuario<>'" . $_SESSION["user"]["usuario"] . "' AND u.idtipousuario<>1;";
    }
    
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
            $html .= "<td>" . $fila["nombres"] . "</td>";
            $html .= "<td>" . $fila["apellidos"] . "</td>";
            $html .= "<td>" . $fila["telefono"] . "</td>";
            $html .= "<td>" . $fila["correo"] . "</td>";
            $html .= "<td>" . $fila["dui"] . "</td>";
            $html .= "<td>" . $fila["cargo"] . "</td>";
            $html .= "<td>";
            $html .= "<a href='edituser.php?id=" . $fila["idEmpleado"] . "' class='btn btn-warning'><i class='fa fa-edit'></i> Editar</a> ";
            $html .= "<a href='#' id='" . $fila["idEmpleado"] . "' class='btn btn-danger delete-user' data-toggle='modal' data-target='#exampleModal' id='delete-button'><i class='fa fa-trash'></i> Eliminar</a>";
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
