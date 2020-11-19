<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Logo -->
		<link rel="icon" type="image/x-icon" href="https://irp-cdn.multiscreensite.com/1e55aefa/site_favicon_16_1554956091572.ico">
		<!-- Logo -->
		<title>ANCLATE SV</title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="../css/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="../css/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="../css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="../css/style.css"/>

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
						<li><a href="#"><i class="fa fa-phone"></i> +503 2263-5877 </a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i>servicioalcliente@anclatesv.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> Urbanización Kareol Calle Tristán # 7, Colonia Escalón
							San Salvador </a></li>
					</ul>
					<ul class="header-links pull-right">
						<!--<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>-->
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="../img/logo2.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!---

					 ACCOUNT
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								Wishlist
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<div class="qty">2</div>
									</a>
								</div>
								/Wishlist

								Cart
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty">3</div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product01.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>

											<div class="product-widget">
												<div class="product-img">
													<img src="./img/product02.png" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->

								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="../index.html">Home</a></li>
						<li><a href="sisIngeniera.php">Sistemas de Ingeniería</a></li>
						<li><a href="altura.php">Altura</a></li>
						<li class="active"><a href="ppmanos.php">Protección para Manos</a></li>
						<li><a href="ppfacial.php">Protección Facial</a></li>

					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->

		<!-- /BREADCRUMB -->

		<!-- SECTION -->

		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Equipos de Protección para trabajos en altura</h3>
						</div>
					</div>

<!-- product -->
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
        $query = mysqli_query($conexion,"SELECT * FROM producto AS p INNER JOIN tipoproducto AS tp ON p.idTipoProducto= tp.idTipoProducto INNER JOIN medida AS m ON p.idMedida = m.idMedida WHERE p.idTipoProducto = '3' ");
    mysqli_close($conexion);

    $result = mysqli_num_rows($query);
    if($result > 0){
        while ($data = mysqli_fetch_array($query)){


?>
<!-- product -->
					<!-- product -->
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
                            <img src="../img/<?php echo $data["imagen"]?>" height="200" width="200"/>
								<div class="product-label">
								</div>
							</div>
							<div class="product-body">
								<h3 class="product-name"><a href="#"><?php echo $data["nombre"]?></a></h3>
                                <p class="product-category"><?php echo $data["tipoProducto"]?></p>
                                <p class="product-category"><?php echo $data["medida"]?></p>
                                <p class="product-category">Existencias: <?php echo $data["stock"]?></p>
                                <p class="product-category"><?php echo $data["descripcion"]?></p>
                                <div class="product-rating">
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>Cotizar</button>
							</div>
						</div>
					</div>
					<!-- /product -->
<?php
}
}
}
?>


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
        <!-- /Section -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Acerca de Nosotros</h3>
								<p>Anclate S.A. de C.V. Somos Especialistas en el tema de Protección para Trabajos en Altura, contamos con personal ampliamente capacitado y certificado en la Instalación de Líneas de vida horizontales tanto en exteriores como en interiores y Líneas  verticales</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>Urbanización Kareol Calle Tristán # 7, Colonia Escalón
										San Salvador </a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+503 2263-5877 </a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>servicioalcliente@anclatesv.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categorias</h3>
								<ul class="footer-links">
									<li><a href="sisIngeniera.php">Sistema de Ingenieria</a></li>
									<li><a href="altura.php">Equipos de Altura</a></li>
									<li><a href="ppmanos.php">Protección de Manos</a></li>
									<li><a href="ppfacial.php">Protección Facial</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Información</h3>
								<ul class="footer-links">
									<li><a href="#">Acerca de Nosotros</a></li>
									<li><a href="#">Contactanos</a></li>
									<li><a href="#">Politicas</a></li>
									<li><a href="#">Terminos y Condiciones</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Servicios</h3>
								<ul class="footer-links">
									<li><a href="#">Equipos de Protección para Trabajos de Altura</a></li>
									<li><a href="#">Líneas de vida Horizontales y verticales</a></li>
									<li><a href="#">Protección de manos</a></li>
									<li><a href="#">Protección Facial</a></li>
									<li><a href="#">Asesoría Técnica y Capacitaciones</a></li>
									<li><a href="#">Andamios Certificados</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">

							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos los Derechos Reservados  </a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/slick.min.js"></script>
		<script src="../js/nouislider.min.js"></script>
		<script src="../js/jquery.zoom.min.js"></script>
		<script src="../js/main.js"></script>

	</body>
</html>
