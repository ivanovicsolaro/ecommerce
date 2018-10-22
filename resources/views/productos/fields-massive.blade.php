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
                     {!! Form::open(['route' => 'productos.store-massive', 'action'=>'post', 'id' => 'form-productos', 'files' => 'true']) !!}
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
						            {!! Form::label('imagen1', 'Imagen 1 (destacada): *',['class' => 'control-label mb-10 text-left']) !!}
						             {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>

						  

						       <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('imagen2', 'Imagen 2: *',['class' => 'control-label mb-10 text-left']) !!}
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
						            {!! Form::label('imagen3', 'Imagen 3: *',['class' => 'control-label mb-10 text-left']) !!}
						           {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>

						         <div class="form-group col-sm-6" id="div-price">
						            {!! Form::label('imagen4', 'Imagen 4: *',['class' => 'control-label mb-10 text-left']) !!}
						             {!! Form::file('imagenes[]', null , ['class' => 'form-control','autofocus'=>'autofocus', 'required' => 'true']) !!}
						        </div>



						   

						    </div>

					

						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="header-btns-icon text-right">
									<a onclick="addFila()" class="primary-btn">Agregar Campo</a>
								</div>
								
							</div>
						</div>
						
						<h2 class="section-title">Listado de Productos</h2>
					
						<div id="dinamicDiv">
							<div class="row">
								<div class="col-sm-12 col-md-12">
		  					
								</div>
							</div>
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
       
        cont = 0;
        function addFila(){
        	 dinamicDiv = $('#dinamicDiv');
        	$('<div class="row">'+
								'<div class="col-sm-12 col-md-12">'+
		  							'<div class="form-group col-sm-3" id="div-name">'+
								        '<label for="name" class="control-label mb-10 text-left">Nombre: +*</label>'+
								        '<input class="form-control" autofocus="autofocus" maxlength="30" name="producto['+cont+'][name]" type="text" id="name">'+
								    '</div>'+

								       '<div class="form-group col-sm-1" id="div-stock">'+
								        '<label for="stock" class="control-label mb-10 text-left">Stock: *</label>'+
								        '<input class="form-control" autofocus="autofocus" name="producto['+cont+'][stock]" type="text" id="stock">'+
								   '</div>'+

								    '<div class="form-group col-sm-1" id="div-stock">'+
								        '<label for="min" class="control-label mb-10 text-left">Min: *</label>'+
								        '<input class="form-control" autofocus="autofocus" name="producto['+cont+'][min]" type="text" id="min">'+
								   '</div>'+

								    '<div class="form-group col-sm-1" id="div-stock">'+
								        '<label for="max" class="control-label mb-10 text-left">Max: *</label>'+
								        '<input class="form-control" autofocus="autofocus" name="producto['+cont+'][max]" type="text" id="max">'+
								   '</div>'+


								    '<div class="form-group col-sm-2" id="div-sku">'+
								        '<label for="sku" class="control-label mb-10 text-left">C&oacute;digo: *</label>'+
								        '<input class="form-control" autofocus="autofocus" name="producto['+cont+'][sku]" type="text" id="sku">'+
								    '</div>'+

								     '<div class="form-group col-sm-3" id="div-description">'+
								        '<label for="description" class="control-label mb-10 text-left">Descripci&oacute;n: *</label>'+
								        '<textarea class="form-control" rows="5" cols="20" autofocus="autofocus" name="producto['+cont+'][description]" id="description"></textarea>'+
								    '</div>'+

								    '<div class="form-group col-sm-1" id="div-description">'+
								        '<a class="header-btns-icon" id="removeFila"><i class="fa fa-times" aria-hidden="true"></i></a>'+
								    '</div>'+
								'</div>'+
							'</div>').appendTo(dinamicDiv);

        	cont++;  
        }

        $("#dinamicDiv").on('click', ".header-btns-icon", eliminarFila);

        function eliminarFila(){
        	 $(this).parent().parent().fadeOut("slow", function(){$(this).remove();});
        }
    </script> 
    
@endsection 




