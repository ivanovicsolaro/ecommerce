 <div class="row">
 <div class="col-sm-12 col-md-6">

    <div class="form-group col-sm-6" id="div-name">
        {!! Form::label('name', 'Nombre: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('name', isset($cliente)? $cliente->firstname : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-apellido">
        {!! Form::label('apellido', 'Apellido: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('apellido', isset($cliente)? $cliente->lastname : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

     <div class="form-group col-sm-12" id="div-cuit">
        {!! Form::label('cuit', 'DNI/CUIT: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('cuit', isset($cliente)? $cliente->registration_nr : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-email">
            {!! Form::label('email', 'Email: *',['class' => 'control-label mb-10 text-left']) !!}
            {!! Form::email('email', isset($cliente)? $cliente->email : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-phone">
        {!! Form::label('phone', 'Teléfono: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('phone', isset($cliente)? $cliente->phone : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>
</div>
<div class="col-sm-12 col-md-6">

     <div class="form-group col-sm-12" id="div-company_name">
        {!! Form::label('company_name', 'Nombre de la companía: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('company_name', isset($cliente)? $cliente->company_name : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-12" id="div-tipo">
        {!! Form::label('tipo', 'Tipo: *',['class' => 'control-label mb-10 text-left']) !!}
        <select name="tipo" id="tipo" class="form-control">
            <option value="individual" @if(isset($cliente) && ($cliente->type == 'Individual')) selected @endif>Individual</option>
            <option value="organization" @if(isset($cliente) && ($cliente->type == 'Organization')) selected @endif>Organización</option>
        </select>
    </div>    

     <div class="form-group col-sm-6" id="div-tax_nr">
        {!! Form::label('tax_nr', 'Cuit Companía: *',['class' => 'control-label mb-10 text-left']) !!}
        {!! Form::text('tax_nr', isset($cliente)? $cliente->tax_nr : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>

    <div class="form-group col-sm-6" id="div-activo">
        {!! Form::label('is_active', 'Activo: *',['class' => 'control-label mb-10 text-left']) !!}
         {!! Form::select('is_active', array('1' => 'Activo', '0' => 'Inactivo'), (isset($cliente))? $cliente->is_active : null, ['class' => 'form-control','autofocus'=>'autofocus']) !!}
    </div>



    </div>

     <div class="form-group col-sm-12 col-xs-12">
        <div class="text-right col-md-12">
    {!! Form::button('<i class="fa fa-database"></i><span class="btn-text"> Guardar</span>', 
                    ['type' => 'submit', 'class' => 'primary-btn btn-success btn-anim', 'id'=>'add-cliente']) !!}
    <a href="{!! route('clientes.index') !!}" class="btn main-btn btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
    </a>
</div>
</div>

</div>