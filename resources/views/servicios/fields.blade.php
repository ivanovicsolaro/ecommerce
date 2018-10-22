 


 <div class="form-group col-sm-6" id="div-price">
	{!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}
	{!! Form::text('cliente', isset($servicio)? $servicio->customer->name : 'CONSUMIDOR FINAL', ['class' => 'form-control', 'id' => 'client', 'min'=>'1']) !!}
	<div id="clientList"></div>
	<input type="hidden" id="id_cliente" name="id_cliente" value="1">
</div>

  <div class="form-group col-sm-3" id="div-marca">
        {!! Form::label('marca', 'Marca: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('marca', isset($servicio)? $servicio->marca : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

     <div class="form-group col-sm-3" id="div-modelo">
        {!! Form::label('modelo', 'Modelo: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('modelo', isset($servicio)? $servicio->modelo : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

   <div class="form-group col-sm-3" id="div-price">
		{!! Form::label('estado', 'Estado: *',['class' => 'control-label mb-10 text-left']) !!}
		   	<select name="estado" id="estado" class="form-control">
		   		<option value="Ingresado" selected="" @if($servicio->estado == 'Ingresado') 'selected' @endif>Ingresado</option>
		   		<option value="En proceso de revision">En proceso de revisión</option>
		   		<option value="Esperando aceptación presupuesto">Esperando aceptación presupuesto</option>
		   		<option value="En proceso de reparacion">En proceso de reparación</option>
		   		<option value="No admite solución">No admite solución</option>
		   		<option value="Reparado">Reparado</option>
		   		<option value="Garantía">Garantía</option>
		   	</select>
	</div>

     <div class="form-group col-sm-3" id="div-estado">
        {!! Form::label('nro_serie', 'Nro. Serie: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('nro_serie', isset($servicio)? $servicio->nro_serie : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

     <div class="form-group col-sm-3" id="div-precio_presupuestado">
        {!! Form::label('precio_presupuestado', 'Precio presupuestado: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::number('precio_presupuestado', isset($servicio)? $servicio->precio_presupuestado : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

     <div class="form-group col-sm-3" id="div-precio_final">
        {!! Form::label('precio_final', 'Precio final: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::number('precio_final', isset($servicio)? $servicio->precio_final : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

 <div class="form-group col-sm-12" id="div-description">
        {!! Form::label('description', 'Descripción de la falla: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::textarea('description', isset($servicio)? $servicio->descripcion_falla : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
    </div>

     <div class="form-group col-sm-12" id="div-diagnostico">
        {!! Form::label('diagnostico', 'Diagnostico: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::textarea('diagnostico', isset($servicio)? $servicio->diagnostico : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
    </div>

     <div class="form-group col-sm-12" id="div-mano_obra">
        {!! Form::label('mano_obra', 'Detalle mano de obra: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::textarea('mano_obra', isset($servicio)? $servicio->detalle_mano_obra : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
    </div>

<div class="pull-right">
					<button class="primary-btn" id="add-servicio">Procesar</button>
				</div>