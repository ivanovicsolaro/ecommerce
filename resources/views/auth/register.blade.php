@extends('layouts.app')

@section('contenido')
   <!-- HOME -->
   <div id="home">
        <!-- container -->
        <div class="container">
        
                    <div class="container" style="padding: 5% 0% 2% 0%">
                        <div class="row justify-content-center" style="text-align:center; margin:0 auto;">
                            <div class="col-md-12">
                            <strong class="text-uppercase"><h3>{{ __('Registro de Cliente   ') }}</h3></strong>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                            @csrf

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 text-right">{{ __('Nombre') }}</label>

                                                <div class="col-md-4">
                                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="lastname" class="col-md-4 text-right">{{ __('Apellido') }}</label>

                                                <div class="col-md-4">
                                                    <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                                    @if ($errors->has('lastname'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('lastname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="phone" class="col-md-4 text-right">{{ __('Teléfono') }}</label>

                                                <div class="col-md-4">
                                                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                                    @if ($errors->has('phone'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="email" class="col-md-4 text-right">{{ __('E-Mail') }}</label>

                                                <div class="col-md-4">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 text-right">{{ __('Contraseña') }}</label>

                                                <div class="col-md-4">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password-confirm" class="col-md-4 text-right">{{ __('Confirmar Contraseña') }}</label>

                                                <div class="col-md-4">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8">
                                                    <button type="submit" class="primary-btn" style="float: right">
                                                        {{ __('Registrar') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
@endsection
