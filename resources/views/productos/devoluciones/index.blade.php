@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Devoluciones
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
         <div class="col-md-12">
            <div class="header-btns-icon text-right">
                <a class="primary-btn" href="{{route('productos.create-devolucion')}}"> <i class="fa fa-plus"></i> Agregar Devolucion</a>
                              
            </div>
         </div>
        <div class="col-md-12">

         <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('productos.devoluciones.table')
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>                                
</div>


<!-- PAGE CONTENT WRAPPER --> 


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Listado de Productos devolución nro. <span id="idDevolucion"></span></h4>
      </div>
      <div class="modal-body">
      	<div class="row">   
       		<table class="table datatable" id="tabla-productos-devoluciones">
       			<thead>
			        <tr>
			            <th class="text-center">Nro. Producto</th>
			            <th class="text-center">Nombre</th>
			            <th class="text-center">Cantidad</th>
			        </tr>
			    </thead>
			    <tbody>
			    	
			    </tbody>

       		</table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
       
    </div>
  </div>
</div>

@endsection

@section('js')
    @parent
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

         function showModalProductos(id) {
            $.get( "{{route('productos.get-productos-devolucion')}}", { id: id })
            .done(function(data){
            	var contenido = '';
            	table = $('#tabla-productos-devoluciones tbody');
            	table.empty();

            	$.each(data.productos, function(i, item) {			 		
            		contenido = '<tr><td class="text-center">'+item['product_id']+'</td><td class="text-center">'+item['name']+'</td><td class="text-center">'+item['quantity']+'</td></tr>';
            		table.append(contenido);
            		$('#idDevolucion').html(item['devolucion_id']);            		
				})

				

				

         
             });

              $('#myModal').modal('show');

           
        }

     

    </script>


@endsection