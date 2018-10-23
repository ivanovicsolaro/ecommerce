@include('layouts.header')
@include('layouts.menu') 


	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li><a href="#">Productos</a></li>
				<li><a href="{{asset('shop?categoria%5B%5D='.$categoria[0]->id)}}">{{$categoria[0]->descripcion}}</a></li>
				<li class="active">{{$producto->name}}</li>
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
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							   <?php $i = 0; ?> 
                                    @foreach (json_decode($producto->imagenes, true) as $img)
                                        @if(file_exists('img/products/'.$producto->path_image.'/'.$img['name']))
                                            <div class="product-view" @if($i == 0) active @endif">
                                                <img src="{{url('img/products/'.$producto->path_image.'/'.$img['name'])}}">
                                            </div>
                                        @endif
                                        <?php $i++;?>
                                @endforeach
						</div>
						<div id="product-view">
 								<?php $i = 0; ?> 
                                    @foreach (json_decode($producto->imagenes, true) as $img)
                                        @if(file_exists('img/products/'.$producto->path_image.'/thumbnails/'.$img['name']))
                                            <div class="product-view" @if($i == 0) active @endif">
                                                <img src="{{url('img/products/'.$producto->path_image.'/thumbnails/'.$img['name'])}}">
                                            </div>
                                        @endif
                                        <?php $i++;?>
                                @endforeach
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							 <div class="product-label">
                                            @if($producto->created_at->diffInDays() >= 1)
                                            <span>
                                                    Nuevo
                                                  
                                            </span>
                                              @endif
                                            <span class="sale">- {{number_format(100 - (($producto->price * 100)/$producto->price_real),0)}} %</span>
                                        </div>
							<h2 class="product-name">{{$producto->name}}</h2>
							<h3 class="product-price">{{number_format($producto->price,2)}} <del class="product-old-price">${{number_format($producto->price_real,2)}}</del></h3>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o empty"></i>
								</div>
								<a href="#">3 Review(s) / Add Review</a>
							</div>
							<p><strong>Disponibilidad:</strong> In Stock</p>
							<p><strong>Marca:</strong> {{$subcategoria[0]->descripcion}}</p>			
							<div class="product-btns">
								<div class="qty-input">
									<span class="text-uppercase">QTY: </span>
									<input class="input" id="cantidad" type="number">
								</div>
								<button class="primary-btn add-to-cart" onclick="addCart({{$producto->id}}, getCantidad())"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
								<div class="pull-right">
									<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
									<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="product-tab">
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Descripción</a></li>
								
								<li><a data-toggle="tab" href="#tab2">Comentá sobre este producto</a></li>
							</ul>
							<div class="tab-content">
								<div id="tab1" class="tab-pane fade in active">
									<p>{{$producto->description}}</p>
								</div>
								<div id="tab2" class="tab-pane fade in">

									<div class="row">
										<div class="col-md-12">
											<div class="product-reviews">
												

									<div id="disqus_thread"></div>
									<script>									
									(function() { // DON'T EDIT BELOW THIS LINE
									var d = document, s = d.createElement('script');
									s.src = 'https://mayoristacelular.disqus.com/embed.js';
									s.setAttribute('data-timestamp', +new Date());
									(d.head || d.body).appendChild(s);
									})();
									</script>
									<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
											</div>
										</div>
										
									</div>



								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- /Product Details -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Productos Relacionados</h2>
					</div>
				</div>
				<!-- section title -->






                @foreach($relacionados as $productoRelacionado)

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<a href="{{asset('producto/'.$productoRelacionado->slug)}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Ver Detalle</a>


  								@if(!isset($productoRelacionado->imageName))
                                          <img  src="{{asset('img/products/sin-imagen.jpg')}}" alt="">
                                         @else
                                          	<img src="{{asset('img/products/'.$productoRelacionado->path_image.'/'.$productoRelacionado->imageName)}}" alt="">
                                          @endif


						
						</div>
						<div class="product-body">
							<h3 class="product-price">{{$productoRelacionado->price}} <del class="product-old-price">{{$productoRelacionado->price*1.5}}</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="#">{{$productoRelacionado->name}}</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart" onclick="addCart({{$productoRelacionado->id}}, 1)"><i class="fa fa-shopping-cart"></i> Agregar al Carrito</button>
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



@section('js')
    @parent
<script id="dsq-count-scr" src="//mayoristacelular.disqus.com/count.js" async></script>
@endsection


  @include('layouts.footer')