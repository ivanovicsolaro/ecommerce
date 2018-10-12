@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
        	<div class="pull-left">
        		<h2>Estado: <i>{{$order->status}}</i></h2>
        	</div>

        	@if($order->status != 'Cancelled')
        	  <div class="pull-right">
					<a href="{{route('ventas.cancelar', [Crypt::encrypt($order->id)])}}"><button class="btn  btn-danger" id="btn_procesar" onclick="checkout()"><i class="fa fa-close" aria-hidden="true"></i></button></a>
				</div>
				@endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">

                    <div class="table-responsive-md">
					  <table class="table">
					  <thead>
                                        <tr class="first last">
                                            <th>Productos</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $ot)
                                        <tr class="first odd">
                                            <td>{{ $ot->name }}</td>
                                            <td>{{ $ot->quantity }}</td>
                                            <td>${{ number_format($ot->price, 2, '.', '') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                     <tfoot>
                                    <tr>
                                        <th class="empty" colspan="1"></th>
                                        <th>TOTAL</th>
                                        <th colspan="2" class="total" id="labelTotal">{{number_format($order->total_amount,2) }}</th>
                                    </tr>
                                </tfoot>
					  </table>
					</div>
                   
                        <div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::text('cliente', $customer->firstname.' '.$customer->lastname.' '.$customer->registration_nr, ['class' => 'form-control', 'id' => 'client', 'min'=>'1', 'readonly' => 'true']) !!}
				           <input type="hidden" id="id_cliente" name="id_cliente" value="{{$customer->id}}">
				          
				    	</div>

				    	@if($order->status != 'Cancelled')

				    	<div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('price', 'Tipo de Movimiento: *',['class' => 'control-label mb-10 text-left']) !!}
				          	<select name="tipo_movimiento" id="tipo_movimiento" class="form-control">
				          		<option value="1" selected="">Boleta</option>
				          		<option value="2">Factura</option>
				          		<option value="3">Nota de Débito</option>
				          	</select>
				    	</div>
				 		
				    	<div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('price', 'Forma de Pago: *',['class' => 'control-label mb-10 text-left']) !!}
				          	<select name="formaPago" id="formaPago" class="form-control">
				          		<option value="1">Contado Efectivo</option>
				          		<option value="2">Tarjeta Crédito</option>
				          		<option value="3">Cuenta Corriente</option>
				          		<option value="4">Contra Reembolso</option>
				          	</select>
				    	</div>

				    	 <div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('monto', 'Monto: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::number('monto', null, ['class' => 'form-control', 'id' => 'client', 'min'=>'1', 'placeholder' => 'Ingrese el importe a abonar']) !!}

				           <input type="hidden" id="id_cliente" name="id_cliente" value="{{$customer->id}}">
				          
				    	</div>

				    	@endif


                	</div>
                
                </div>

         
            </div>
           
      @if($order->status != 'Cancelled')
            <div class="pull-right">
					<button class="primary-btn" id="btn_procesar" onclick="checkout()">Procesar</button>
				</div>
				@endif
        </div>
    </section>


@endsection
