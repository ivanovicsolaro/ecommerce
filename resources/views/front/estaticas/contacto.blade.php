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
                         <form accept-charset="UTF-8" action="" class="contact-form" method="post">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                                <label class="control-label mb-10 text-left">Nombre</label>
                                                <input type="text" class="form-control" name="name" required>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                  <label  class="control-label mb-10 text-left">Email</label>
                                                <input type="email" class="form-control" name="email" required>
                                              
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                                               <label class="control-label mb-10 text-left">Teléfono</label>
                                                <input type="text" class="form-control" name="phone" required>
                                               
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <label <label class="control-label mb-10 text-left">Mensaje</label>
                                                 <textarea rows="10" name="mensaje" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default btn-lg color-scheme-2 pull-right text-uppercase paira-margin-top-1 raleway-light">Enviar Mensaje</button>
                                    </form>
               
                    </div>
                    <div class="col-md-6">
                      
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="aside">
                            <h3 class="aside-title">Información de contacto</h3>
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12 margin-top-10">
                                    <p class="letter-spacing-2">Tte. Gimenez 3154<br>Paraná,<br>Entre Ríos</p>
                                </div>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <p class="letter-spacing-2">
                                        <i class="fa fa-envelope"></i> contacto@mayoristacelular.com <br>
                                        <i class="fa fa-phone"></i> 343 543 77 44 <br>
                                        <i class="fa fa-whatsapp"></i> 343 543 77 44
                                    </p>
                                </div>
                                
                            </div>
                            <h3 class="aside-title">Horarios y envíos</h3>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p class="letter-spacing-2"><i class="fa fa-clock-o" aria-hidden="true"></i> Horarios de Atención: <br/>Lunes a viernes de 8.30 a 12.30 hs. y de 17.00 a 20.00 hs.<br>Sábados de 9.00 a 12.30 hs.</p>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p class="letter-spacing-2"><i class="fa fa-truck" aria-hidden="true"></i> Envíos: <br/><b>Lunes a viernes de 8.30 a 12.30 hs.</b></p>
                                </div>
                        </div>
                    </div>

                        <div class="col-md-12 paira-margin-top-1">
                        <!--=================== Google MAP Section ===================-->
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13568.841881658158!2d-60.408293!3d-31.764745!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f5880c96002b0bc!2sIvais+Servicio+T%C3%A9cnico+Informatico+y+Celulares!5e0!3m2!1ses!2sar!4v1540233586213" height="450" frameborder="0" style="border:0;width:100%" class="mb20" allowfullscreen></iframe>
                    </div>
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
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>

@endsection


  @include('layouts.footer')