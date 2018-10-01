@include('layouts.header')
@include('layouts.menu') 


	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Checkout</li>
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
				<form id="checkout-form" class="clearfix">
					<div class="col-md-6">
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Detalles de Facturación</h3>
							</div>






  <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nombre <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="firstname" value="@if(isset($customer->firstname)){{$customer->firstname}} @endif" >
                                     @if ($errors->has('firstname'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('firstname') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Apellido <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="lastname" value="@if(isset($customer->lastname)){{$customer->lastname}} @endif" >
                                     @if ($errors->has('lastname'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('lastname') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" class="form-control" name="email" value="@if(isset($customer->email)){{$customer->email}} @endif" >
                                     @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Teléfono <span class="required">*</span></label>
                                    <input type="phone" class="form-control" name="phone" value="@if(isset($customer->phone)){{$customer->phone}} @endif" >
                                     @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                        </div>

                                <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ciudad <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="localidad" value="@if(isset($address[0]->city)){{$address[0]->city}} @endif" >
                                     @if ($errors->has('localidad'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('localidad') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Calle <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="calle" id="calle" value="@if(isset($address[0]->address)){{$address[0]->address}} @endif" >
                                     @if ($errors->has('calle'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('calle') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Número <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="numero" value="@if(isset($address[0]->number)){{$address[0]->number}} @endif" >
                                     @if ($errors->has('numero'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('numero') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Piso</label>
                                    <input type="text" class="form-control" name="piso" value="@if(isset($address[0]->piso)){{$address[0]->piso}} @endif">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dpto.</label>
                                    <input type="text" class="form-control" name="depto" value="@if(isset($address[0]->depto)){{$address[0]->depto}} @endif">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Código Postal <span class="required">*</span></label>
                                    <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" value="@if(isset($address[0]->postalcode)){{$address[0]->postalcode}} @endif" >
                                     @if ($errors->has('codigo_postal'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('codigo_postal') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                            </div>
                        </div>

						</div>
					</div>

					<div class="col-md-6">
						<div class="shiping-methods">
							<div class="section-title">
								<h4 class="title">Medios de Envío</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-1" checked>
								<label for="shipping-1">Retiro del local -  $0.00</label>
								<div class="caption">
									<p>Retirar el pedido personalmente o por un tercero en nuestro local de venta al público.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-2">
								<label for="shipping-2">Área Metropolitana - $70.00</label>
								<div class="caption">
									<p>Envío el pedido a domicilio.<br/>Esta opción es válida para la ciudad de Colonia Avellaneda, Paraná, Oro Verde y San Benito.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="shipping" id="shipping-2">
								<label for="shipping-2">Envio Regional - $200.00</label>
								<div class="caption">
									<p>Envío el pedido a domicilio.<br/>Esta opción es válida cualquier localidad de la provincia de Entre Ríos y Santa Fe.
										<p>
								</div>
							</div>
						</div>

						<div class="payments-methods">
							<div class="section-title">
								<h4 class="title">Medios de Pago</h4>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-1" checked>
								<label for="payments-1">Transferencia Bancaria Directa</label>
								<div class="caption">
									<p>Datos Bancarios.
										<p>
								</div>
							</div>
							<div class="input-checkbox">
								<input type="radio" name="payments" id="payments-2">
								<label for="payments-2">Todo Pago (todas las tarjetas)</label>
								<div class="caption">
									<p>Abone el pedido con tarjeta. <b><u>Esta opción posee un recargo del 25%.</u></b>
										<p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Order Review</h3>
							</div>
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
										<td class="thumb"><img src="{{asset($item->product->imagen)}}" alt=""></td>
										<td class="details">
											<a href="{{asset('producto/'.$item->product->slug)}}">{{$item->product->name}}</a>
											<ul>
												<li><span>Código: {{$item->product->sku}}</span></li>
											</ul>
										</td>
										<td class="price text-center"><strong>${{number_format($item->product->price,2)}}</strong><br><del class="font-weak"><small>$40.00</small></del></td>
										<td class="qty text-center">{{$item->quantity}}</td>
										<td class="total text-center"><strong class="primary-color">${{number_format($item->quantity * $item->price,2)}}</strong></td>										
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
							<div class="pull-right">
								<button class="primary-btn">Place Order</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->






@section('js')
    @parent

@endsection


  @include('layouts.footer')