@extends('layouts.app') @section('contenido')

@section('title')
    Lista de Configuraciones
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                     {!! Form::open(['route' => 'config.update', 'action'=>'post', 'id' => 'form-movimientos']) !!}
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6" id="div-dolar">
	       					 {!! Form::label('dolar', 'Dolar: *',['class' => 'control-label mb-10 text-left']) !!}
	        				{!! Form::number('dolar', null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
	   					 </div>

	   					 <div class="form-group col-sm-12 col-xs-12">
        <div class="text-right col-md-12">
    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-movimiento']) !!}
    
</div>
</div>

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

        var data_form = $("#form-movimientos");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_add(url,'POST',formData,'#add-movimiento') 
        });
    </script> 
    
@endsection 