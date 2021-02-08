<table id="tabla-nombres-departamentos" class="table-hover dataTable">
    <thead>
        <th>Departamento</th>
        @foreach($operadores_logisticos as $ol)
            <th>{{$ol->nombre}}</th>
        @endforeach
        <th>Opciones</th>
    </thead>
</table>