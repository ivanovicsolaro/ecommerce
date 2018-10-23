@include('layouts.header')
@include('layouts.menu') 




    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!--  Product Details -->
                   <div class="product product-details clearfix">
                                <div class="col-md-6">
                                 <h2 class="aside-title">Qué debés saber sobre tu compra?</h2>
                                <br/>
                                   <p style="font-size: 18px">
                                 En 2 simples pasos simples, tenés tu pedido en tu domicilio.<br/><br/>
                                 </p>

                             <p style="font-size: 15px">
                                 Comprar en nuestra web es realmente sencillo, incluso podrás ver que no es como otros sitios en donde el registro es tedioso, hay poca información y comprar lleva mucho tiempo. Eso es <a href="{{url('/envios-devoluciones')}}"><u>porque nuestra filosofía está apuntada a la satisfacción tuya.</u>.</a><br/><br/>
                                 A continuación te enumeraré los pasos para realizar la compra, y te informaré como es todo el circuito, y verás que es realmente fácil:
<br/><br/></p>
                               <ul>
                                    <li> <p style="font-size: 15px">1 - Te registras (puedes hacerlo haciendo click <a href="{{route('login')}}">aquí</a>)</p></li>
                                    <li> <p style="font-size: 15px">2 - Elegís <a href="{{url('/shop')}}"><u>tus productos</u></a>, completás <a href="{{url('/carrito')}}"><u>tu carrito</u></a> y vas al <a href="{{url('/checkout')}}"><u>checkout</u></a>.</p></li>
                                    <li> <p style="font-size: 15px">3 - Completas tus datos, si quieres envío (área metropolitana o regional) o lo retiras de nuestro domicilio, y la forma de pago. Y listo!</p></li>
                                                                   </ul>
                           
                          </p>
                                </div>
                        <div class="col-md-6">
                      
                    
                  <div class="aside">
                            <h1 class="aside-title">ESTO ES IMPORTANTE!</h1>
                              <p>Te lo pongo en rojo, porque realmente es importante:</p>
                              <blockquote>
                                <p style="color:red; font-weight: bold;">Los pedidos se computan hasta las 19:00 hs. de lunes a viernes.</p>Por ejemplo, <b><u>si comprás un lunes a las 10:00, o a las 18:59 hs. es lo mismo, te llega el martes entre las 8:30 y las 12:00</u></b>.<br/><br/>
                                <p style="color:red; font-weight: bold;">Los envíos de área metropolitana (Paraná, Oro Verde, San Benito y Colonia Avellaneda) salen de mañana el siguiente día hábil.</p>Es decir, que  <b><u> si comprás un lunes antes de las 19:00, te llega el martes entre las 8:30 y las 12:00</u></b>.<br/><br/>
                                 <p style="color:red; font-weight: bold;">Los envíos regionales (Entre Ríos y el resto del país) salén por OCA.</p>Entoces, <b><u>si comprás, te vamos a llamar y nos contactaremos para enviarte en nro. de seguimiento para que te quedes tranquilo</u></b>.<br/><br/>    
                                 </blockquote>      
                         </div></div>

                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->











@section('js')
    @parent


@endsection


  @include('layouts.footer')

