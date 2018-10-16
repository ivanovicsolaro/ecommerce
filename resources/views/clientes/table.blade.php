<div class="table-responsive">
<table class="table datatable">
    <thead>
        <tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">CUIT / DNI</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Teléfono</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
            <tr id='trow_{{$cliente->id}}'>
                <td class="text-center">{!! $cliente->lastname !!}, {!! $cliente->firstname !!}</td>
                <td class="text-center">{!! $cliente->registration_nr !!}</td>
                <td class="text-center" ><b>@if($cliente->is_active == 1) <p style="color: green">Activo</p> @else <p style="color: red">Inactivo</p> @endif</b></td>
                <td class="text-center">{!! $cliente->phone !!}</td>
                <td class="text-center" style="width: 200px;" >
                    <div class='btn-group'>
                        <a href="{!! route('clientes.edit', [Crypt::encrypt($cliente->id)]) !!}"  data-toggle="tooltip" data-original-title="Editar">
                            <button type="button" class="btn btn-success btn-icon-anim btn-square btn-sm">
                             <i class="fa fa-pencil"></i>
                            </button>
                        </a>

                         <a href="javascript:;"  onclick="eliminar('{{Crypt::encrypt($cliente->id)}}',{{$cliente->id}})" id="btn_{{$cliente->id}}" data-toggle="tooltip" data-original-title="Eliminar">
                            <button type="button" class="btn btn-danger btn-icon-anim btn-square btn-sm">
                             <i class="fa fa-trash"></i>
                            </button>
                        </a>                           
                    </div> 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
 <div class="pull-right">
                        {{ $clientes->onEachSide(1)->links() }}     
                        </div>
</div>