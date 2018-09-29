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
                            @foreach($categorias as $categoria)
                            <li>
                                {!! Form::radio('categoria', $categoria->id)!!}


                                {{strtoupper($categoria->descripcion)}}</li>
                           @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->

                     <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Seleccione Categoría</h3>
                        <ul class="list-links">
                            @foreach($subcategorias as $subcategoria)
                            <li>
                                {!! Form::radio('marca', $subcategoria->id)!!}
                                

                                {{strtoupper($subcategoria->descripcion)}}</li>
                           @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->


                    <button class="primary-btn add-to-cart" type="submit"><i class="fa fa-search"></i> Buscar</button>

                    {!! Form::close()!!}

                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top Rated Product</h3>
                        <!-- widget product -->
                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="./img/thumb-product01.jpg" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <h3 class="product-price">$32.50 <del class="product-old-price">$45.00</del></h3>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /widget product -->

                        <!-- widget product -->
                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="./img/thumb-product01.jpg" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <h3 class="product-price">$32.50</h3>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o empty"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /widget product -->
                    </div>
                    <!-- /aside widget -->
                </div>
                <!-- /ASIDE -->