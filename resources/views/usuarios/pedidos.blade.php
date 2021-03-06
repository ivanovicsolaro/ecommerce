@extends('layouts.app') @section('contenido')


   
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="title-section">Historial de pedidos</p>
            </div>
        </div>
    </div>

  
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-12 mt20">
                    <h4 class="lt0 mb15">Hola {{ Auth::user()->name }}!</h4>
                    <p>
                        Desde aquí podrás hacer el seguimiento de todos sus pedidos, cambiar la información personal o dirección de envío.
                    </p><br/>
                    <div class="col-md-10">
                        <h5> <strong class="text-uppercase">Pedidos Recientes</strong></div><div class="col-md-2"> <a class="text-rigth" style="text-decoration: underline;" href="">Ver Todos</a> </h5>
                    </div>

                    

                    
						<div class="table-responsive-md">
						  <table class="table">
						  <thead>
                                <tr class="first last">
                                    <th>Pedido # </th>
                                    <th>Fecha</th>
                                    <th>Importe</th>
                                    <th>Envío</th>
                                    <th><span class="nobr">Total</span></th>
                                    <th>Estado</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $o)
                                <tr class="even">
                                    <td>{{ $o->number }}</td>
                                    <td><span class="nobr"></span>{{ $o->updated_at->format('d-m-Y') }}</td>
                                    <td><span class="price">${{ number_format($o->total_amount,2) }}</span></td>
                                     <td><span class="price">${{ number_format($o->costo_envio,2) }}</span></td>
                                    <td><span class="price">${{ number_format($o->total_amount + $o->costo_envio,2) }}</span></td>
                                    <td>
                                      @switch($o->status)
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
                                    </td>
                                    <td class="a-center last"><span class="nobr"> <a href="pedido/{{ $o->number }}">Ver Pedido</a></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
					  </table>
					</div>
					 {{ $orders->links() }}
                </div>
                
             @include('layouts.menu-perfil')
            </div>
        </div>


@endsection
