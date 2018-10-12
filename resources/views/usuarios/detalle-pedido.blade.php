@extends('layouts.app') @section('contenido')


   
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="title-section">Ver detalle del pedido</p>
            </div>
        </div>
    </div>

  
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-12 mt20">
                   
                    <p>
                        Desde aquí podrás hacer el seguimiento de todos sus pedidos, cambiar la información personal o dirección de envío.
                    </p><br/>
                    <div class="col-md-10">
                        <div class="col-sm-6 list-links">
                                    <p><strong>Nro. Pedido: </strong>{{ $order->number }}</p>
                                    <p><strong>Fecha: </strong>{{ $order->updated_at->format('d-m-Y') }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><strong>Importe total: </strong>${{ number_format($order->total(), 2, '.', '') }}</p>
                                    <p><strong>Estado: </strong>
                                        @switch($order->status)
                                            @case('Pending')
                                                <em style="color: orange"><b>Pendiente</b></em>
                                                @break
                                            @case('Cancelled')
                                                <em style="color: red"><b>Cancelado</b></em>
                                                @break
                                            @case('Completed')
                                                <em style="color: green"><b>Completada</b></em>
                                                @break
                                        @endswitch    
                                    </p>
                                </div>
                    </div>

                    
   
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
					  </table>
					</div>
                </div>
                
            	@include('layouts.menu-perfil')
            </div>
        </div>


@endsection
