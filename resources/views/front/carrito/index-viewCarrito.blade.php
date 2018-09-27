@include('layouts.header')
@include('layouts.menu') 

	
	  <div id="home">
        <!-- container -->
        <div class="container">


	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Carrito</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->



					<div class="col-md-12">
						<div class="order-summary clearfix">
							<div class="section-title">
								<h3 class="title">Revisión del Pedido</h3>
							</div>
								<div id="table-carrito"></div>
							<div class="pull-right">
								<button class="primary-btn">Realizar Pedido</button>
							</div>
						</div>

					</div>
				</form>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	    </div>
</div>
  







@section('js')
    @parent

@endsection


  @include('layouts.footer')