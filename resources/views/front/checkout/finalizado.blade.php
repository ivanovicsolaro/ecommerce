@include('layouts.header')
@include('layouts.menu') 


<main class="about-page">
        <!--=================== About Content Section ===================-->
        <section class="about-content paira-padding-bottom-1">
            <div class="container">
                <div class="row mt50">
                    <div class="col-sm-12">
                        @if($rta == 'ok')
                        <div class="row text-center">
                            <img src="{{ asset('/img/check.png') }}" style="width:150px;">
                        </div>
                        <div class="row text-center">
                            <h1 class="mt20 mb20">¡Muchas Gracias por tu Compra!</h1>
                            <h4>La transacción se ha realizado con éxito.</h4>
                            <p class="cNegro">
                                # Pedido: <a href="{{url('home')}}">{{ $nroPedido }}</a>
                            </p>
                        </div>
                        @else
                        <div class="row text-center">
                            <img src="{{ asset('/images/icons/cross-icon.png') }}" style="width:150px;">
                        </div>
                        <div class="row text-center">
                            <h1 class="mt20 mb20">¡Ups!, hubo un problema con su pago.</h1>
                            <h4>Su pagó no pudo ser procesado correctamente. Por favor comuniquese con nosotros para solucionar su problema.</h4>
                        </div>
                        @endif
                        <div class="row text-center mb30">
                            <a href="{{ url('/') }}" class="btn btn-default btn-lg color-scheme-2 text-uppercase raleway-light margin-left-25 logi mt20">Ir al Inicio</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>






@section('js')
    @parent

@endsection


  @include('layouts.footer')