		


										@foreach(Cart::model()->items->all() as $item)
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="{{asset($item->product->imagen)}}" alt="">
											</div>
											<div class="product-body">
												<h3 class="product-price">{{$item->product->price}} <span class="qty">x {{$item->quantity}}</span></h3>
												<h2 class="product-name"><a href="#">{{$item->product->name}}</a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
										@endforeach
									</div>
									<div class="shopping-cart-btns">
										<button class="main-btn">Ver Carrito</button>
										<button class="primary-btn">Finalizar <i class="fa fa-arrow-circle-right"></i></button>
									


