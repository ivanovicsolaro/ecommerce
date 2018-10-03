@extends('layouts.app') @section('contenido')


   
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="title-section">Mi Cuenta</p>
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
                        <h5> <strong class="text-uppercase">Pedidos Recientes</strong></div><div class="col-md-2"> <a class="text-rigth" style="text-decoration: underline;" href="{{route('pedidos')}}">Ver Todos</a> </h5>
                    </div>

                    

                    
<div class="table-responsive-md">
  <table class="table">
  <thead>
                                <tr>
                                    <th>Pedido # </th>
                                    <th>Fecha</th>
                                    <th><span class="nobr">Importe Total</span></th>
                                    <th>Estado</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($orders as $o)
                                <tr class="even">
                                    <td>{{ $o->number }}</td>
                                    <td><span class="nobr"></span>{{ $o->updated_at->format('d-m-Y') }}</td>
                                    <td><span class="price">${{ $o->total() }}</span></td>
                                    <td>
                                        @switch($o->status)
                                            @case('Pending')
                                                <em>Pendiente</em>
                                                @break
                                            @case('Completed')
                                                <em>Completada</em>
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
                </div>
                
             @include('layouts.menu-perfil')
            </div>
        </div>


@endsection
