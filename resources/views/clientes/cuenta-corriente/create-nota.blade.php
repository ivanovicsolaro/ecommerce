@extends('layouts.app') @section('contenido')

@section('title')
    Crear Nota Crédito / Débito
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                     {!! Form::open(['route' => 'clientes.store-nota', 'action'=>'post', 'id' => 'form-nota']) !!}
                    {{ csrf_field() }}
                        <input type="hidden" name="id_cliente" value="{{$id}}">
                        @include('clientes.cuenta-corriente.fields')

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

            $('#client').keyup(function(){
                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url: "{{ route('client.find')}}",
                        method: 'get',
                        data: {query:query},
                        success:function(data){
                            $('#clientList').fadeIn();
                            $('#clientList').html(data);
                        }
                    })
                }
            });
        });

        function seleccionar(id){
            $('#client').val($('#list'+id).text());
            $('#id_cliente').val(id);
            $('#clientList').fadeOut();                         
        };

        var data_form = $("#form-nota");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_add(url,'POST',formData,'#add-cliente') 
        });
    </script> 
    
@endsection 