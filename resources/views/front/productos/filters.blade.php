    <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Shop by:</h3>

                        <ul class="filter-list">
                            <li><span class="text-uppercase">Precio:</span></li>
                            <li><a href="#">MIN: $20.00</a></li>
                            <li><a href="#">MAX: $120.00</a></li>
                        </ul>

                        <ul class="filter-list">
                            <li><span class="text-uppercase">Marca:</span></li>
                            <li><a href="#">Samsung</a></li>
                        </ul>

                        <button class="primary-btn">Clear All</button>
                    </div>
                    <!-- /aside widget -->

                    <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Filter by Price</h3>
                        <div id="price-slider"></div>
                    </div>
                    <!-- aside widget -->

                      <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Filtrar por Categoría</h3>
                        <ul class="list-links">
                        	@foreach($categorias as $categoria)
                            <li><a href="#">{{$categoria->descripcion}}</a></li>
                           @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->

                     <!-- aside widget -->
                    <div class="aside">
                        <h3 class="aside-title">Filtrar por Modelo</h3>
                        <ul class="list-links">
                        	@foreach($subcategorias as $subcategoria)
                            <li><a href="#">{{$subcategoria->descripcion}}</a></li>
                           @endforeach
                        </ul>
                    </div>
                    <!-- /aside widget -->

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