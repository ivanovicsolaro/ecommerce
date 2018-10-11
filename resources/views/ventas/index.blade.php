@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Ventas
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

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
                    <table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Estado</th>
                                        <th class="text-center">Forma de Pago</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Total</th>
                          
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
                                    </tr>
                                    @endforeach
                                </tbody>                    
                            </table>
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