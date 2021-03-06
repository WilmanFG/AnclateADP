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

	<title>Cotizaciones</title>

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
                <li><a href="indexAC.php"> Ver Cotizaciones</a></li>

			</ul>

			<form class="form-inline my-2 my-lg-0">
                <ul class="header-links pull-right">
                    <li class="nav-item"><a class="nav-link">
                        Bienvenido/a <?php echo $_SESSION["user"]["nombres"];?></a>
                    </li>
                    <li class="nav-item">
                        <div class="btn-group" role="group">
                            <button  type="button" class="btn btn-danger" data-toggle="dropdown">
                                Usuario
                            </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="btn btn-secondary" href="perfil.php?id=<?php echo $_SESSION["user"]["idEmpleado"] ?> ">Perfil</a>
                            <a class="btn btn-secondary" href="logout.php">Cerrar Sesión</a>
                        </div>
                        </div>
                    </li>
                </ul>
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
					<div class="col-md-8">
						<div class="col-md-12 order-details">
							<div class="section-title text-center">
								<h3 class="title">Cotizaciones</h3>
							</div>
							<table class="table table-striped">
                            <thead>
									<tr>
										<th scope="col">Código</th>
										<th scope="col">Nombre</th>
										<th scope="col">Teléfono</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Estado</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
                                    <?php
								include_once "classes/Database.class.php";
//idexAC
								$database = new Database();
								$dbconnection = $database->create_connection();

                                $sql = null;

								$sql = "SELECT * FROM cotizacion AS c INNER JOIN estadocotizacion AS ec ON c.idEstado = ec.idEstado ORDER BY ec.estado";

								$result = $dbconnection->query($sql);

								if($result->rowCount() >0)
								{

									//Si hay datos, vamos a obtener el resultado en forma de objeto
									//Cada fila será una propiedad en el objeto $row
									foreach($result as $fila){
										echo "<tr>";
                                        echo "<td>" . $fila["idCotizacion"] . "</td>";
                                        echo "<td>" . $fila["nombreCliente"] . "</td>";
										echo "<td>" . $fila["correoCliente"] . "</td>";
										echo "<td>" . $fila["telefono"] . "</td>";
										echo "<td>" . $fila["estado"] . "</td>";
										echo "<td class='text-center'>";
										echo "<a href='indexLogin.php?id=" . $fila["idCotizacion"] . "' class='btn btn-warning'><i class='fa fa-eye'></i> Visualizar</a> ";
										echo "</td>";
										echo "</tr>";

									}

								}
								else
								{
									echo "<tr><td colspan='6' class='text-center'>No hay datos que mostrar</td></tr>";
								}

								$database->close_connection($dbconnection);

							?>
									</tr>

								</tbody>
							</table>
						</div>
						<!-- /Order Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-4 order-details">
						<div class="section-title text-center">
							<h3 class="title">Detalles</h3>
						</div>
						<div class="order-summary">
						<div class="order-col">
						<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Vendedor:</th>

								<?php
								$database = new Database();
								$dbconnection = $database->create_connection();
								if(!empty($_GET["id"])){
								$id = trim($_GET["id"]);

									$sql = null;
									$statement = null;
									$sql = "SELECT * FROM cotizacion AS c INNER JOIN empleado AS e ON c.idEmpleado = e.idEmpleado WHERE c.idCotizacion =?";
									$statement = $dbconnection->prepare($sql);
									$statement->bindParam(1,$id);
									$statement->execute();

									if($statement->rowCount() >0)
									{

										//Si hay datos, vamos a obtener el resultado en forma de objeto
										//Cada fila será una propiedad en el objeto $row
										foreach($statement as $fila){

											echo "<th scope='col'>".$fila["nombres"]." ".$fila["apellidos"]."</th>";
										}

									}
								}
								$database->close_connection($dbconnection);

							?>
							</tr>
							<tr>
								<th scope="col">PRODUCTO</th>
								<th scope="col">CANTIDAD</th>
							</tr>
						</thead>
						<tbody>
						<?php

								$database = new Database();
								$dbconnection = $database->create_connection();
								if(!empty($_GET["id"])){
								$id = trim($_GET["id"]);

									$sql = null;
									$statement = null;
									$sql = "SELECT * FROM cotizacionproducto AS c INNER JOIN producto AS p ON c.idProducto = p.idProducto WHERE c.idCotizacion =?";
									$statement = $dbconnection->prepare($sql);
									$statement->bindParam(1,$id);
									$statement->execute();

									if($statement->rowCount() >0)
									{

										//Si hay datos, vamos a obtener el resultado en forma de objeto
										//Cada fila será una propiedad en el objeto $row
										foreach($statement as $fila){
											echo "<tr>";
											echo"<td>".$fila["nombre"]."</td>";
											echo"<td>".$fila["cantidad"]."</td>";
											echo "</tr>";
										}

									}
									else
									{
										echo "<tr><td colspan='6' class='text-center'>No hay datos que mostrar</td></tr>";
									}
								}else{
									echo "<tr><td colspan='6' class='text-center'>No hay datos que mostrar</td></tr>";
								}
								$database->close_connection($dbconnection);

							?>
						</tbody>
							</table>

							</div>



						</div>
						<div class="section-title text-center">
							<button type="button" class="btn btn-primary btn-lg btn-block">Finalizar cotización</button>
						</div>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

</body>

</html>
