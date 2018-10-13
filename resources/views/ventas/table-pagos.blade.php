  
				    	@if($order->status == 'Pending')

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
				           {!! Form::select('formasPago', $formasPago, isset($formasPagos)? $formasPagos->description : 'null', ['class' => 'form-control','autofocus'=>'autofocus', 'id' => 'formasPago']) !!}
				    	</div>

				    	
						<div class="form-group col-sm-6" id="div-stock_minimo">
				  			{!! Form::label('monto', 'Monto: *',['class' => 'control-label mb-10 text-left']) !!}
				    	<div class="input-group">
				     		 {!! Form::number('monto', null, ['class' => 'form-control', 'id' => 'client', 'min'=>'1', 'placeholder' => 'Ingrese el importe a abonar', 'id' => 'montoParcial']) !!}
				      		<span class="input-group-btn">
				        		<button class="btn  btn-info" id="add-pago"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
				      		</span>
				    	</div><!-- /input-group -->
				    	
				    	</div>

				    	<input type="hidden" id="id_cliente" name="id_cliente" value="{{$customer->id}}">

				    	@endif




 <table id="datatable-pagos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" >
                        <thead>
                          <tr align="center">
                            <th>Forma de Pago</th> 
                            <th>Tipo de Movimiento</th> 
                            <th>Monto</th>
                            <th>Monto con Interés</th>                     
                            <th style="text-align: center">ACCIONES</th>
                          </tr>
                        </thead>


                        <tbody>
                             
                        </tbody>
                    </table>
