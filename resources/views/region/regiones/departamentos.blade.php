<div class="contenedor-opciones-vista">
</div>
<table id="tabla-departamento" class="table-hover dataTable">
    <thead>
        <th>Pais</th>
        <th>Departamento</th>
        <th>Opciones</th>
    </thead>
</table>

@if(Auth::user()->tieneFuncion(16, 1, $privilegio_superadministrador))
    <div class="col-xs-12 text-center margin-top-20">
        <a href="#!" type="button" class="btn btn-success btn-radius" id="btn-agregar-departamento"><i class="fa fa-plus margin-right-10"></i>Nuevo</a>
    </div>
@endif
