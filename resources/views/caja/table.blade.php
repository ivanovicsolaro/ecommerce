<div class="table-responsive">
<table class="table datatable">
    <thead>
        <tr>
            <th class="text-center">Pago</th>
            <th class="text-center">Movimiento</th>
            <th class="text-center">Usuario</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Comprobante</th>
            <th class="text-center">Ingreso</th>
            <th class="text-center">Egresos</th>
            <th class="text-center">Saldo</th>
            <th class="text-center">Obs.</th>
            <th class="text-center">Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimientos as $movimiento)
            <tr id='trow_{{$movimiento->id}}'>
                <td class="text-center">{!! $movimiento->ptDes !!}</td>
                <td class="text-center">{!! $movimiento->tmDes !!}</td>
                <td class="text-center">{!! $movimiento->userName !!}</td>
                <td class="text-center">{!! $movimiento->description !!}</td>
                <td class="text-center">{!! $movimiento->comprobante_id !!}</td>
                <td class="text-center">{!! $movimiento->ingresos !!}</td>
                <td class="text-center">{!! $movimiento->egresos !!}</td>
                <td class="text-center">{!! $movimiento->saldo !!}</td>
                <td class="text-center">{!! $movimiento->observaciones !!}</td>
                <td class="text-center">{!! $movimiento->created_at !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
 <div class="pull-right">
                        {{ $movimientos->onEachSide(1)->links() }}     
                        </div>
</div>