var departamento = null;
var ciudad = null;
$(function () {
    $('body').on('click','.btn-editar-departamento',function () {
        departamento = $(this).data('departamento');
        cargarFormDepartamento();
    })

    $('body').on('click','#btn-agregar-departamento',function () {
        cargarFormDepartamento();
    })

    $('body').on('click','.btn-eliminar-departamento',function () {
        departamento = $(this).data('departamento');
        $('#modal-eliminar-departamento').modal('show');
    })

    $('#btn-guardar-departamento').click(function () {
        guardarDepartamento();
    })

    $('#btn-eliminar-departamento').click(function () {
        eliminarDepartamento();
    })

    /**
     * MANEJO DE CIUDADES
     */

    $('body').on('click','.btn-editar-ciudad',function () {
        ciudad = $(this).data('ciudad');
        cargarFormCiudad();
    })

    $('body').on('click','#btn-agregar-ciudad',function () {
        cargarFormCiudad();
    })

    $('body').on('click','.btn-eliminar-ciudad',function () {
        ciudad = $(this).data('ciudad');
        $('#modal-eliminar-ciudad').modal('show');
    })

    $('#btn-guardar-ciudad').click(function () {
        guardarCiudad();
    })

    $('#btn-eliminar-ciudad').click(function () {
        eliminarCiudad();
    })

    $('#departamento').change(function () {
        cargarTablaCiudades();
    })
})

/**
 * FUNCIONALIDADES PARA DEPARTAMENTOS
 */

function cargarTablaDepartamentos() {
    var tabla_departamento = $('#tabla-departamento').dataTable({ "destroy": true });
    tabla_departamento.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-departamento').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    /*$('#tabla-departamento').on('preXhr.dt', function(e, settings, json) {
        if($('#estado').val()){
            json.estado = $('#estado').val();
        }
        if($('#razon_estado').val()){
            json.razon_estado = $('#razon_estado').val();
        }
    })*/

    tabla_departamento = $('#tabla-departamento').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/region/lista-departamentos",
        columns: [
            {data: 'pais', name: 'pais'},
            {data: 'nombre', name: 'nombre'},
            {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function cargarFormDepartamento(){
    var params = {_token:$('#general_token').val(),departamento:departamento};
    var url = $('#general_url').val()+'/region/form-departamento';
    abrirBlockUiCargando('Cargando ');
    $.post(url,params)
        .done(function (data) {
            $('#modal-departamento .modal-body').html(data);
            $('#modal-departamento').modal('show');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarDepartamento(){
    var params = $('#form-departamento').serialize();

    var url = $('#general_url').val()+'/region/guardar-departamento';
    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-regiones","success",['La información fue almacenada con éxito.'],null,null);
                $('#modal-departamento').modal('hide');
                cargarTablaDepartamentos();
                cerrarBlockUiCargando();
            }
            departamento = null;
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-form-departamento","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
            departamento = null;
        })
}

function eliminarDepartamento(){
    var params = {_token:$('#general_token').val(),departamento:departamento};

    var url = $('#general_url').val()+'/region/eliminar-departamento';
    abrirBlockUiCargando('Eliminando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-regiones","success",['Departamento eliminado con éxito.'],null,null);
                $('#modal-eliminar-departamento').modal('hide');
                cargarTablaDepartamentos();
                cerrarBlockUiCargando();
            }
            departamento = null;
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
            departamento = null;
        })
}

/**
 * FUNCIONALIDADES PARA CIUDADES
 */

function cargarTablaCiudades() {
    var tabla_ciudad = $('#tabla-ciudad').dataTable({ "destroy": true });
    tabla_ciudad.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-ciudad').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    $('#tabla-ciudad').on('preXhr.dt', function(e, settings, json) {
        json.departamento = $('#departamento').val();
    })

    tabla_ciudad = $('#tabla-ciudad').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/region/lista-ciudades",
        columns: [
            {data: 'departamento', name: 'departamento'},
            {data: 'nombre', name: 'nombre'},
            {data: 'opciones', name: 'opciones', orderable: false, searchable: false,"className": "text-center"}
        ],
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function cargarFormCiudad(){
    var params = {_token:$('#general_token').val(),ciudad:ciudad};
    var url = $('#general_url').val()+'/region/form-ciudad';
    abrirBlockUiCargando('Cargando ');
    $.post(url,params)
        .done(function (data) {
            $('#modal-ciudad .modal-body').html(data);
            $('#modal-ciudad').modal('show');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarCiudad(){
    var params = $('#form-ciudad').serialize();

    var url = $('#general_url').val()+'/region/guardar-ciudad';
    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-regiones","success",['La información fue almacenada con éxito.'],null,null);
                $('#modal-ciudad').modal('hide');
                cargarTablaCiudades();
                cerrarBlockUiCargando();
            }
            ciudad = null;
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-form-ciudad","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
            ciudad = null;
        })
}

function eliminarCiudad(){
    var params = {_token:$('#general_token').val(),ciudad:ciudad};

    var url = $('#general_url').val()+'/region/eliminar-ciudad';
    abrirBlockUiCargando('Eliminando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-regiones","success",['Ciudad eliminada con éxito.'],null,null);
                $('#modal-eliminar-ciudad').modal('hide');
                cargarTablaCiudades();
                cerrarBlockUiCargando();
            }
            ciudad = null;
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
            ciudad = null;
        })
}