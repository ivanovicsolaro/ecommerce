@extends('layouts.app') @section('contenido')

@section('title')
    Agregar Producto Masivamente
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                     {!! Form::open(['route' => 'productos.store', 'action'=>'post', 'id' => 'form-productos']) !!}
                    {{ csrf_field() }}
                      
						<div class="row">
						 <div class="col-sm-12 col-md-6">

						    <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price', 'Precio Descuento: *',['class' => 'control-label mb-10 text-left']) !!}
						            {!! Form::text('price', isset($producto)? $producto->price : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
						        </div>

						    <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price_real', 'Precio Real: *',['class' => 'control-label mb-10 text-left']) !!}
						            {!! Form::text('price_real', isset($producto)? $producto->price_real : null, ['class' => 'form-control','autofocus'=>'autofocus', 'min'=>'1']) !!}
						    </div>

						  <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price', 'Imagen 1 (destacada): *',['class' => 'control-label mb-10 text-left']) !!}
						             {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>

						  

						       <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price', 'Imagen 2: *',['class' => 'control-label mb-10 text-left']) !!}
						             {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>

						          <div class="form-group col-sm-6" id="div-stock">
						        {!! Form::checkbox('dolar', 1, isset($producto) && ($producto->if_dolar == 1) ? true : false) !!}
						        {!! Form::label('dolar', 'Varia con el dolar',['class' => 'control-label mb-10 text-left']) !!}<br/>
						        {!! Form::checkbox('destacado', 1, isset($producto) && ($producto->destacado == 1) ? true : 0) !!}
						        {!! Form::label('destacado', 'Producto destacado',['class' => 'control-label mb-10 text-left']) !!}
						     
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

						         <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price', 'Imagen 3: *',['class' => 'control-label mb-10 text-left']) !!}
						           {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>

						         <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('price', 'Imagen 4: *',['class' => 'control-label mb-10 text-left']) !!}
						             {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>



						   

						    </div>

					

						</div>


  							<div class="form-group col-sm-4" id="div-name">
						        {!! Form::label('name', 'Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
						        {!! Form::text('name', isset($producto)? $producto->name : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
						    </div>

						       <div class="form-group col-sm-2" id="div-stock">
						        {!! Form::label('stock', 'Stock: *',['class' => 'control-label mb-10 text-left']) !!}
						        {!! Form::text('stock', isset($producto)? $producto->stock : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
						    </div>


						    <div class="form-group col-sm-2" id="div-sku">
						        {!! Form::label('sku', 'Código: *',['class' => 'control-label mb-10 text-left']) !!}
						        {!! Form::text('sku', isset($producto)? $producto->sku : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
						    </div>

						     <div class="form-group col-sm-4" id="div-description">
						        {!! Form::label('description', 'Descripción: *',['class' => 'control-label mb-10 text-left']) !!}
						        {!! Form::textarea('description', isset($producto)? $producto->description : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
						    </div>

						    	    <div class="form-group col-sm-12 col-xs-12">
						        <div class="text-left col-md-6">
						              
						        </div>
						        <div class="text-right col-md-6">
						    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
						                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-producto']) !!}
						    <a href="{!! route('productos.index') !!}" class="btn main-btn btn-anim">
						        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
						    </a>
						</div>
						</div>


                    {!! Form::close() !!}
                </div>
                
                </div>

         
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script src="{{ asset('js/ajax-add.js') }}"></script>
    @parent
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

         $(document).ready(function(){
           $("#cargar-imagen").attr('disabled','disabled');
           $("#cargar-imagen").attr('style','pointer-events: none');
        });

        var data_form = $("#form-productos");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_add(url,'POST',formData,'#add-producto') 
        });
    </script> 
    
@endsection 




