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
                        <h5> <strong class="text-uppercase">Pedidos Recientes</strong></div><div class="col-md-2"> <a class="text-rigth" style="text-decoration: underline;" href="">Ver Todos</a> </h5>
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
                               
                                <tr>
                                    <td>0001</td>
                                    <td><span class="nobr">13/10/2018</span></td>
                                    <td><span class="price">109.90</span></td>
                                    <td>Entregado</td>
                                    <td class="a-center last"><span class="nobr"> <a href="">Ver Pedido</a></span>
                                    </td>
                                </tr>
                              
                            </tbody>
  </table>
</div>
                </div>
                
                <div class="col-lg-3 col-md-3 col-xs-12 mt20 block">
                    <div class="block-title"> Mi cuenta </div>
                    <div class="block-content">
                        <ul>
                            <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Mi Cuenta</a></li>
                            <li><a href="{{route('perfil')}}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Mi Perfil</a></li>
                            <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Pedidos</a></li>
                            <li><a href=""><i class="fa fa-angle-double-right" aria-hidden="true"></i> Cambiar Contraseña</a></li>
                            <li><a href="www.google.com"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


@endsection
