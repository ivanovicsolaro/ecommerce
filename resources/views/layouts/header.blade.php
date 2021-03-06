<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>MayoristaCelular.com</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@6.6.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@6.6.2/dist/sweetalert2.min.css">
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


  	<!-- DropZone -->
  
	

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/slick.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('css/slick-theme.css')}}" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/nouislider.min.css')}}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}" />
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
	@role('admin')
	<!-- HEADER -->
	<header>
		

	<nav class="navbar navbar-inverse navbar-static-top" style="border-top: 2px solid #d6004a" >
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ADMIN <strong class="text-uppercase" style="color: #fff !important"> {{Auth::user()->name}}!</strong></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
         
          <ul class="nav navbar-nav navbar-right">
          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Clientes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('clientes.index')}}"><i class="fa fa-list" aria-hidden="true"></i> Listar</a></li>
                <li><a href="{{route('servicios.index')}}"><i class="fa fa-wrench" aria-hidden="true"></i> Listar Servicios</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">ABM</li>
                <li><a href="{{route('clientes.create')}}"><i class="fa fa-plus" aria-hidden="true"></i>  Nuevo</a></li>
                <li><a href="{{route('servicios.create')}}">+<i class="fa fa-wrench" aria-hidden="true"></i>  Nuevo Servicio</a></li>              
              </ul>
            </li>
          	<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ventas <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('ventas.index')}}"><i class="fa fa-list" aria-hidden="true"></i> Listar</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">ABM</li>
                <li><a href="{{route('ventas.create')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Punto de Venta</a></li>              
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Caja <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('movimientos.index')}}"><i class="fa fa-list" aria-hidden="true"></i> Movimientos</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">ABM</li>
                <li><a href="{{route('ventas.create')}}"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Mov.</a></li>              
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('productos.index')}}"><i class="fa fa-cube" aria-hidden="true"></i>  Listar Productos</a></li>
                 <li><a href="{{route('productos.index-devoluciones')}}"><i class="fa fa-reply" aria-hidden="true"></i> Devoluciones</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">ABM</li>
                <li><a href="{{route('productos.create')}}">  <i class="fa fa-plus" aria-hidden="true"></i>  Nuevo</a></li> 
                <li><a href="{{url('productos-create-massive')}}">  <i class="fa fa-cubes" aria-hidden="true"></i>  Carga Masiva</a></li> 
                <li><a href="{{url('productos-create-massive')}}">  <i class="fa fa-cubes" aria-hidden="true"></i>  Crear Combo</a></li>   
                <li><a href="{{url('productos-create-massive')}}">  <i class="fa fa-cubes" aria-hidden="true"></i>  Oferta Limitada</a></li>            
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Config <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{url('banners')}}"> <i class="fa fa-picture-o" aria-hidden="true"></i> Listado Banners</a></li>
                <li><a href="{{url('listado-configuraciones')}}"><i class="fa fa-shopping-basket" aria-hidden="true"></i> General</a></li>              
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


 @endrole
		@endif

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="{{ asset('img/logo.png')}}" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">


					{!! Form::model(Request::all(), ['route' => 'shop.index', 'method' => 'GET']) !!}
							<div class="input search-categories"><p style="margin: 10px 0px 0px 15px;">Búsqueda</p></div>
							
							 {!! Form::text('busqueda', null, ['class' => 'input search-input', 'placeholder' => 'Ejemplo: J1 Ace, J110, etc.'])!!}
						  <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
				 {!! Form::close()!!}
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
								<li><a href="{{url('/checkout')}}"><i class="fa fa-check"></i> Finalizar Compra</a></li>
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
									<span class="qty" id="header-cantidad-items">{{Cart::itemCount()}}</span>
								</div>
								<strong class="text-uppercase">Mi Carrito:</strong>
								<br>
								<div id="header-precio-total">$ {{number_format(Cart::total(),2)}}</div>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
								<div id="div-menu-carrito"></div>
								</div>
								</div>
							</div>

							<!-- la vista del carrito -->

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