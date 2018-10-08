	<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Producto</th>
										<th></th>
										<th class="text-center">Precio</th>
										<th class="text-center">Cantidad</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									@foreach(Cart::model()->items->all() as $item)
									<tr>
										<td class="thumb">
											 @if(!isset($item->product->imagen))
                                          <img  src="{{asset('img/products/sin-imagen.jpg')}}" alt="">
                                         @else
                                         <img src="{{asset($item->product->imagen)}}" alt="">
                                          @endif
										</td>
										<td class="details">
											<a href="{{asset('producto/'.$item->product->slug)}}">{{$item->product->name}}</a>
											<ul>
												<li><span>Código: {{$item->product->sku}}</span></li>
											</ul>
										</td>
										<td class="price text-center"><strong>${{number_format($item->product->price,2)}}</strong><br><del class="font-weak"><small>$40.00</small></del></td>
										<td class="qty text-center"><input class="input" type="number" id="cantidad{{$item->product->id}}" value="{{$item->quantity}}"> <button style="background-color: transparent;border: none;" onclick="updateCart({{$item->product->id}})"><i class="fa fa-refresh" aria-hidden="true"></i></button></td>
										<td class="total text-center"><strong class="primary-color">${{number_format($item->quantity * $item->price,2)}}</strong></td>
										<td class="text-right"><button class="main-btn icon-btn" onclick="removeCart({{$item->product->id}}, getCantidadById({{$item->product->id}})*-1)"><i class="fa fa-close"></i></button></td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total">{{number_format(Cart::total(),2)}}</th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>Envío</th>
										<td colspan="2">Tarifa Reducida ($70.00)</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total">{{number_format(Cart::total() + 70,2) }}</th>
									</tr>
								</tfoot>
							</table>