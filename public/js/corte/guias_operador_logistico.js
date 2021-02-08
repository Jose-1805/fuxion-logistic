var cols = [
    {data: 'fecha_guia', name: 'fecha_guia', "className": "text-center"},
    {data: 'destino', name: 'destino'},
    {data: 'serie', name: 'serie', className:"text-center"},
    {data: 'correlativo', name: 'correlativo', "className": "text-center"},
    {data: 'tipo_empresario', name: 'tipo_empresario'},
    {data: 'empresario', name: 'empresario'},
    {data: 'seleccione', name: 'seleccione', "className": "text-center", orderable:false,searchable:false}
];
$(function () {
    $('#btn-reasignar-operador-logistico').click(function () {
        reasignarOperadorLogistico();
    });
    cargarTablaGuiasOperadorLogistico();
})


function cargarTablaGuiasOperadorLogistico() {
    var tabla_guias_operador_logistico = $('#tabla-guias-operador-logistico').dataTable({ "destroy": true });
    tabla_guias_operador_logistico.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-guias-operador-logistico').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    tabla_guias_operador_logistico = $('#tabla-guias-operador-logistico').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/corte/lista-guias-operador-logistico/"+$('#corte').val()+'/'+$('#operador_logistico').val(),
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id','row_'+aData.id);
            setTimeout(function () {
            },300);
        },
    });
}

function reasignarOperadorLogistico() {
    var params = $("#form-reasignar-guias-operador-logistico").serialize();
    var url = $("#general_url").val()+"/corte/reasignar-guias-operador-logistico";

    abrirBlockUiCargando('Reasignando guías ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                cargarTablaGuiasOperadorLogistico();
                abrirAlerta("guias-operador-logistico","success",['Las guías seleccionadas se reasignaron con éxito'],null,"body");
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("guias-operador-logistico","danger",JSON.parse(jqXHR.responseText),null,"modal-nuevo-rol");
            cerrarBlockUiCargando();
        })
}