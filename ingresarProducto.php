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
<?php
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }
    include_once "classes/Database.class.php";

	if(isset($_POST["enviar"])){
		
function subirFoto(){
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
 if($size > 2621440){
 echo "<h3>El tamaño del archivo es superior al admitido por el
servidor</h3><br>";
 echo "<a href=\"verProductos.php\">Intentar de nuevo</a>";
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

 }
 else{
 switch($_FILES['archivos']['error']){
 //No hay error, pero puede ser un ataque
case UPLOAD_ERR_OK:
 echo "<p>Se ha producido un problema con la carga del archivo.</p>\n";
break;
//El tamaño del archivo es mayor que upload_max_filesize
case UPLOAD_ERR_INI_SIZE:
echo "<p>El archivo es demasiado grande, no se puede cargar.</p>\n";
break;
//El tamaño del archivo es mayor que MAX_FILE_SIZE
case UPLOAD_ERR_FORM_SIZE:
echo "<p>El archivo es demasiado grande, no se pudo cargar.</p>\n";
break;
//Solo se ha cargado parte del archivo
case UPLOAD_ERR_PARTIAL:
echo "<p>Sólo se ha cargado una parte del archivo.</p>\n";
break;
//No se ha seleccionado ningún archivo para subir
case UPLOAD_ERR_NO_FILE:
echo "<p>Debe elegir un archivo para cargar.</p>\n";
break;
//No hay directorio temporal
case UPLOAD_ERR_NO_TMP_DIR:
echo "<p>Problema con el directorio temporal. Parece que no
existe</p>\n";
break;
default:
echo "<p>Se ha producido un problema al intentar mover el archivo "
. $name . "</p>\n";
break;
}
}
}
else{
echo "<h3>No se han seleccionado archivos.</h3>";
}
}

function ingresoDatos(){

	if (isset($_FILES["archivos"])){
		$idProducto = $_POST["idProducto"];
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["descripcion"];
	$stock = $_POST["stock"];
    $idTipoProducto = $_POST["idTipoProducto"];
    $idMedida = $_POST["idMedida"];

	$name = $_FILES["archivos"]["name"];
    
    $database = new Database();
    $dbconnection = $database->create_connection();
    
    
    try
    {


        $sql = "INSERT INTO producto (idProducto,nombre,descripcion,imagen,stock,idTipoProducto,idMedida) VALUES (:idProducto,:nombre,:descripcion,:imagen,:stock,:idTipoProducto,:idMedida)";
        $statement = $dbconnection->prepare($sql);
        $statement->bindParam(":idProducto",$idProducto);
        $statement->bindParam(":nombre",$nombre);
        $statement->bindParam(":descripcion",$descripcion);
        $statement->bindParam(":stock",$stock);
        $statement->bindParam(":imagen",$name);
        $statement->bindParam(":idTipoProducto",$idTipoProducto);
        $statement->bindParam(":idMedida",$idMedida);
        $statement->execute();

        if($statement->rowCount() == 1)
        {
            $message = "<div class='alert alert-success' role='alert'>";
            $message .= "<h4 class='alert-heading'><i class='fa fa-user-plus'></i> Producto agregado</h4>";
            $message .= "<p>Producto agregado exitosamente.</p>";
            $message .= "</div>";
            $message .="<div class='row'>";
            $message .="<div class='col-md-12 text-center'>";
            $message .="<a href='verProductos.php' class='btn btn-success'><i class='fa fa-arrow-left'></i> Listar productos</a>";

            $message .="</div>";
            $message .="</div>";

            echo $message;
        }
        else
        {
            $error = $dbconnection->errorInfo();
            $message = "<div class='alert alert-danger' role='alert'>";
            $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no agregado</h4>";
            $message .= "<p>Ocurrió un error procesando la consulta y no se pudo guardar el producto. Por favor, inténtelo de nuevo. <br>";
            $message .= "Descripción: " . $error[2] . " <br>";
            $message .= "Código de error: " . $error[0] . "</p>";
            $message .= "</div>";
            $message .="<div class='row'>";
            $message .="<div class='col-md-12 text-center'>";
            $message .="<a href='createProducto.php' class='btn btn-success'><i class='fa fa-arrow-left'></i> Regresar</a>";

            $message .="</div>";
            $message .="</div>";

            echo $message;
        }
    }
    catch(PDOException $e){
        $message = "<div class='alert alert-danger' role='alert'>";
        $message .= "<h4 class='alert-heading'><i class='fa fa-ban'></i> Producto no creado</h4>";
        $message .= "<p>Ocurrió un error procesando la consulta y no se pudo crear el Producto. Por favor, inténtelo de nuevo. <br>";
        $message .= "Descripción: " . $e->getMessage() . " <br>";
        $message .= "Código de error: " . $e->getCode() . "</p>";
        $message .= "</div>";
        $message .="<div class='row'>";
            $message .="<div class='col-md-12 text-center'>";
            $message .="<a href='createProducto.php' class='btn btn-success'><i class='fa fa-arrow-left'></i> Regresar</a>";

            $message .="</div>";
            $message .="</div>";

        echo $message;
    }
    finally{
        $database->close_connection($dbconnection);    
    }
    
	
	}else{
		echo"<h1>No llega imagen</h1>";
	}
	
	
}



subirFoto();
ingresoDatos();
	}else{
		header("location: verProductos.php");
	}



?>


<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});


			$(".js-select2").each(function(){
				$(this).on('select2:close', function (e){
					if($(this).val() == "Please chooses") {
						$('.js-show-service').slideUp();
					}
					else {
						$('.js-show-service').slideUp();
						$('.js-show-service').slideDown();
					}
				});
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="vendor/noui/nouislider.min.js"></script>
	<script>
	    var filterBar = document.getElementById('filter-bar');

	    noUiSlider.create(filterBar, {
	        start: [ 1500, 3900 ],
	        connect: true,
	        range: {
	            'min': 1500,
	            'max': 7500
	        }
	    });

	    var skipValues = [
	    document.getElementById('value-lower'),
	    document.getElementById('value-upper')
	    ];

	    filterBar.noUiSlider.on('update', function( values, handle ) {
	        skipValues[handle].innerHTML = Math.round(values[handle]);
	        $('.contact100-form-range-value input[name="from-value"]').val($('#value-lower').html());
	        $('.contact100-form-range-value input[name="to-value"]').val($('#value-upper').html());
	    });
	</script>
<!--===============================================================================================-->
	<!--<script src="js/main.js"></script>-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<?php 

?>
</body>
</html>
