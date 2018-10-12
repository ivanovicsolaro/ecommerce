@extends('layouts.app') @section('contenido')

@section('title')

@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">  
<div class="container">
<div class="row placeholders">
          <div class="col-md-3">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-info widget-padding-sm">
                    <div class="widget-big-int plugin-clock">{{$cVentas}}</div>                            
                    <div class="widget-subtitle plugin-date">Cantidad de Ventas</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>

            <div class="col-md-3">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-warning widget-padding-sm">
                    <div class="widget-big-int plugin-clock">$ {{number_format($cVentasTarjeta,2)}}</div>                            
                    <div class="widget-subtitle plugin-date">Total C/Tarjeta</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>

            <div class="col-md-3">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-success widget-padding-sm">
                    <div class="widget-big-int plugin-clock">$ {{$tCaja}}</div>                            
                    <div class="widget-subtitle plugin-date">Total en caja</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>

            <div class="col-md-3">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-danger widget-padding-sm">
                    <div class="widget-big-int plugin-clock">{{$enviosPendientes}}</div>                            
                    <div class="widget-subtitle plugin-date">Envios Pendientes</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>
          
        
          
        

</div>


    <div class="row">
         <div class="col-md-12">
            <div class="header-btns-icon text-right">
                <a class="primary-btn" href="{{route('ventas.create')}}"> <i class="fa fa-plus"></i> Nueva Venta</a>               
            </div>
         </div>
        <div class="col-md-12">

         <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">
                      <div class="table-responsive">
                    <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Estado</th>
                                        <th class="text-center">Forma de Pago</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Acción</th>
                          
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ordenes as $order)
                                    <tr>
                                        <td class="thumb">
                                            {{$order->number}}
                                        </td>
                                        <td class="details">
                                           {{$order->status}}
                                        </td>
                                        <td class="qty text-center">
                                            @switch($order->payment)
                                                @case(1)
                                                    Contado Efectivo
                                                    @break

                                                @case(2)
                                                    Tarjeta Credito
                                                    @break

                                                @case(3)
                                                    Cuenta Corriente
                                                    @break

                                                @case(4)
                                                    Contra Reembolso
                                                    @break
                                               
                                            @endswitch
                                           
                                        </td>

                                        <td class="qty text-center">
                                            {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y h:i:s')}}
                                          
                                        </td>

                                        <td class="total text-center">
                                            {{number_format($order->total_amount, 2)}}
                                        </td>

                                        <td class="total text-center">
                                            <div class='btn-group'>
                                                <a href="{!! route('ventas.show', [Crypt::encrypt($order->id)]) !!}"  data-toggle="tooltip" data-original-title="Editar">
                                                    <button type="button" class="btn btn-default btn-icon-anim btn-square btn-sm">
                                                         <i class="fa fa-eye" aria-hidden="true" alt="Nota de Crédito"></i>
                                                    </button>
                                                </a>
                                            </div> 
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>                    
                            </table>
                        </div>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>                                
</div>

<!-- PAGE CONTENT WRAPPER --> 
@endsection

@section('js')
    @parent
    <script src="{{ asset('back/js/toast-function.js') }}"></script>
    <script src="{{ asset('back/js/ajax_delete.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 
    </script> 
    <script type="text/javascript">
        function eliminar(hash,identificador){

            var box = $("#mb-remove-row");
            box.addClass("open");
            
            box.find(".mb-control-yes").on("click",function(){
                box.removeClass("open");
                var url = "{{ route('productos.destroy',1) }}";
                
                ajax_delete(url,'POST',{id:hash},"#btn_"+identificador)
                $("#trow_"+identificador).hide("slow",function(){
                    $(this).remove();
                });
            });
            
        }
    </script>


@endsection