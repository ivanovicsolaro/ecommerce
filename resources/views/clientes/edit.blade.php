@extends('layouts.app') @section('contenido')

@section('css')
    <link rel="stylesheet" href="{{asset('libs/dropzone/dist/dropzone.css')}}">
@stop

@section('title')
    Editar cliente
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                 
                    {!! Form::open(['route'=> ['clientes.update',Crypt::encrypt($cliente->id)], 'id' => 'form-clientes']) !!}
                    @include('clientes.fields')
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
    <script src="{{ asset('js/ajax-edit.js') }}"></script>
<script>
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        }); 
           
        var data_form = $("#form-clientes");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_edit(url,'PUT',formData,'#add-cliente'); 
        });
</script>

@endsection 