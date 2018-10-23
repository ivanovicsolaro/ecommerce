@include('layouts.header')
@include('layouts.menu') 




    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Envíos y Devoluciones</a></li>
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
                                 <h1 class="aside-title">Nuestra filosofía, es hacer de tu compra una experiencia 100% satisfactoria</h1>
                             <p style="font-size: 18px">
                                 Nuestra mayor prioridad sos vos, y es encerio.<br/>
                             </p>
                             <p style="font-size: 15px">
                                 Tenemos una filosofía que tiene como objetivo la satisfacción del cliente, por eso vas a notar que tanto el sitio web, como todo el sistema de envíos está destinado a tener un contacto directo con vos, y saber qué necesitás, porque realmente queremos que seas nuestro cliente.<br/><br/>

                                Nosotros nos encargamos de conseguir mejores precios, de que los productos te lleguen en tiempo y forma, de que te capacites, <i>proximamente incorporaremos un blog con cursos para que aprendas a reparar de manera correcta, con experiencias reales mías, y todas las "mañas" que debes aprender</i>, y bueno, esperamos llegar a cubrir tus espectativas y superarlas!.

                                 </p>
                      
                                </div>
                	    <div class="col-md-6">
                      
                    
                  <div class="aside">
                            <h1 class="aside-title">Como funciona el sistema de envío seguro?</h1>
                             <p style="font-size: 18px">
                                Nosotros confiamos en vos<br/>
                             </p>
                             <p style="font-size: 15px">
                                 Siempre sucede que cuando comprás algo por internet, tenés que abonar primero, y después te lo llevan, es decir, que el primer paso lo debe dar el cliente.<br/><br/>

                                 El sistema de envío seguro está pensado para que abones contra-reembolso, es decír, cuando la mercadería te llega. Esto te va a permitir asegurarte de que todo te llega bien, y que en el caso de que algo no sea correcto, lo devuelvas o no lo abones.<br/><br/>
                             </p>
                             <p style="font-size: 20px">
                                <blockquote>Queremos que seas nuestro cliente, no dudes en contactarnos!</blockquote>

                                 </p>
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

