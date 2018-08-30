<div class="row">
    <div class="form-group col-sm-6" id="div-name">
        {!! Form::label('name', 'Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('name', isset($rol)? $rol->name : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-display_name">
        {!! Form::label('display_name', 'Display Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('display_name', isset($rol)? $rol->display_name : null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group col-sm-6 col-xs-12" >
    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text">Guardar</span>', 
                    ['type' => 'submit', 'class' => 'btn btn-success btn-anim', 'id'=>'add-rol']) !!}
    <a href="{!! route('roles') !!}" class="btn btn-default btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text">Cancelar</span>
    </a>
</div>
