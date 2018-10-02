@include('layouts.header')
@include('layouts.menu') 


	
	  <div id="home">
        <!-- container -->
        <div class="container">

          


<!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Products</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                
                @include('front.productos.filters')

                <!-- MAIN -->
                <div id="main" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <div class="row-filter">
                                <a href="#"><i class="fa fa-th-large"></i></a>
                                <a href="#" class="active"><i class="fa fa-bars"></i></a>
                            </div>
                            <div class="sort-filter">
                                <span class="text-uppercase">Ordenar por:</span>
                                <select class="input">
                                        <option value="0">Posición</option>
                                        <option value="0">Precio</option>
                                        <option value="0">Calificaciones</option>
                                    </select>
                                <a href="#" class="main-btn icon-btn"><i class="fa fa-arrow-up"></i></a>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="page-filter">
                                <span class="text-uppercase">Mostrar:</span>
                                <select class="input">
                                        <option value="0">10</option>
                                        <option value="1">20</option>
                                        <option value="2">30</option>
                                    </select>
                            </div>
                            <ul class="store-pages">
                                <li><span class="text-uppercase">Pagina:</span></li>
                                <li class="active">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /store top filter -->

                    <!-- STORE -->
                    <div id="store">
                        <!-- row -->
                        <div class="row">
                            <?php $i=0;?>
                            @foreach($productos as $producto)
                            <!-- Product Single -->
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            <span>Nuevo</span>
                                            <span class="sale">-30%</span>
                                        </div>
                                        <a href="{{asset('producto/'.$producto->slug)}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Ver Detalle</a>
                                        <img  src="{{asset('img/products/'.$producto->id.'/'.$producto->image)}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">{{$producto->price}} <del class="product-old-price">{{$producto->price*1.5}}</del></h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">{{$producto->name}}</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <button class="primary-btn add-to-cart" id="btn-addcart-{{$producto->id}}" onclick="addCart({{$producto->id}}, 1)" ><i class="fa fa-shopping-cart" ></i> Agregar al carrito</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Single -->
                            <?php $i++; ?>
                            @endforeach

                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /STORE -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <div class="row-filter">
                                <a href="#"><i class="fa fa-th-large"></i></a>
                                <a href="#" class="active"><i class="fa fa-bars"></i></a>
                            </div>
                            <div class="sort-filter">
                                <span class="text-uppercase">Sort By:</span>
                                <select class="input">
                                        <option value="0">Position</option>
                                        <option value="0">Price</option>
                                        <option value="0">Rating</option>
                                    </select>
                                <a href="#" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="page-filter">
                                <span class="text-uppercase">Show:</span>
                                <select class="input">
                                        <option value="0">10</option>
                                        <option value="1">20</option>
                                        <option value="2">30</option>
                                    </select>
                            </div>
                            <ul class="store-pages">

                                {{ $productos->onEachSide(1)->links() }}
                              
                            </ul>
                        </div>
                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /MAIN -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
    </div>
</div>
  







@section('js')
    @parent

@endsection


  @include('layouts.footer')