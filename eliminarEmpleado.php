<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }

?>

<?php

$eliminado = 0;

include_once "classes/Database.class.php";
if(isset($_POST["idEmpleado"])){

    
    $idEmpleado = trim($_POST["idEmpleado"]);

    $database = new Database();
    $dbconnection = $database->create_connection();

    $response = null;
    try
    {

    
        $sql = "DELETE FROM empleado WHERE idEmpleado = ?";
        $statement = $dbconnection->prepare($sql);
        $statement->bindParam(1,$idEmpleado);
        $statement->execute();

        if($statement->rowCount() == 1)
        {
            
            $response["status"] = 1;
        }
        else
        {
            $response["status"]=0;
        }

    }
    catch(PDOException $e){
        $response["status"]=3;
        $response["errcode"]=$e->getCode();
        $response["errmessage"]=$e->getMessage();
    }
    finally
    {
        $database->close_connection($dbconnection);    
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);    

}


?>
