@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                   
                        <div class="form-group col-sm-6" id="div-price">
				            {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}
				            {!! Form::text('cliente', isset($producto)? $producto->price_real : null, ['class' => 'form-control','autofocus'=>'autofocus', 'min'=>'1']) !!}
				    	</div>

				    	<div class="form-group col-sm-6" id="div-price">
				            {!! Form::label('price', 'Tipo de Movimiento: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::select('tipo_movimiento', $tiposMovimientos, isset($producto)? $producto->categorie_id : 'null', ['class' => 'form-control','autofocus'=>'autofocus', 'placeholder' => 'Seleccione una opci&oacute;n..']) !!}
				    	</div>
				 		{!! Form::open(['route' => 'ventas.store', 'action'=>'post', 'id' => 'form-productos']) !!}

				        {{ csrf_field() }}
						<div class="form-group col-sm-6" id="div-stock_minimo">
				  			{!! Form::label('producto', 'Ingrese Código o Nombre del Producto: *',['class' => 'control-label mb-10 text-left']) !!}
				    	<div class="input-group">
				     		  {!! Form::text('producto', isset($producto)? $producto->min : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
				      			<span class="input-group-btn">
				        			<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
				      			</span>
				    	</div><!-- /input-group -->
				    	{!! Form::close() !!}
				    	</div>

                	</div>
                
                </div>

         
            </div>
             <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                		<div id="table-punto-venta"></div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script src="{{ asset('js/ajax-add.js') }}"></script>
    @parent


    <script type="text/javascript">

    $(document).ready(function(){
       		$('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');
		});


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
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