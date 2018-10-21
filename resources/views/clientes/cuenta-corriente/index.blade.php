@extends('layouts.app') @section('contenido')

@section('title')
    Cuenta Corriente
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">
        <div class="container">
        <div class="row placeholders">
          <div class="col-md-4">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-success widget-padding-sm">
                    <div class="widget-big-int plugin-clock">$ {{number_format($ingreso,2)}}</div>                            
                    <div class="widget-subtitle plugin-date">Ingresos</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>

            <div class="col-md-4">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-info widget-padding-sm">
                    <div class="widget-big-int plugin-clock">$ {{number_format($egreso,2)}}</div>                            
                    <div class="widget-subtitle plugin-date">Egresos</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>

            <div class="col-md-4">
                
                <!-- START WIDGET CLOCK -->
                <div class="widget widget-danger widget-padding-sm">
                    <div class="widget-big-int plugin-clock">$ {{number_format($ingreso - $egreso,2)}}</div>                            
                    <div class="widget-subtitle plugin-date">Saldo</div>
                </div>                        
                <!-- END WIDGET CLOCK -->
                
            </div>
          </div>

         <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">


                   <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="text-center">Forma Pago</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Comprobante</th>
                                <th class="text-center">Ingresos</th>
                                <th class="text-center">Egresos</th>
                                <th class="text-center">Obs.</th>
                                <th class="text-center">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registros as $registro)
                                <tr style="background-color: @if($registro->egresos == 0) #a5ffaf @else #f9acac @endif">
                                    <td class="text-center">
                                       @switch($registro->payment_type_id )
                                            @case(1)
                                                <em>Contado Efectivo</em>
                                                @break
                                            @case(2)
                                                <em>Débito</em>
                                                @break
                                            @case(3)
                                                <em>Tarjeta 1 Pago</em>
                                                @break
                                             @case(4)
                                                <em>Tarjeta 3 a 12 Pagos</em>
                                                @break
                                             @case(5)
                                                <em>Cuenta Corriente</em>
                                                @break
                                            @default()
                                                <em><b></b></em>
                                                @break
                                        @endswitch    

                          

                                    </td>
                                    <td class="text-center">{!! $registro->description !!}</td>
                                    <td class="text-center">{!! $registro->comprobante_id !!}</td>
                                    <td class="text-center">{!! $registro->ingresos !!}</td>
                                    <td class="text-center">{!! $registro->egresos !!}</td>
                                    <td class="text-center">{!! $registro->observaciones !!}</td>
                                    <td class="text-center">{!! $registro->created_at !!}</td>
                        
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     <div class="pull-right">
                                            {{ $registros->onEachSide(1)->links() }}     
                                            </div>
                    </div>



                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

     <div class="form-group col-sm-12 col-xs-12">
        <div class="text-left col-md-6">
            <a href="{!! route('clientes.create-nota', ['id' => $id]) !!}" class="primary-btn">
                <i class="fa fa-plus"></i><span class="btn-text"> Nota crédito / débito</span>
            </a>
        </div>
        <div class="text-right col-md-6">
            <a href="{!! route('clientes.index') !!}" class="btn main-btn btn-anim">
                <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
            </a>
        </div>
    </div>

          </div>
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