@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Productos
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
         <div class="col-md-12">
            <div class="header-btns-icon">
                               <a>     <i class="fa fa-user-o"></i> Nuevo Producto</a>
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
    </script> 
    <script type="text/javascript">
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
    </script>
@endsection