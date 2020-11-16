<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<?php
    //Conexion
    $host = "localhost";
    $basededatos = "anclate";
    $usuariodb = "root";
    $clavedb = "";
    $conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);
    //Conexion
    if($conexion->connect_errno){
        echo '<script language="javascript">alert("Error en la conexion de la BDD");</script>';
        exit();
    }else{
    $query = mysqli_query($conexion,"SELECT * FROM producto AS p INNER JOIN tipoproducto AS tp ON p.idTipoProducto= tp.idTipoProducto INNER JOIN medida AS m ON p.idMedida = m.idMedida ORDER BY tp.tipoProducto");
    mysqli_close($conexion);

    $result = mysqli_num_rows($query);
    if($result > 0){  
        while ($data = mysqli_fetch_array($query)){
            
        
?>
<table class="table table-bordered">
              <thead>
                <tr>
                  <th>idProduto</th>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Imagen</th>
                  <th>Stock</th>
                  <th>IdTipoProducto</th>
                  <th>IdTipoMedida</th>
                  <th class="celda">Descripción</th>
                </tr>
              </thead>
              <tbody id="tdata">
                <tr>
                    <td><?php echo $data["idProducto"]?></td>
                    <td><?php echo $data["nombre"]?></td>
                    <td><?php echo $data["descripcion"]?></td>
                    <td><img src="img/<?php echo $data["imagen"]?>" height="200" width="200"/></td>
                    <td><?php echo $data["stock"]?></td>
                    <td><?php echo $data["idTipoProducto"]?></td>
                    <td><?php echo $data["idMedida"]?></td>
                </tr>
              </tbody>
</table>
<?php
}   
}
    }
?>

      
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</html>