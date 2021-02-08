@if($nombre_reporte == 'logistica')
    @include('reporte.reportes.excel_logistica')
@elseif($nombre_reporte == 'incidencias')
    @include('reporte.reportes.excel_incidencias')
@elseif($nombre_reporte == 'pedidos_productos')
    @include('reporte.reportes.excel_pedidos_productos')
@elseif($nombre_reporte == 'tiempos_logistica')
    @include('reporte.reportes.excel_tiempos_logistica')
@endif