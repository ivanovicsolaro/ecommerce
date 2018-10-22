<div class="table-responsive">
<table class="table datatable">
    <thead>
        <tr>
            <th class="text-center">Nro</th>
            <th class="text-center">Cliente</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Teléfono</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($servicios as $servicio)
            <tr id='trow_{{$servicio->id}}'>
                <td class="text-center">{!! $servicio->id !!}</td>
                <td class="text-center">{!! $servicio->customer->lastname !!}, {!! $servicio->customer->firstname !!}</td>
                <td class="text-center">{!! $servicio->estado !!}</td>
                <td class="text-center">{!! $servicio->customer->phone !!}</td>
                  <td class="text-center">
                  	     <a href="{!! route('servicios.edit', [Crypt::encrypt($servicio->id)]) !!}"  data-toggle="tooltip" data-original-title="Editar">
                            <button type="button" class="btn btn-success btn-icon-anim btn-square btn-sm">
                             <i class="fa fa-pencil"></i>
                            </button>
                        </a>

                      <a>
                            <button type="button" class="btn btn-default btn-icon-anim btn-square btn-sm"   onclick="showModalProductos({{$servicio->id}})" alt="Imprimir Codigo Barras"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>
                        </a> 
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
 <div class="pull-right">
                        {{ $servicios->onEachSide(1)->links() }}     
                        </div>
</div>