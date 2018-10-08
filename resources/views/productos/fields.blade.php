 <div class="row">
 <div class="col-sm-12 col-md-6">

    <div class="form-group col-sm-12" id="div-name">
        {!! Form::label('name', 'Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('name', isset($producto)? $producto->name : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
    </div>

    <div class="form-group col-sm-6" id="div-price">
            {!! Form::label('price', 'Precio Descuento: *',['class' => 'control-label mb-10 text-left']) !!}
            {!! Form::text('price', isset($producto)? $producto->price : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
        </div>

    <div class="form-group col-sm-6" id="div-price">
            {!! Form::label('price_real', 'Precio Real: *',['class' => 'control-label mb-10 text-left']) !!}
            {!! Form::text('price_real', isset($producto)? $producto->price_real : null, ['class' => 'form-control','autofocus'=>'autofocus', 'min'=>'1']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-stock">
        {!! Form::label('stock', 'Stock: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('stock', isset($producto)? $producto->stock : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-stock">
        {!! Form::checkbox('dolar', 1, isset($producto) && ($producto->if_dolar == 1) ? true : false) !!}
        {!! Form::label('dolar', 'Varia con el dolar',['class' => 'control-label mb-10 text-left']) !!}<br/>
        {!! Form::checkbox('destacado', 1, isset($producto) && ($producto->destacado == 1) ? true : 0) !!}
        {!! Form::label('destacado', 'Producto destacado',['class' => 'control-label mb-10 text-left']) !!}<br/>
        {!! Form::checkbox('combo', 1, isset($producto) && ($producto->combo == 1) ? true : false) !!}
        {!! Form::label('combo', 'Es combo',['class' => 'control-label mb-10 text-left']) !!}
     
    </div>

    <div class="form-group col-sm-6" id="div-stock_minimo">
        {!! Form::label('stock_minimo', 'Stock: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('stock_minimo', isset($producto)? $producto->min : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-stock_maximo">
        {!! Form::label('stock_maximo', 'Stock: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('stock_maximo', isset($producto)? $producto->max : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    </div>
 <div class="col-sm-12 col-md-6">

     <div class="form-group col-sm-6" id="div-price">
            {!! Form::label('price', 'Categoria: *',['class' => 'control-label mb-10 text-left']) !!}
           {!! Form::select('categoria_id', $categorias, isset($producto)? $producto->categorie_id : 'null', ['class' => 'form-control','autofocus'=>'autofocus', 'placeholder' => 'Seleccione una opci&oacute;n..']) !!}
        </div>

         <div class="form-group col-sm-6" id="div-price">
            {!! Form::label('price', 'Subcategoria: *',['class' => 'control-label mb-10 text-left']) !!}
           {!! Form::select('subcategoria_id', $subcategorias, isset($producto)? $producto->subcategorie_id : 'null', ['class' => 'form-control','autofocus'=>'autofocus', 'placeholder' => 'Seleccione una opci&oacute;n..']) !!}
        </div>


    <div class="form-group col-sm-12" id="div-sku">
        {!! Form::label('sku', 'Código: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('sku', isset($producto)? $producto->sku : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-12" id="div-description">
        {!! Form::label('description', 'Descripción: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::textarea('description', isset($producto)? $producto->description : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
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