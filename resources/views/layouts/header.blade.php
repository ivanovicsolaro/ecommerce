<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>E-SHOP</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@6.6.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@6.6.2/dist/sweetalert2.min.css">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
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
	@section('css')

@show

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>


<body>
	@if(\Auth::check())
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
				<strong class="text-uppercase" style="color: #fff !important">Bienvenido {{Auth::user()->name}}!</strong>
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						<li><a href="#">Store</a></li>
						<li><a href="#">Newsletter</a></li>
						<li class="dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-user-secret" aria-hidden="true"></i> Roles <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">  <i class="fa fa-list" aria-hidden="true"></i>  Listar Roles</a></li>
								<li><a href="#">  <i class="fa fa-plus-square-o" aria-hidden="true"></i>  Nuevo Rol</a></li>
							</ul>
						</li>
						<li class="dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Productos <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">  <i class="fa fa-cube" aria-hidden="true"></i>  Nuevo Producto</a></li>
								<li><a href="#">  <i class="fa fa-cubes" aria-hidden="true"></i>  Carga Masiva</a></li>
								<li><a href="#">  <i class="fa fa-cubes" aria-hidden="true"></i>  Crear Combo</a></li>
								<li><a href="#">  <i class="fa fa-cubes" aria-hidden="true"></i>  Oferta Limitada</a></li>
							</ul>
						</li>
						<li class="dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">USD <i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">USD ($)</a></li>
								<li><a href="#">EUR (€)</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		@endif

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form>
							<input class="input search-input" type="text" placeholder="Ingrese su búsqueda">
							<select class="input search-categories">
								<option value="0">Búsqueda</option>
								<option value="1">Category 01</option>
								<option value="1">Category 02</option>
							</select>
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">
									@if(\Auth::check())
										{{\Auth::user()->name}}
									@else
										Visitante
									@endif
									<i class="fa fa-caret-down"></i></strong>
							</div>
							<ul class="custom-menu">
								<li><a href="#"><i class="fa fa-exchange"></i> Comparar</a></li>
								<li><a href="#"><i class="fa fa-check"></i> Finalizar Compra</a></li>
									@if(\Auth::check())
										<li><a href="{{url('/home')}}"><i class="fa fa-user-o"></i> Mi cuenta</a></li>
										<li><a href="#"><i class="fa fa-heart-o"></i> Mi lista de deseos</a></li>
										<li><a href="{{route('logout')}}"><i class="fa fa-unlock-alt"></i> Salir</a></li>
									  @else
									  	<li><a href="{{ url('login') }}" ><i class="fa fa-unlock-alt"></i> Loguin</a></li>
										<li><a href="{{ route('register')}}"><i class="fa fa-user-plus"></i> Crear Cuenta</a></li>
									  @endif		
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty">3</span>
								</div>
								<strong class="text-uppercase">Mi Carrito:</strong>
								<br>
								<span>35.20$</span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="./img/thumb-product01.jpg" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
												<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="./img/thumb-product01.jpg" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">$32.50 <span class="qty">x3</span></h3>
												<h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
									</div>
									<div class="shopping-cart-btns">
										<button class="main-btn">Ver Carrito</button>
										<button class="primary-btn">Finalizar <i class="fa fa-arrow-circle-right"></i></button>
									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->