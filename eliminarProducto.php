<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }

?>

<?php

$eliminado = 0;

include_once "classes/Database.class.php";
if(isset($_POST["idProducto"])){

    
    $idProducto = trim($_POST["idProducto"]);

    $database = new Database();
    $dbconnection = $database->create_connection();

    $response = null;
    try
    {
        $sql2 = "SELECT * FROM producto WHERE idProducto = ?";
        $statement2 = $dbconnection->prepare($sql2);
        $statement2->bindParam(1,$idProducto);
        $statement2->execute();
    
        $sql = "DELETE FROM producto WHERE idProducto = ?";
        $statement = $dbconnection->prepare($sql);
        $statement->bindParam(1,$idProducto);
        $statement->execute();

        if($statement2->rowCount()>0)
        {
            $row = $statement2->fetch();
        $img = $row["imagen"];
        unlink("img/".$img);
        }
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
