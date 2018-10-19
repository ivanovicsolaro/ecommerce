@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                   

				  
				 		
				 		{!! Form::open(['route' => 'carrito.addItem', 'action'=>'post', 'id' => 'find-productos']) !!}
						<div class="form-group col-sm-12 col-md-6" id="div-stock_minimo">
				  			{!! Form::label('producto', 'Ingrese Código o Nombre del Producto: *',['class' => 'control-label mb-10 text-left']) !!}

				    	<div class="input-group">
				     		  {!! Form::text('sku', isset($producto)? $producto->min : null, ['class' => 'form-control','autofocus'=>'autofocus', 'id' => 'cadena']) !!}
				      			<span class="input-group-btn">
				        			<button class="btn primary-btn" id="boton-find" type="submit">Agregar</button>
				      			</span>
				    	</div><!-- /input-group -->
				    	{!! Form::close() !!}
				    	</div>

             <div class="form-group col-sm-12 col-md-6" id="div-price"> 
                   {!! Form::label('motivo', 'Motivo: *',['class' => 'control-label mb-10 text-left']) !!}
                    {!! Form::textarea('motivo', null, ['class' => 'form-control', 'rows'=>3, 'cols' => 20, 'autofocus'=>'autofocus', 'id' => 'motivo']) !!}
              </div>

              <div class="form-group col-sm-4 text-right" id="div-price">
                    {!! Form::label('cliente', 'Regresa/n a stock?',['class' => 'control-label mb-10 ']) !!}
                  </div>
                   <div class="form-group col-sm-2" id="div-price">
                           {!! Form::radio('regresa_stock', 1, false , ['class' => 'control-label mb-10 text-left', 'id' => 'regresa_stock1']) !!}
                   {!! Form::label('cliente', 'Si',['class' => 'control-label mb-10 text-left']) !!}&nbsp;&nbsp;
                     {!! Form::radio('regresa_stock', 0, false , ['class' => 'control-label mb-10 text-left', 'id' => 'regresa_stock2']) !!}
                         {!! Form::label('cliente', 'No',['class' => 'control-label mb-10 text-left']) !!}
               
                  
                  
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
					<button class="primary-btn" id="btn_procesar" onclick="devolver()">Procesar</button>
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
        $("#cadena").val('');
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

        function devolver(e){    
          regresa_stock = $('input:radio[name=regresa_stock]:checked').val();    	
          motivo = $('#motivo').val();
        	formData = {regresa_stock:regresa_stock, motivo:motivo};

        	url = "{{route('productos.store-devolucion')}}";
 			
 			    ajax_add(url,'POST',formData,'#btn_procesar');
        
        }

       




    </script> 
    
@endsection 