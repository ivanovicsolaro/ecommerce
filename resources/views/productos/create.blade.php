@extends('layouts.app') @section('contenido')

@section('title')
    Agregar Producto
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                     {!! Form::open(['route' => 'productos.store', 'id' => 'form-productos', 'files'=>'true', 'enctype' => 'multipart/form-data']) !!}

                        @include('productos.fields')

                    {!! Form::close() !!}
                </div>
                
                </div>

         
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script src="{{ asset('js/ajax-add.js') }}"></script>
    @parent
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 

         $(document).ready(function(){
           $("#cargar-imagen").attr('disabled','disabled');
           $("#cargar-imagen").attr('style','pointer-events: none');
        });

        var data_form = $("#form-productos");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_add(url,'POST',formData,'#add-producto') 
        });
    </script> 
    
@endsection 