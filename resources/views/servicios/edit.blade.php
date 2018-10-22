@extends('layouts.app') @section('contenido')

@
@section('title')
    Editar servicio
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                 
                    {!! Form::open(['route'=> ['servicios.update',Crypt::encrypt($servicio->id)], 'method' => 'PUT', 'id' => 'form-servicios']) !!}
                    @include('servicios.fields')
                    {!! Form::close() !!}
                </div>
                <div class="text-right col-md-12">
                 
                </div>
                </div>

         
            </div>
        </div>
    </section>


@endsection

@section('js')
    @parent
<script src="{{asset('libs/dropzone/dist/dropzone.js')}}"></script>
    <script src="{{ asset('js/ajax-edit.js') }}"></script>
<script>
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
            ajax_edit(url,'POST',formData,'#add-producto') 
        });
</script>

  
@endsection 