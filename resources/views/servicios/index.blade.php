@extends('layouts.app') @section('contenido')

@section('title')
    Listado de Servicios
@stop

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                

    <div class="row">
         <div class="col-md-12">
            <div class="header-btns-icon text-right">
                <a class="primary-btn" href="{{route('servicios.create')}}"> <i class="fa fa-plus"></i> Agregar Servicio</a>
                              
            </div>
         </div>
        <div class="col-md-12">

         <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('servicios.table')
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


@endsection