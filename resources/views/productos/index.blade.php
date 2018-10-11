@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Productos
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
         <div class="col-md-12">
            <div class="header-btns-icon text-right">
                <a class="primary-btn" href="{{route('productos.create')}}"> <i class="fa fa-plus"></i> Agregar Producto</a>
                              
            </div>
         </div>
        <div class="col-md-12">

         <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('productos.table')
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->
        </div>
    </div>                                
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPRESION DE CODIGO DE BARRAS</h4>
      </div>
       <form action="{{route('productos.tikets')}}">
      <div class="modal-body">
      <div class="row">
        <div class="form-group col-sm-6">
        
            <label class="control-label mb-10">Ingrese la cantidad a imprimir </label>

           <input type="number" class='form-control text-left' name="cantidad" placeholder="Ingrese la cantidad de etiquetas">
            <input type="hidden" name="idProducto" id="idProducto">
       
        </div>
        
      
       
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="primary-btn">Imprimir etiquetas</button>
      </div>
       </form>
    </div>
  </div>
</div>


<!-- PAGE CONTENT WRAPPER --> 
@endsection

@section('js')
    @parent
    <script src="{{ asset('back/js/toast-function.js') }}"></script>
    <script src="{{ asset('back/js/ajax_delete.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

        function eliminar(hash,identificador){

            var box = $("#mb-remove-row");
            box.addClass("open");
            
            box.find(".mb-control-yes").on("click",function(){
                box.removeClass("open");
                var url = "{{ route('productos.destroy',1) }}";
                
                ajax_delete(url,'POST',{id:hash},"#btn_"+identificador)
                $("#trow_"+identificador).hide("slow",function(){
                    $(this).remove();
                });
            });
            
        }

        function showModalTikets(id) {
            $('#idProducto').val(id);
            $('#myModal').modal('show');
        }

    </script>


@endsection