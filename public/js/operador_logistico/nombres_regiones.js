var cols_departamentos = null;
var departamento = null;
var cols_ciudades = null;
var ciudad = null;
$(function () {
    $('body').on('click','.btn-nombre-departamento-ol',function () {
        departamento = $(this).data('departamento');
        cargarFormDepartamentos();
    })

    $('#btn-guardar-nombres-departamentos').click(function () {
        guardarNombresDepartamentos();
    })

    $('#departamento').change(function () {
        cargarTablaCiudades();
    })

    $('body').on('click','.btn-nombre-ciudades-ol',function () {
        ciudad = $(this).data('ciudad');
        cargarFormCiudades();
    })

    $('#btn-guardar-nombres-ciudades').click(function () {
        guardarNombresCiudades();
    })
})

/**
 * FUNCIONALIDADES PARA DEPARTAMENTOS
 */

function setColsDepartamentos(cols) {
    cols_departamentos = cols;
}

function cargarTablaDepartamentos() {
    var tabla_nombres_departamentos = $('#tabla-nombres-departamentos').dataTable({ "destroy": true });
    tabla_nombres_departamentos.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-nombres-departamentos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    /*$('#tabla-nombres-departamentos').on('preXhr.dt', function(e, settings, json) {
        if($('#estado').val()){
            json.estado = $('#estado').val();
        }
        if($('#razon_estado').val()){
            json.razon_estado = $('#razon_estado').val();
        }
    })*/

    tabla_nombres_departamentos = $('#tabla-nombres-departamentos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/operador-logistico/lista-departamentos",
        columns: cols_departamentos,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function cargarFormDepartamentos(){
    var params = {_token:$('#general_token').val(),departamento:departamento};
    var url = $('#general_url').val()+'/operador-logistico/form-nombres-departamentos';
    abrirBlockUiCargando('Cargando ');
    $.post(url,params)
        .done(function (data) {
            $('#modal-nombres-departamentos .modal-body').html(data);
            $('#modal-nombres-departamentos').modal('show');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nombres-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarNombresDepartamentos(){
    var params = $('#form-nombres-departamentos').serialize();

    var url = $('#general_url').val()+'/operador-logistico/guardar-nombres-departamentos';
    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-nombres-regiones","success",['La información fue almacenada con éxito.'],null,null);
                $('#modal-nombres-departamentos').modal('hide');
                cargarTablaDepartamentos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nombres-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

/**
 * FUNCIONALIDADES PARA CIUDADES
 */

function setColsCiudades(cols) {
    cols_ciudades = cols;
}

function cargarTablaCiudades() {
    var tabla_nombres_ciudades = $('#tabla-nombres-ciudades').dataTable({ "destroy": true });
    tabla_nombres_ciudades.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-nombres-ciudades').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })

    $('#tabla-nombres-ciudades').on('preXhr.dt', function(e, settings, json) {
        json.departamento = $('#departamento').val();
    })

    tabla_nombres_ciudades = $('#tabla-nombres-ciudades').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/operador-logistico/lista-ciudades",
        columns: cols_ciudades,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function cargarFormCiudades(){
    var params = {_token:$('#general_token').val(),ciudad:ciudad};
    var url = $('#general_url').val()+'/operador-logistico/form-nombres-ciudades';
    abrirBlockUiCargando('Cargando ');
    $.post(url,params)
        .done(function (data) {
            $('#modal-nombres-ciudades .modal-body').html(data);
            $('#modal-nombres-ciudades').modal('show');
            cerrarBlockUiCargando();
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nombres-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarNombresCiudades(){
    var params = $('#form-nombres-ciudades').serialize();

    var url = $('#general_url').val()+'/operador-logistico/guardar-nombres-ciudades';
    abrirBlockUiCargando('Guardando ');
    $.post(url,params)
        .done(function (data) {
            if(data.success){
                abrirAlerta("alertas-nombres-regiones","success",['La información fue almacenada con éxito.'],null,null);
                $('#modal-nombres-ciudades').modal('hide');
                cargarTablaCiudades();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-nombres-regiones","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}