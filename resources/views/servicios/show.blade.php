@extends('layouts.app') @section('contenido')


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
                        {{ csrf_field() }}
                    <div class="form-group col-sm-6" id="div-price">
                    {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}

                    {!! Form::text('cliente', isset($servicio)? $nombre : 'CONSUMIDOR FINAL', ['class' => 'form-control', 'id' => 'client', 'min'=>'1', 'readonly']) !!}

                    <div id="clientList"></div>
                    <input type="hidden" id="id_cliente" name="id_cliente" value="@if(isset($servicio)) $servicio->customer->id @else 1 @endif">
                </div>

                  <div class="form-group col-sm-3" id="div-marca">
                        {!! Form::label('marca', 'Marca: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('marca', isset($servicio)? $servicio->marca : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly' ]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-modelo">
                        {!! Form::label('modelo', 'Modelo: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('modelo', isset($servicio)? $servicio->modelo : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly']) !!}
                    </div>

                   <div class="form-group col-sm-3" id="div-price">
                        {!! Form::label('estado', 'Estado: *',['class' => 'control-label mb-10 text-left']) !!}
                            <select name="estado" id="estado" class="form-control" readonly>
                                <option value="Ingresado" @if(isset($servicio) && $servicio->estado == 'Ingresado') selected @endif>Ingresado</option>
                                <option value="En proceso de revision" @if(isset($servicio) && $servicio->estado == 'En proceso de revision') selected @endif>En proceso de revisión</option>
                                <option value="Esperando aceptación presupuesto" @if(isset($servicio) && $servicio->estado == 'Esperando aceptación presupuesto') selected @endif>Esperando aceptación presupuesto</option>
                                <option value="Esperando llegada de repuestos" @if(isset($servicio) && $servicio->estado == 'Esperando llegada de repuestos') selected @endif>Esperando llegada de repuestos</option>
                                <option value="En proceso de reparacion" @if(isset($servicio) && $servicio->estado == 'En proceso de reparacion') selected @endif>En proceso de reparación</option>
                                <option value="No admite solucion" @if(isset($servicio) && $servicio->estado == 'No admite solucion') selected @endif>No admite solución</option>
                                <option value="Reparado" @if(isset($servicio) && $servicio->estado == 'Reparado') selected @endif>Reparado</option>
                                <option value="Garantia" @if(isset($servicio) && $servicio->estado == 'Garantia') selected @endif>Garantía</option>
                                <option value="Archivado" @if(isset($servicio) && $servicio->estado == 'Garantia') selected @endif>Archivado</option>
                            </select>
                    </div>

                     <div class="form-group col-sm-3" id="div-estado">
                        {!! Form::label('nro_serie', 'Nro. Serie: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('nro_serie', isset($servicio)? $servicio->nro_serie : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly' ]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-precio_presupuestado">
                        {!! Form::label('precio_presupuestado', 'Precio presupuestado: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::number('precio_presupuestado', isset($servicio)? $servicio->precio_presupuestado : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly' ]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-precio_final">
                        {!! Form::label('precio_final', 'Precio final: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::number('precio_final', isset($servicio)? $servicio->precio_final : null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly' ]) !!}
                    </div>

                 <div class="form-group col-sm-12" id="div-description">
                        {!! Form::label('description', 'Descripción de la falla: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('description', isset($servicio)? $servicio->descripcion_falla : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus', 'readonly']) !!}
                    </div>

                     <div class="form-group col-sm-12" id="div-diagnostico">
                        {!! Form::label('diagnostico', 'Diagnostico: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('diagnostico', isset($servicio)? $servicio->diagnostico : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus' , 'readonly']) !!}
                    </div>

                     <div class="form-group col-sm-12" id="div-mano_obra">
                        {!! Form::label('mano_obra', 'Detalle mano de obra: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('mano_obra', isset($servicio)? $servicio->detalle_mano_obra : null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus' , 'readonly']) !!}
                    </div>

                <div class="pull-right">
                	 <a href="{!! route('servicios.index') !!}" class="btn main-btn btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
    </a>
                    <button class="primary-btn" id="add-servicio">Procesar</button>
                </div>

                    {!! Form::close() !!}
                </div>
                <div class="text-right col-md-12">
                 
                </div>
                </div>

         
            </div>
        </div>
    </section>


@endsection