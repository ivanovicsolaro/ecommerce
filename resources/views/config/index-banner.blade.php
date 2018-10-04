@extends('layouts.app') @section('contenido')

@section('title')
    Modificación Banners Home Page
@stop

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                        {!! Form::open(['route'=> ['update.banner'], 'method' => 'POST', 'files'=>'true']) !!}
                         {{ csrf_field() }}
                    <div class="row">
                     <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_1_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_1_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_1_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_1_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_1_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_1_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_2_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_2_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_2_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_2_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_2_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_2_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_3_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_3_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_3_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_3_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_3_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_3_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_4_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_4_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_4_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_4_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_4_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_4_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_5_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_5_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_5_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_5_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_5_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_5_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_6_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_6_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_6_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_6_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_6_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_6_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>
                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_7_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_7_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_7_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_7_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_7_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_7_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_8_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_8_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_8_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_8_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_8_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_8_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_9_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_9_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_9_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_9_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_9_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_9_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                      <div class="col-sm-12 col-md-6">

                        <div class="form-group col-sm-12" id="div-name">
                            {!! Form::label('banner_10_title', 'Titulo Banner 1: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_10_title', isset($banner)? $producto->banner_1_title : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-stock">
                            {!! Form::label('banner_10_url', 'Url: *',['class' => 'control-label mb-10 text-left']) !!}
                            {!! Form::text('banner_10_url', isset($banner)? $producto->banner_1_url : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                        </div>

                        <div class="form-group col-sm-6" id="div-price">
                                {!! Form::label('banner_10_file', 'Imagen: *',['class' => 'control-label mb-10 text-left']) !!}
                                {!! Form::file('banner_10_file', null , ['class' => 'form-control','autofocus'=>'autofocus']) !!}
                            </div>

                    </div>

                    </div>
                    <br/><br/>

                            <div class="text-right col-md-12">
                    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
                                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-producto']) !!}
                    <a href="{!! route('productos.index') !!}" class="btn main-btn btn-anim">
                        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
                    </a>
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