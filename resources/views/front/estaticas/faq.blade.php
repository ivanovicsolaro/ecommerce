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
                      
                    
                  <div class="aside">
                            <h1 class="aside-title">QUIENES SOMOS</h1>
                             <p style="font-size: 18px">
                                 MayoristaCelular.com nace en el año 2017 como una de las primeras tiendas on-line de accesorios y repuestos para celulares. 
                             </p>
                             <p class="paira-margin-top-1 letter-spacing-2 margin-bottom-0">
                                 Desde sus comienzos, mayoristacelular se diferenció tanto por la variedad y exclusividad de sus productos, como por su búsqueda constante de ofrecer el mejor servicio para cada uno de sus clientes. Con más de 5 años de trayectoria, hoy se ha convertido en líder del segmento, haciendo posible que personas de toda la región puedan acceder a la más alta calidad de productos de la manera más fácil y segura del mercado. Su portfolio cuenta con la mayor variedad de productos, y si no lo tenemos, te lo conseguimos!.
                             </p>
                         </div></div>
                               <div class="col-md-6">
                      
                    <div class="col-md-12 col-xs-12 col-sm-12">
                             
                             <iframe style="width:100%;height:400px;margin-top:30px" src="{{asset('videos/1.mp4')}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

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

