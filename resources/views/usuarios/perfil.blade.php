@extends('layouts.app') @section('contenido')


     
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="title-section">Mi Perfil</p>
            </div>
        </div>
    </div>
    
    @if (session('guardado'))
    <div class="container">
        <div class="row notificacion">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible show" role="alert">
                  {{ session('guardado') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!--=================== About Content Section ===================-->
    <section class="account paira-padding-bottom-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-xs-12 mt20">
                    <div class="dashboard">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                <h5> <strong class="text-uppercase">Información de Contacto</strong> </h5>

                                </div>
                                <form action="" method="post" role="form">
                                    {{ csrf_field() }}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <div class="input-box">
                                                <input type="text" name="name" id="name" value="{{ $customer->firstname }}" class="form-control" title="Nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="last_name">Apellido</label>
                                            <div class="input-box">
                                                <input type="text" name="lastname" value="{{ $customer->lastname }}" id="lastname" class="form-control" title="Apellido">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="phone">Teléfono</label>
                                            <div class="input-box">
                                                <input type="text" name="phone" value="{{ $customer->phone }}" id="phone" class="form-control" title="Teléfono">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <div class="input-box">
                                                <input type="email" name="email" value="{{ $customer->email }}" id="email" class="form-control" title="Email" disabled>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                <h5> <strong class="text-uppercase">Dirección de Envío</strong> </h5>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <div class="input-box">
                                            <input type="text" name="localidad" value="@if(isset($address->city)){{$address->city}} @endif" id="localidad" class="form-control" title="Ciudad">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="cp">Código Postal</label>
                                        <div class="input-box">
                                            <input type="text" name="codigo_postal" value="@if(isset($address->postalcode)) {{$address->postalcode}}@endif" id="codigo_postal" class="form-control" title="Código Postal">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="calle">Calle</label>
                                        <div class="input-box">
                                            <input type="text" name="calle" value="@if(isset($address->address)){{$address->address}} @endif" id="calle" class="form-control" title="Calle">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="numero">Nro.</label>
                                        <div class="input-box">
                                            <input type="text" name="numero" value="@if(isset($address->number)){{$address->number}} @endif" id="numero" class="form-control" title="Número">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="piso">Piso</label>
                                        <div class="input-box">
                                            <input type="text" name="piso" value="@if(isset($address->piso)){{$address->piso}} @endif" id="piso" class="form-control" title="Piso">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="depto">Depto.</label>
                                        <div class="input-box">
                                            <input type="text" name="depto" value="@if(isset($address->depto)){{$address->depto}} @endif" id="depto" class="form-control" title="Departamento">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="buttons-set">
                                        <button type="submit" class="primary-btn" style="float: right" title="Guardar Perfil" name="send" id="send2"><span>Guardar Perfil</span></button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-xs-12 mt20 block">
                    <div class="block-title"> Mi cuenta </div>
                    <div class="block-content">
                        <ul>
                            <li><a href="{{route('home')}}"><span> Mi Cuenta</span></a></li>
                            <li><a href=""><span> Mi Perfil</span></a></li>
                            <li><a href=""><span> Pedidos</span></a></li>
                            <li><a href=""><span> Cambiar Contraseña</span></a></li>
                            <li><a href=""><span> Salir</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
