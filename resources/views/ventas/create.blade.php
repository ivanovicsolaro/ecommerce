@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                   
                        <div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::text('cliente', isset($producto)? $producto->price_real : 'CONSUMIDOR FINAL', ['class' => 'form-control', 'id' => 'client', 'min'=>'1']) !!}
				           <div id="clientList"></div>
				           <input type="hidden" id="id_cliente" name="id_cliente" value="1">
				          
				    	</div>

				    	<div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('price', 'Tipo de Movimiento: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::select('tipo_movimiento', $tiposMovimientos, isset($producto)? $producto->categorie_id : 'selected', ['class' => 'form-control', 'id' => 'tipoMovimiento']) !!}
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

				    	<div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('price', 'Tipo de Movimiento: *',['class' => 'control-label mb-10 text-left']) !!}
				          	<select name="formaPago" id="formaPago" class="form-control">
				          		<option value="1">Contado Efectivo</option>
				          		<option value="2">Tarjeta Crédito</option>
				          		<option value="3">Cuenta Corriente</option>
				          		<option value="4">Contra Reembolso</option>
				          	</select>
				    	</div>

                	</div>
                
                </div>

         
            </div>
             <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                		<div id="table-punto-venta"></div>
                </div>
                
            </div>
            <div class="pull-right">
					<button class="primary-btn" id="btn_procesar" onclick="checkout()">Procesar</button>
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
       		$('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');

       		$('#client').keyup(function(){
       			var query = $(this).val();
       			if(query != ''){
       				$.ajax({
       					url: "{{ route('client.find')}}",
       					method: 'get',
       					data: {query:query},
       					success:function(data){
       						$('#clientList').fadeIn();
       						$('#clientList').html(data);
       					}
       				})
       			}
       		});
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

        function seleccionar(id){
        	$('#client').val($('#list'+id).text());
        	$('#id_cliente').val(id);
        	$('#clientList').fadeOut();        	        		
        };

        function checkout(){
        	cliente = $('#id_cliente').val();
        	tipoMovimiento =  $('#tipoMovimiento').val();    
        	formaPago = $('#formaPago').val();

        	$boton = '#btn_procesar';
      		$.ajax({
		        url: "",
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
        };

       




    </script> 
    
@endsection 