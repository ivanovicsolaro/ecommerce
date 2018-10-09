<table class="shopping-cart-table table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th></th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(Cart::model()->items->all() as $item)
                                    <tr>
                                        <td class="thumb">
                                         @if(!isset($item->product->imagen))
                                          <img  src="{{asset('img/products/sin-imagen.jpg')}}" alt="">
                                         @else
                                         <img src="{{asset($item->product->imagen)}}" alt="">
                                          @endif
                                        </td>
                                        <td class="details">
                                            <a href="{{asset('producto/'.$item->product->slug)}}">{{$item->product->name}}</a>
                                            <ul>
                                                <li><span>Código: {{$item->product->sku}}</span></li>
                                            </ul>
                                        </td>
                                        <td class="qty text-center"><strong><input class="input" type="text" id="precio{{$item->product->id}}" value="{{number_format($item->price_real,2)}}"></strong></td>

                                        <td class="qty text-center"><input class="input" type="text" id="cantidad{{$item->product->id}}" value="{{$item->quantity}}" readonly="true"></td>

                                        <td class="total text-center"><input class="input" type="text" id="precio{{$item->product->id}}" value="{{number_format($item->quantity * $item->price_real,2)}}" readonly="true"></td>

                                        <td class="text-right"><button class="main-btn icon-btn" onclick="removeCartVenta({{$item->product->id}}, -1)"><i class="fa fa-close"></i></button></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>SUBTOTAL</th>
                                        <th colspan="2" class="sub-total">{{number_format($total_real,2)}}</th>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>Envío</th>
                                        <td colspan="2">Tarifa Reducida ($70.00)</td>
                                    </tr>
                                    <tr>
                                        <th class="empty" colspan="3"></th>
                                        <th>TOTAL</th>
                                        <th colspan="2" class="total">{{number_format($total_real + 70,2) }}</th>
                                    </tr>
                                </tfoot>
                            </table>







