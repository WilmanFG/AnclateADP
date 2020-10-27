<?php 
    session_start();

    if(!isset($_SESSION["user"])){
        header("location:log.php");
    }

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Productos</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- TOP HEADER -->
		<div id="top-header">
			<div class="container">

            <ul class="header-links pull-left">
                <li><a href="#"> <?php echo $_SESSION["user"]["cargo"];?></a></li>
                <li><a href="indexLogin.php"> Ver Cotizaciones</a></li>
                <li><a href="verEmpleados.php"> Ver Empleados</a></li>
                <li><a href="verProductos.php"> Ver Productos</a></li>
			</ul>


				
                <form class="form-inline my-2 my-lg-0">
                <ul class="header-links pull-right"><li class="nav-item"><a class="nav-link">
                                    Bienvenido/a <?php echo $_SESSION["user"]["nombres"];?></a></li></ul>
                                    <li class="nav-item"> <a href="logout.php" class="btn btn-danger my-2 my-sm-0">Salir</a></li>
                </form>
                
                
			</div>
		</div>
		<!-- /TOP HEADER -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-16">
						<div class="col-md-16 order-details">
							<div class="section-title text-center">
								<h3 class="title">Productos</h3>
							</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="createProducto.php" class="btn btn-success"><i class="fa fa-pills"></i> Agregar Producto</a>

                                </div>
                            </div>
							<table class="table table-striped">
                            <thead>
									<tr>
										<th scope="col">ID Producto</th>
										<th scope="col">Nombre</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Tipo Producto</th>
                                        <th scope="col">Medida</th>
                                        <th scope="col">Imágen</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody id="ajax-return">
                            </tbody>
							</table>
						</div>
						<!-- /Order Details -->
					</div>

					
				</div>
				<!-- /row -->
			</div>
            <!-- /container -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro que desea eliminar este registro?
                    </div>
                    <div class="modal-footer">
                        <input type="text" value="0" id="idtodelete" readOnly>
                        <button type="button" class="btn btn-danger" id="delete-button" name="enviar" data-dismiss="modal">Si</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
		</div>
		<!-- /SECTION -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
        <script src="js/main.js"></script>
        <script
	  	src="https://code.jquery.com/jquery-3.5.0.min.js"
		integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
        crossorigin="anonymous"></script>
        

        <script type="text/javascript">
            //js que se ejecuta cada vez que se completa una transacción javascript
            $(document).ajaxComplete(function () {
                $(".delete-user").click(function(){
                    //accedemos a la propiedad id del elemento actual
                    //alert($(this).attr("id"));
                    //lo asignamos al campo de texto a eliminar
                    $("#idtodelete").val($(this).attr("id"));
                })
            });

        	$(document).ready(function(){
                //almacenamos en una función, todo el código que queremos ejecutar
                //cuando la página se carga. De esta forma lo podemos llamar 
                //en cualquier momento
                function load_data(){
                    $.ajax({
                        dataType: 'json',
                        method: 'POST',
                        url: 'readProduct.php',
                        data: {},
                        beforeSend: function() {
                            $("#loading-spinner").attr('style','display: flex !important;');
                        },
                        success: function(datos) {
                            console.log(datos);
                            if(datos.status==1){
                                $("#ajax-return").empty();
                                $("#ajax-return").append(datos.data);
                            }
                            else
                            {
                                $("#ajax-return").empty();
                                $("#ajax-return").append(datos.data);
                            }
                        },
                        error: function(error) {
                            alert("Ha ocurrido un error procesando la solicitud" + error.responseText);

                        },
                        complete: function() {
                            $("#loading-spinner").attr('style','display: none !important;');
                        }
                    })
                };

                //código de funcionamiento del botón de eliminar
                $("#delete-button").click(function(){

                    $.ajax({
                        dataType: 'json',
                        method: 'POST',
                        url: 'eliminarProducto.php',
                        data: {idProducto:$("#idtodelete").val()},
                        beforeSend: function() {
                            $("#loading-spinner").attr('style','display: flex !important;');
                        },
                        success: function(datos) {
                            console.log(datos);
                            if(datos.status==1){
                                $("#message-1").attr("style","display: ");

                            }
                            else if(datos.status==2)
                            {
                                $("#message-2").attr("style","display: ");
                            }
                            else if(datos.status==3)
                            {
                                $("#errorcode").append(datos.errcode);
                                $("#errormessage").append(datos.errmessage);
                                $("#message-3").attr("style","display: ");
                            }

                        },
                        error: function(error) {
                            alert("Ha ocurrido un error procesando la solicitud" + error.responseText + ":c");

                        },
                        complete: function() {
                            load_data();
                            $("#loading-spinner").attr('style','display: none !important;');
                        }
                    })
                });

                load_data();
            });
        </script>


</body>

</html>