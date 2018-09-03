 <div class="row">
 <div class="col-sm-12 col-md-6">

    <div class="form-group col-sm-12" id="div-name">
        {!! Form::label('name', 'Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('name', isset($producto)? $producto->name : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-stock">
        {!! Form::label('stock', 'Stock: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('stock', isset($producto)? $producto->stock : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-price">
            {!! Form::label('price', 'Precio: *',['class' => 'control-label mb-10 text-left']) !!}
            {!! Form::text('price', isset($producto)? $producto->price : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
        </div>
    </div>
 <div class="col-sm-12 col-md-6">

    <div class="form-group col-sm-12" id="div-sku">
        {!! Form::label('sku', 'Código: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('sku', isset($producto)? $producto->sku : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-12" id="div-description">
        {!! Form::label('description', 'Descripción: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('description', isset($producto)? $producto->description : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    </div>

    <div class="form-group col-sm-12 col-xs-12">
        <div class="text-left col-md-6">
              <a href="" class="btn main-btn btn-anim" id="cargar-imagen">
                <i class="fa fa-file-image-o"></i><span class="btn-text"> Cargar Imágenes</span></a>
        </div>
        <div class="text-right col-md-6">
    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-producto']) !!}
    <a href="{!! route('productos.index') !!}" class="btn main-btn btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
    </a>
</div>
</div>

</div>