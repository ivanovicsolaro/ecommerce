 <div class="row">
 <div class="col-sm-12 col-md-6">

    <div class="form-group col-sm-6" id="div-name">
        {!! Form::label('tipo_movimiento_id', 'Tipo Movimiento: *',['class' => 'control-label mb-10 text-left']) !!}
        <select name="tipo_movimiento_id" class="form-control">
          <option value="">Seleccióne una opción</option>
          <option value="1">Boleta</option>
          <option value="2">Factura</option>
          <option value="7">Apertura Caja Diaria / Efectivo en Caja</option>
          <option value="8">Cierre Caja Diaria / Retiro de Efectivo</option>
          <option value="9">Ingresos Varios Efectivo a Caja</option>
          <option value="10">Gasto de Cafeteria</option>
          <option value="11">Pago Alquiler</option>
          <option value="12">Reparación</option>
          <option value="13">Pago Impuestos Varios</option>
          <option value="14">Devolución de dinero por garantía/ajuste</option>
        </select>
    </div>

     <div class="form-group col-sm-6" id="div-tax_nr">
        {!! Form::label('monto', 'Monto: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::number('monto', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

     <div class="form-group col-sm-12" id="div-tax_nr">
        {!! Form::label('nro_comprobante', 'Nro. comprobante: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::number('nro_comprobante', null, ['class' => 'form-control','autofocus'=>'autofocus', 'placeholder' => 'Nro de devolución, orden, venta, etc.']) !!}
    </div>



</div>
<div class="col-sm-12 col-md-6">
 
   <div class="form-group col-sm-12 col-md-12" id="div-price"> 
                   {!! Form::label('motivo', 'Motivo: *',['class' => 'control-label mb-10 text-left']) !!}
                    {!! Form::textarea('motivo', null, ['class' => 'form-control', 'rows'=>3, 'cols' => 20, 'autofocus'=>'autofocus', 'placeholder' => 'Ej: Devolución 001', 'id' => 'motivo']) !!}
              </div>


    </div>

     <div class="form-group col-sm-12 col-xs-12">
        <div class="text-right col-md-12">
    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-movimiento']) !!}
    <a href="{!! route('movimientos.index') !!}" class="btn main-btn btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
    </a>
</div>
</div>

</div>