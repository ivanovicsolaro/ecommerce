@extends('layouts.app') @section('contenido')

    <!--=================== About Content Section ===================-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12 mt20">
                    <div class="dashboard">
                   	 {!! Form::open(['route' => 'servicios.store', 'action'=>'post', 'id' => 'form-servicios']) !!}
                    	{{ csrf_field() }}
                        <div class="form-group col-sm-6" id="div-price">
                    {!! Form::label('cliente', 'Cliente: *',['class' => 'control-label mb-10 text-left']) !!}

                    {!! Form::text('cliente','CONSUMIDOR FINAL', ['class' => 'form-control', 'id' => 'client', 'min'=>'1']) !!}

                    <div id="clientList"></div>
                    <input type="hidden" id="id_cliente" name="id_cliente" value="1">
                </div>

                  <div class="form-group col-sm-3" id="div-marca">
                        {!! Form::label('marca', 'Marca: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('marca', null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-modelo">
                        {!! Form::label('modelo', 'Modelo: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('modelo', null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30]) !!}
                    </div>

                   <div class="form-group col-sm-3" id="div-price">
                        {!! Form::label('estado', 'Estado: *',['class' => 'control-label mb-10 text-left']) !!}
                            <select name="estado" id="estado" class="form-control">
                                <option value="Ingresado">Ingresado</option>
                                <option value="En proceso de revision">En proceso de revisión</option>
                                <option value="Esperando aceptación presupuesto" >Esperando aceptación presupuesto</option>
                                <option value="Esperando llegada de repuestos">Esperando llegada de repuestos</option>
                                <option value="En proceso de reparacion">En proceso de reparación</option>
                                <option value="No admite solucion">No admite solución</option>
                                <option value="Reparado">Reparado</option>
                                <option value="Garantia">Garantía</option>
                            </select>
                    </div>

                     <div class="form-group col-sm-3" id="div-estado">
                        {!! Form::label('nro_serie', 'Nro. Serie: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::text('nro_serie',null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-precio_presupuestado">
                        {!! Form::label('precio_presupuestado', 'Precio presupuestado: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::number('precio_presupuestado', null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30 ]) !!}
                    </div>

                     <div class="form-group col-sm-3" id="div-precio_final">
                        {!! Form::label('precio_final', 'Precio final: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::number('precio_final', null, ['class' => 'form-control','autofocus'=>'autofocus', 'maxlength' => 30, 'readonly' ]) !!}
                    </div>

                 <div class="form-group col-sm-12" id="div-description">
                        {!! Form::label('description', 'Descripción de la falla: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus']) !!}
                    </div>

                     <div class="form-group col-sm-12" id="div-diagnostico">
                        {!! Form::label('diagnostico', 'Diagnostico: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('diagnostico', null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus', 'readonly']) !!}
                    </div>

                     <div class="form-group col-sm-12" id="div-mano_obra">
                        {!! Form::label('mano_obra', 'Detalle mano de obra: *',['class' => 'control-label mb-10 text-left']) !!}
                        {!! Form::textarea('mano_obra', null, ['class' => 'form-control', 'rows'=>5, 'cols' => 20, 'autofocus'=>'autofocus', 'readonly']) !!}
                    </div>

                <div class="pull-right">
                     <a href="{!! route('servicios.index') !!}" class="btn main-btn btn-anim">
        <i class="fa fa-reply"></i><span class="btn-text"> Listado</span>
    </a>
                    <button class="primary-btn" id="add-servicio">Procesar</button>
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
       		$('#table-punto-venta').load('{{route("carrito.viewTableVenta")}}');

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

        var data_form = $("#form-servicios");

        data_form.submit(function(e){
            e.preventDefault();
            var formData = data_form.serialize();
            var url = $(this).attr('action');
            ajax_add(url,'POST',formData,'#add-servicio') 
        });    




    </script> 
    
@endsection 