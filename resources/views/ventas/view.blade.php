@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
        	<div class="pull-left">
        		<h2>Estado: <i> @switch($order->status)
                                            @case('Pending')
                                                <em style="color: orange"><b>Pendiente</b></em>
                                                @break
                                            @case('Cancelled')
                                                <em style="color: red"><b>Cancelado</b></em>
                                                @break
                                            @case('Completed')
                                                <em style="color: green"><b>Completada</b></em>
                                                @break
                                        @endswitch </i>
                 </h2>
        	</div>

        	@if($order->status == 'Pending')
        	  <div class="pull-right">
					<a href="{{route('ventas.cancelar', [Crypt::encrypt($order->id)])}}"><button class="btn  btn-danger" id="btn_procesar" onclick="checkout()"><i class="fa fa-close" aria-hidden="true"></i></button></a>
				</div>
				@endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">

                    <div class="table-responsive-md">
					  <table class="table">
					  <thead>
                                        <tr class="first last">
                                            <th>Productos</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $ot)
                                        <tr class="first odd">
                                            <td>{{ $ot->name }}</td>
                                            <td>{{ $ot->quantity }}</td>
                                            <td>${{ number_format($ot->price, 2, '.', '') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                     <tfoot>
                                    <tr>
                                        <th class="empty" colspan="1"></th>
                                        <th>TOTAL</th>
                                        <th colspan="2" class="total" id="total">{{number_format($order->total_amount,2) }}</th>
                                    </tr>
                                </tfoot>
					  </table>
					</div>
                    
                    
                        <div class="form-group col-sm-6" id="div-price">
				           {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}
				           {!! Form::text('cliente', $customer->firstname.' '.$customer->lastname.' '.$customer->registration_nr, ['class' => 'form-control', 'id' => 'client', 'min'=>'1', 'readonly' => 'true']) !!}
				           <input type="hidden" id="id_cliente" name="id_cliente" value="{{$customer->id}}">
				          
				    	</div>
                          @include('ventas.table-pagos')

                        
                	</div>
                
                </div>

         
            </div>
           
      @if($order->status == 'Pending')
            <div class="pull-left">
					<button class="primary-btn" id="btn_procesar" onclick="sendPagos()">Procesar</button>
				</div>
				@endif

               
        </div>
    </section>


@endsection



@section('js')
    @parent
    <script src="{{ asset('js/ajax-add.js') }}"></script>

    <script type='text/javascript'>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });  
    
    $(document).ready(function() { 

    $("#add-pago").on('click', agregar);  

    $("#datatable-pagos").on('click', ".btn-danger", eliminarFila);

    function eliminarFila(){
       $(this).parent().parent().fadeOut("slow", function(){$(this).remove(); });
    }

    cont = 0;
    function agregar(){

        idTpoMovimiento = parseInt($('#tipo_movimiento').val());

        idFormaPago = parseInt($('#formasPago').val());
        montoParcial = parseFloat($('#montoParcial').val());
        
        if ($("#fila"+idFormaPago).length){
            swal({
                title: 'La forma de pago ya está cargada',
                text: 'Eliminelá y vuelva a generar una.',
                type: 'error',
                confirmButtonText: 'Continuar'
              })
        }else{
             if(montoParcial <= 0){
                swal({
                title: 'El monto no es correto',
                html: 'Ingrese un monto mayor que 0',
                type: 'error',
                confirmButtonText: 'Continuar'
              })
            }else{ 

            $.get( "{{route('payment.find')}}", { idFormaPago: idFormaPago, idTipoMovimiento:idTpoMovimiento, monto:montoParcial } )
                .done(function( data ) {
                   var fila = '<tr id="fila'+idFormaPago+'">'+
                                '<td>'+data.desFP+'</td><input type="hidden" name="array['+cont+'][idFP]" value="'+data.idFP+'">'+
                                '<td>'+data.desTM+'</td><input type="hidden" name="array['+cont+'][idTM]" value="'+data.idTM+'">'+
                                '<td>'+data.monto+'</td><input type="hidden" name="array['+cont+'][monto]" value="'+data.monto+'">'+
                                '<td>'+data.montoInteres+'</td><input type="hidden" name="array['+cont+'][montoInteres]" value="'+data.montoInteres+'">'+
                                '<td class="text-center"><div class="btn btn-danger">Eliminar</div></td>'+                                
                                '</tr>';
                $('#datatable-pagos').append(fila);
               
            cont++;  

              $('#montoParcial').val('');
              });
              
        }
        }     

    }


    

    });


        function sendPagos(){
        
     
            var formData = $("#datatable-pagos :input").serialize();
            var url = "{{route('ventas.add-pagos', Crypt::encrypt($order->id))}}";
            var urlRedirect = "{{route('ventas.show', Crypt::encrypt($order->id))}}" ;

            ajax_add(url,'POST',formData,'#btn_procesar', urlRedirect);
        };
      
     


</script>



@endsection 
