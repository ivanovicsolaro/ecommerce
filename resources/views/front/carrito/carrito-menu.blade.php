@foreach(Cart::model()->items->all() as $item)
	<div class="product product-widget">
		<div class="product-thumb">
			<img src="{{asset($item->product->imagen)}}" alt="">
		</div>
		<div class="product-body">
			<h3 class="product-price">$ {{number_format($item->product->price,2)}}<span class="qty"> x {{$item->quantity}}</span></h3>
			<h2 class="product-name"><a href="{{asset('producto/'.$item->product->slug)}}">{{$item->product->name}}</a></h2>
		</div>
		<button class="cancel-btn" onclick="removeCart({{$item->product->id}},-1)"><i class="fa fa-trash"></i></button>
	</div>
@endforeach
<div class="shopping-cart-btns">
	<a class="main-btn" href="{{asset('/carrito')}}">Ver Carrito</a>
		<a class="primary-btn" >Finalizar <i class="fa fa-arrow-circle-right"></i></a>
</div>
									


