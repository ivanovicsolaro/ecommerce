<div class="table-responsive">
<table id="table-devoluciones" class="table datatable">
    <thead>
        <tr>
            <th class="text-center">Nro.</th>
            <th class="text-center">Motivo</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($devoluciones as $devolucion)
            <tr id='trow_{{$devolucion->id}}'>
                <td class="text-center">{!! $devolucion->id !!}</td>
                <td class="text-center">{!! $devolucion->motivo !!}</td>
                <td class="text-center">{!! $devolucion->created_at !!}</td>
                <td class="text-center">
                      <a>
                            <button type="button" class="btn btn-default btn-icon-anim btn-square btn-sm"   onclick="showModalProductos({{$devolucion->id}})" alt="Imprimir Codigo Barras"><i class="fa fa-barcode" aria-hidden="true"></i>
                            </button>
                        </a> 
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

 <div class="pull-right">
                        {{ $devoluciones->onEachSide(1)->links() }}     
                        </div>