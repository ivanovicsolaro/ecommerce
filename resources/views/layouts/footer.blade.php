
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

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">My Account</h3>
						<ul class="list-links">
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Compare</a></li>
							<li><a href="#">Checkout</a></li>
							<li><a href="#">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<li><a href="#">About Us</a></li>
							<li><a href="#">Shiping & Return</a></li>
							<li><a href="#">Shiping Guide</a></li>
							<li><a href="#">FAQ</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Stay Connected</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
						<form>
							<div class="form-group">
								<input class="input" placeholder="Enter Email Address">
							</div>
							<button class="primary-btn">Join Newslatter</button>
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
@if((session()->get('error')))
    	<script>
		$(document).ready(function(){
			swal({
	  		title: 'Error!',
	  		text: '{{session()->get('error')}}',
	  		type: 'error',
	 		 confirmButtonText: 'Cool'
	})
	});

	</script>
	 @endif

    <script type="text/javascript">

    	 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

    	 $(document).ready(function(){
       $('#div-menu-carrito').load('{{route("carrito.view")}}');
       $('#table-carrito').load('{{route("carrito.viewTable")}}');

  
   
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

