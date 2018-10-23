
	<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <img src="{{asset('img/logo.png')}}" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p>Contactanos para unirte a la red de revendedores de accesorios de celular y repuestos, no pierda la oportunidad de hacer crecer tu negocio!</p>

					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Mi Cuenta</h3>
						<ul class="list-links">
							<li><a href="{{route('home')}}">Mi cuenta</a></li>
							<li><a href="{{route('pedidos')}}">Mis pedidos</a></li>
							<li><a href="{{route('perfil')}}">Mi perfil</a></li>
							<li><a href="{{url('/checkout')}}">Finalizara compra</a></li>
							<li><a href="{{route('login')}}">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Seguridad de compra</h3>
						<ul class="list-links">
								<li><a href="{{url('/contacto')}}">Contacto</a></li>
								<li><a href="{{url('/sobre-nosotros')}}">Sobre Nosotros</a></li>
								<li><a href="{{url('/envios-devoluciones')}}">Envíos y devoluciones</a></li>
								<li><a href="{{url('/guia-envios')}}">Guía de envíos</a></li>
								<li><a href="{{url('/faq')}}">Preguntas Frecuentes</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Consultas</h3>
						<p>Puedes encargarnos repuestos, productos, hacernos consultas técnicas, etc. Estemos en contacto!.</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Ingresa tu email">
							</div>
							<button class="primary-btn">Quiero las novedades</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/slick.min.js')}}"></script>
	<script src="{{asset('js/nouislider.min.js')}}"></script>
	<script src="{{asset('js/loader.js')}}"></script>
	<script src="{{asset('js/jquery.zoom.min.js')}}"></script>
	<script src="{{asset('js/main.js')}}"></script>
	@section('js')  
    @show      
	

    <script type="text/javascript">

    	 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

    	$(document).ready(function(){
       		$('#div-menu-carrito').load('{{route("carrito.view")}}');
       		$('#table-carrito').load('{{route("carrito.viewTable")}}');

       		@if(session('error'))
       		swal({
						  type: 'error',
						  title: 'Oops...  :(',
						  text: '{{session("error")}}'
						});
       		@endif
		});

    	
    	function addCart(id, cantidad){
    		$boton = '#btn-addcart-'+id;
            $.ajax({
		        url: "{{route('carrito.addItem')}}",
		        type:'post',
		        data:{id:id, cantidad:cantidad},
		         beforeSend: function() {
		         	$($boton).buttonLoader('start');
		         },
		        success: function(data) {
		          if(data['validate'] == 1){
		          	 $('#div-menu-carrito').load('{{route("carrito.view")}}');
		          	 $('#table-carrito').load('{{route("carrito.viewTable")}}');
		          	 $("#header-precio-total").html("$ "+ data['total']);
		          	 $("#header-cantidad-items").html(data['cantidad']);
		      
		              swal({
		                  title: 'Producto Agregado!',
		                  html: '<strong>'+data['nombre']+'</strong> agregado al carrito!',
		                  imageUrl: data['urlImagen'],
		                  imageWidth: 200,
		                  imageHeight: 200,
		                  animation: true,
		                  customClass: 'animated tada',
		                   confirmButtonText: 'Continuar',
		                });

		              $($boton).buttonLoader('stop');
		               	     
		          }else{
		              swal({
						  type: 'error',
						  title: 'Oops...  :(',
						  text: data['msg']
						});
		              $($boton).buttonLoader('stop');
		          }
		        },
		        error: function (data) {
		          
		        }
		    });
           
    	}

    	 function removeCart(id, cantidad)
        {
            $.ajax({
             	url: "{{route('carrito.removeItem')}}",
		        type:'post',
		        data:{id:id, cantidad:cantidad},
                success: function(data) {
                 	$('#div-menu-carrito').load('{{route("carrito.view")}}');
                    $('#table-carrito').load('{{route("carrito.viewTable")}}');
		          	$("#header-precio-total").html("$ "+ data['total']);
		          	$("#header-cantidad-items").html(data['cantidad']);
                },
                error: function (data) {
                   $('#div-menu-carrito').load('{{route("carrito.view")}}');
                }
            });
        }

        function getCantidad(){
        	return $('#cantidad').val();
        }

         function getCantidadById(id){
        	return $('#cantidad'+id).val();
        }

        function updateCart(id)
        {
        	var cantidad = $('#cantidad'+id).val();
            $.ajax({
             	url: "{{route('carrito.update')}}",
		        type:'post',
		        data:{id:id, cantidad:cantidad},
                success: function(data) {
                	  if(data['validate'] == 1){
                	  	$('#div-menu-carrito').load('{{route("carrito.view")}}');
	                    $('#table-carrito').load('{{route("carrito.viewTable")}}');
			          	$("#header-precio-total").html("$ "+ data['total']);
			          	$("#header-cantidad-items").html(data['cantidad']);
                	  }else{
                	  	  $('#cantidad'+id).val(data['cantidad']);
                	  	  swal({
						  type: 'error',
						  title: 'Oops...  :(',
						  text: data['msg']
						})
                	  }
                 
		      
                },
                error: function (data) {
                   $('#div-menu-carrito').load('{{route("carrito.view")}}');
                }
            });
        }

 			function checkEnvio(id){
         	switch(id){
         		case 1:
         		$("#labelEnvio").html('Retiro del Local (sin costo)');
         		num = {{Cart::total()}};
         		$("#labelTotal").html(num.toFixed(2));
   	      		break;
         		case 2:
         		$("#labelEnvio").html('Área Metropolitana - $70.00');
         		num = {{Cart::total() + 70}};
         		$("#labelTotal").html(num.toFixed(2));
         		break;
         		case 3:
         		$("#labelEnvio").html('Envio Regional - $200.00');
         		num = {{Cart::total() + 200}};
         		$("#labelTotal").html(num.toFixed(2));
         		break;
         	}
        }





    </script>

</body>

</html>

