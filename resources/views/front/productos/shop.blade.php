@include('layouts.header')
@include('layouts.menu') 


	
	  <div id="home">
        <!-- container -->
        <div class="container">

          




    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">SHOPPING MAYORISTA</h2>
                    </div>
                </div>
                <!-- section title -->


           		@foreach($productos as $producto)

                <!-- Product Single -->
                <div class="col-md-4 col-sm-4 col-xs-6">
                    <div class="product product-single">
                        <div class="product-thumb">
                        	 <div class="product-label">
                                <span>New</span>
                                 <span class="sale">-20%</span>
                            </div>
                            <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Ver detalle</button>
                            <img src="./img/product01.jpg" alt="">
                        </div>
                        <div class="product-body">
                            <h3 class="product-price">{{$producto->price}} <del class="product-old-price">{{$producto->price}}</del></h3>
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
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Single -->
                @endforeach
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