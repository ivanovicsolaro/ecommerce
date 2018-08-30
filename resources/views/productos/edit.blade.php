@extends('layouts.master_admin')

@section('title')
    Editar rol
@stop

@section('content')

<ul class="breadcrumb">
    <li><a href="#">Admin</a></li>                    
    <li><a href="#">Rol</a></li>
    <li class="active">Rditar</li>
</ul>


<div class="page-title">                    
    <h2><span class="fa fa-plus"></span> Editar el rol</h2>
    <a class="btn btn-primary btn-anim pull-right"  href="{!! route('roles') !!}">
        <i class="fa fa-list"></i><span class="btn-text">Listado</span>
    </a>
</div>

<div class="page-content-wrap">                

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['route' => ['rol.update',Crypt::encrypt($rol->id)], 'id' => 'form-rol']) !!}

                            @include('admin.roles.fields')

                    {!! Form::close() !!}
                </div>
            </div>
           
        </div>
    </div>                                
    
</div>
<!-- PAGE CONTENT WRAPPER --> 
@endsection

@section('js')
    @parent
    <script src="{{ asset('back/js/toast-function.js') }}"></script>
    <script src="{{ asset('back/js/ajax-edit.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
        });  

        var data_form = $("#form-rol");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_edit(url,'POST',formData,'#add-rol')
            
        });
    </script> 
    
@endsection 