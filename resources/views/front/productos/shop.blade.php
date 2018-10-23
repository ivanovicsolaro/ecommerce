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
                            <div class="sort-filter">
                       
                                <span class="text-uppercase">Ordenar por:</span>
                              
                                <select name="itemOrden" class="input">
                                        <option value="name">Nombre</option>
                                        <option value="price">Precio</option>
                                </select>
                                @if(Request::get('orden') == 'asc')
                                <input type="hidden" name="orden" value="desc">
                                 <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-down"></i></button>
                                @else
                               
                                  <input type="hidden" name="orden" value="asc">
                                 <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-up"></i></button>
                                @endif
                               
                            
                            </div>
                        </div>
                        <div class="pull-right">
                             {{ $productos->onEachSide(1)->links() }}                
                        </div>
                    </div>
                    <!-- /store top filter -->

                    <!-- STORE -->
                    <div id="store">
                        <!-- row -->
                        <div class="row">                        
                            @foreach($productos as $producto)
                            <!-- Product Single -->
                            <div class="col-md-4 col-sm-12 col-xs-12">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <div class="product-label">
                                            @if($producto->created_at->diffInDays() >= 1)
                                            <span>
                                                    Nuevo
                                                  
                                            </span>
                                              @endif
                                            <span class="sale">- {{number_format(100 - (($producto->price * 100)/$producto->price_real),0)}} %</span>
                                        </div>
                                        <a href="{{asset('producto/'.$producto->slug)}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Ver Detalle</a>
                                         @if(!isset($producto->image))
                                          <img  src="{{asset('img/products/sin-imagen.jpg')}}" alt="">
                                         @else
                                          <img  src="{{asset('img/products/'.$producto->path_image.'/'.$producto->image)}}" alt="">
                                          @endif

                                   
                                       
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">{{number_format($producto->price,2)}} <del class="product-old-price">{{number_format($producto->price_real,2)}}</del></h3>
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
                           
                            @endforeach

                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /STORE -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <div class="sort-filter">
                                         
                                <span class="text-uppercase">Ordenar por:</span>
                              
                                <select name="itemOrden" class="input">
                                        <option value="name">Nombre</option>
                                        <option value="price">Precio</option>
                                </select>
                                @if(Request::get('orden') == 'asc')
                                <input type="hidden" name="orden" value="desc">
                                 <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-down"></i></button>
                                @else
                               
                                  <input type="hidden" name="orden" value="asc">
                                 <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-up"></i></button>
                                @endif
                               
                                {!! Form::close()!!}
                            </div>
                        </div>
                        <div class="pull-right">
                            {{ $productos->onEachSide(1)->links() }}
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