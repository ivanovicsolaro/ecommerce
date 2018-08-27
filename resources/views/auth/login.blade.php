@extends('layouts.app')
@section('contenido')

    <!-- HOME -->
    <div id="home">
        <!-- container -->
        <div class="container">
           
           
                    
                    <div class="container" style="width:100%; padding: 10% 0% 10% 0%">
                        <div class="row" style="text-align:center; margin:0 auto;">
                            <div class="col-md-12">
                        
                                <strong class="text-uppercase"><h3>{{ __('Ingreso de Clientes') }}</h3></strong>
                                   
                    
                                    <div class="row ">
                                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                            @csrf
                    
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-4 text-right">{{ __('E-Mail') }}</label>
                    
                                                <div class="col-md-4">
                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                    
                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 text-right">{{ __('Password') }}</label>
                    
                                                <div class="col-md-4">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <div class="col-md-8">
                                                <a style="float: right" class="btn btn-link" href="{{ route('password.request') }}">
                                                        {{ __('Olvidé mi contraseña?') }}
                                                    </a>
                                                    <button type="submit" class="primary-btn" style="float: right">
                                                        {{ __('Login') }}
                                                    </button>
                    
                                                   
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                
                            </div>
                        </div>
                    </div>








  
        </div>
        <!-- /container -->
    </div>
    <!-- /HOME -->

@endsection
