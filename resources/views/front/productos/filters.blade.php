    <!-- ASIDE -->                 

                <div id="aside" class="col-md-3">
                    {!! Form::model(Request::all(), ['route' => 'shop.index', 'method' => 'GET']) !!}
                    <div class="aside">
                        <h3 class="aside-title">Ingrese búsqueda</h3>
                        <div class="qty-input">
                        {!! Form::text('busqueda', null, ['class' => 'input', 'placeholder' => 'Ejemplo: J1 Ace, J110, etc.'])!!}
                        </div>
                    </div>

                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Seleccione Categoría</h3>
                        <ul class="list-links">
                            <?php $i = 0 ?>
                            @foreach($categorias as $categoria)
                            @if($i == 4) <div id="complete" style="display:none">@endif
                            <li>
                                {!! Form::checkbox('categoria[]', $categoria->id)!!}
                                {{strtoupper($categoria->descripcion)}}
                            </li>
                            <?php $i++ ?>
                           @endforeach
                           <? $i = 0; ?>
                            </div>

                    <li>
                   <a class="more-cat-show"><b>Más opciones <i class="fa fa-plus-square" aria-hidden="true"></i></b></a>
                   <a class="more-cat-hide" style="display:none"><b>Menos opciones <i class="fa fa-minus-square" aria-hidden="true"></i></b></a>
                    </li>
                   </ul>
                    </div>
                    <script>

                        $('.more-cat-show').click(function(){
                            $("#complete").show();
                             $('.more-cat-hide').css("display", "block");
                             $('.more-cat-show').css("display", "none");
                        });

                         $('.more-cat-hide').click(function(){
                            $("#complete").hide();
                            $('.more-cat-hide').css("display", "none");
                             $('.more-cat-show').css("display", "block");
                        });

                    </script>          



                      
                    <!-- /aside widget -->

                     <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Seleccione Marca</h3>
                        <ul class="list-links">
                             <?php $i = 0 ?>
                            @foreach($subcategorias as $subcategoria)
                             @if($i == 4) <div id="complete-subcat" style="display:none">@endif
                            <li>
                                {!! Form::checkbox('marca[]', $subcategoria->id)!!}
                                {{strtoupper($subcategoria->descripcion)}}
                            </li>
                             <?php $i++ ?>
                           @endforeach
                            <? $i = 0; ?>
                        </div>
                          <li>
                   <a class="more-subcat-show"><b>Más opciones <i class="fa fa-plus-square" aria-hidden="true"></i></b></a>
                   <a class="more-subcat-hide" style="display:none"><b>Menos opciones <i class="fa fa-minus-square" aria-hidden="true"></i></b></a>
                    </li>
                        </ul>
                    </div>
                    <!-- /aside widget -->
                    <script>

                        $('.more-subcat-show').click(function(){
                            $("#complete-subcat").show();
                             $('.more-subcat-hide').css("display", "block");
                             $('.more-subcat-show').css("display", "none");
                        });

                         $('.more-subcat-hide').click(function(){
                            $("#complete-subcat").hide();
                            $('.more-subcat-hide').css("display", "none");
                             $('.more-subcat-show').css("display", "block");
                        });

                    </script>



                    <button class="primary-btn add-to-cart" type="submit"><i class="fa fa-search"></i> Buscar</button>
                    <a  class="main-btn quick-view" href="{{url('/shop')}}">Limpiar Filtros</a>

                    {!! Form::close()!!}



<br/>
                      <!-- Product Slick -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                       <div class="aside">
                        <h3 class="aside-title">Mas vendidos</h3>
                    <div class="row">
                        <div id="product-slick-filters" class="product-slick">
                            <?php $i = 0;?>
                               @foreach($ranking as $r)
                            <!-- Product Single -->
                               <div class="product product-single">
                                    <div class="product-thumb">
                                       <div class="product-label">
                               
                                            <span>
                                              Oferta
                                                  
                                            </span>
                           
                                            <span class="sale">- {{number_format(100 - (($r->price * 100)/$r->price_real),0)}} %</span>
                                       </div>                                       
                                        <a href="{{asset('producto/'.$ranking[$i]->slug)}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Ver Detalle</a>
                                         @if(!isset($r->image))
                                          <img  src="{{asset('img/products/sin-imagen.jpg')}}" alt="">
                                         @else
                                          <img  src="{{asset('img/products/'.$r->path_image.'/'.$r->image)}}" alt="">
                                          @endif
                                       
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">{{number_format($r->price,2)}} <del class="product-old-price">{{number_format($r->price_real,2)}}</del></h3>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o empty"></i>
                                        </div>
                                        <h2 class="product-name"><a href="#">{{$r->name}}</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                            <button class="primary-btn add-to-cart" id="btn-addcart-{{$r->id}}" onclick="addCart({{$r->id}}, 1)" ><i class="fa fa-shopping-cart" ></i> Agregar al carrito</button>
                                        </div>
                                    </div>
                                </div>
                            <!-- /Product Single -->
                            <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                    </div>
                </div>
                <!-- /Product Slick -->

        
                </div>
                <!-- /ASIDE -->