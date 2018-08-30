<table class="table datatable">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Código</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Creado el</th>
            <th class="text-nowrap">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr id='trow_{{$producto->id}}'>
                <td>{!! $producto->sku !!}</td>
                <td>{!! $producto->stock !!}</td>
                <td>{!! $producto->precio !!}</td>
                <td>{!! $rol->created_at !!}</td>
                <td align="center" style="width: 200px;" >
                    <div class='btn-group'>
                        <a href="{!! route('product.edit', [Crypt::encrypt($producto->id)]) !!}"  data-toggle="tooltip" data-original-title="Editar">
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