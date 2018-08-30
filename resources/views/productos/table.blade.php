<div class="table-responsive">
<table class="table datatable">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">Código</th>
            <th class="text-center">Stock</th>
            <th class="text-center">Precio</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr id='trow_{{$producto->id}}'>
                <td class="text-center">{!! $producto->id !!}</td>
                <td class="text-center">{!! $producto->name !!}</td>
                <td class="text-center">{!! $producto->sku !!}</td>
                <td class="text-center" >{!! $producto->stock !!}</td>
                <td class="text-center">{!! $producto->price !!}</td>
                <td class="text-center" style="width: 200px;" >
                    <div class='btn-group'>
                        <a href="{!! route('productos.edit', [Crypt::encrypt($producto->id)]) !!}"  data-toggle="tooltip" data-original-title="Editar">
                            <button type="button" class="btn btn-success btn-icon-anim btn-square btn-sm">
                             <i class="fa fa-pencil"></i>
                            </button>
                        </a>

                        <a href="javascript:;"  onclick="eliminar('{{Crypt::encrypt($producto->id)}}',{{$producto->id}})" id="btn_{{$producto->id}}" data-toggle="tooltip" data-original-title="Eliminar">
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
</div>