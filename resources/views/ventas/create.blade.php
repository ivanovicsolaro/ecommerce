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
				 		
				 		{!! Form::open(['route' => 'carrito.addItem', 'action'=>'post', 'id' => 'find-productos']) !!}
						<div class="form-group col-sm-6" id="div-stock_minimo">
				  			{!! Form::label('producto', 'Ingrese Código o Nombre del Producto: *',['class' => 'control-label mb-10 text-left']) !!}
				    	<div class="input-group">
				     		  {!! Form::text('sku', isset($producto)? $producto->min : null, ['class' => 'form-control','autofocus'=>'autofocus', 'id' => 'cadena']) !!}
				      			<span class="input-group-btn">
				        			<button class="btn primary-btn" id="boton-find" type="submit">Buscar</button>
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

        $("#find-productos").submit(function(e){
        	e.preventDefault();
        	var cadena = $("#cadena").val();
        	$boton = '#boton-find';
      		$.ajax({
		        url: "{{route('carrito.addItem')}}",
		        type:'post',
		        data: {sku: cadena, cantidad: 1},
		        beforeSend: function() {
		         	$($boton).buttonLoader('start');
		        },
		        success: function(data) {
		          if(data['validate'] == 1){
		          	 $('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');
		             $($boton).buttonLoader('stop');
		          }else{
		              swal({
						  type: 'error',
						  title: 'Oops...  :(',
						  text: data['msg']
						});
		              $($boton).buttonLoader('stop');
		          }
		        },
		        error: function (data) {
		           swal({
						  type: 'error',
						  title: 'Oops...  :(',
						  text: 'No existen productos con este código'
						});
		              $($boton).buttonLoader('stop');
		        }
		    });
		})

		function removeCartVenta(id, cantidad)
        {
            $.ajax({
             	url: "{{route('carrito.removeItem')}}",
		        type:'post',
		        data:{id:id, cantidad:cantidad},
                success: function(data) {
                 	$('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');
                },
                error: function (data) {
                    $('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');
                }
            });
        }




    </script> 
    
@endsection 