
<?php
    session_start();

    if(empty(trim($_POST["correo"])) || empty(trim($_POST["contra"])))
    {
        header("location:log.php?e=1");
    }
    else
    {
        include_once "classes/Database.class.php";

        $post_correo = trim($_POST["correo"]);
        $post_contra = trim($_POST["contra"]);

        $database = new Database();
        $dbconnection = $database->create_connection();
        

        $sql = "SELECT * FROM empleado INNER JOIN cargo ON empleado.idCargo = cargo.idCargo WHERE empleado.correo = :correo";
        $statement = $dbconnection->prepare($sql);
        $statement->bindParam(":correo",$post_correo);
        $statement->execute();

        if($statement->rowCount() == 1)
        {
            $row=$statement->fetch();
            if(password_verify($post_contra, $row["contra"]))
            {
                $_SESSION["user"] = $row;
                $database->close_connection($dbconnection);
                header("location:indexLogin.php");
            }
            else
            {
                $database->close_connection($dbconnection);
                header("location:log.php?e=2");
            }
        

            
        }
        else
        {
            $database->close_connection($dbconnection);
            header("location:log.php?e=3");
            
        }

        
    }
    

?>
