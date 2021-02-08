var cols = null;
var pedido = null;
$(function () {
    $('body').on('change','.campo-filtro',function () {
        cargarTablaPedidos();
    })

    $('body').on('click','.opciones-soporte-empresario',function (e) {
        pedido = $(this).parent().parent().attr('id');
        cargarOpciones();
    })

    $('body').on('click','.btn-historial-guias',function (e) {
        pedido = $(this).parent().parent().attr('id');
        cargarHistorialGuias();
    })
    
	$('body').on('click','.btn-tracking',function (e) {
        pedido = $(this).parent().parent().attr('id');
        cargarTracking();
    })

    $('body').on('click','.btn-imagenes-guias',function (e) {
        pedido = $(this).parent().parent().attr('id');
        cargarImagenesGuia();
    })

    $('body').on('click','#btn-empresario',function () {
        $('#modal-aprobacion-empresario').modal('show');
    })

    $('body').on('click','#btn-empresario-ok',function () {
        $('#modal-aprobacion-empresario').modal('hide');
        actualizarEmpresario();
    })

    $('body').on('click','#btn-kit',function () {
        $('#modal-aprobacion-kit').modal('show');
    })

    $('body').on('click','#btn-kit-ok',function () {
        $('#modal-aprobacion-kit').modal('hide');
        guardarFacturaKit();
    })

    $('body').on('click','#btn-flete',function () {
        $('#modal-aprobacion-flete').modal('show');
    })

    $('body').on('click','#btn-flete-ok',function () {
        $('#modal-aprobacion-flete').modal('hide');
        guardarFletePedido();
    })

    $('body').on('click','#btn-entregado-tienda',function () {
        $('#modal-aprobacion-entregado-tienda').modal('show');
    })

    $('body').on('click','#btn-entregado-tienda-ok',function () {
        $('#modal-aprobacion-entregado-tienda').modal('hide');
        entregadoTienda();
    })

    $('body').on('click','#btn-devolucion',function () {
        $('#modal-aprobacion-devolucion').modal('show');
    })

    $('body').on('click','#btn-devolucion-ok',function () {
        $('#modal-aprobacion-devolucion').modal('hide');
        guardarFleteDevolucion();
    })

    $('body').on('click','#btn-pendiente-producto',function () {
        $('#modal-aprobacion-pendiente-producto').modal('show');
    })

    $('body').on('click','#btn-pendiente-producto-ok',function () {
        $('#modal-aprobacion-pendiente-producto').modal('hide');
        actualizarPendienteProducto();
    })

    $('body').on('click','#btn-anulado-soporte',function () {
        $('#modal-aprobacion-anulado-soporte').modal('show');
    })

    $('body').on('click','#btn-anulado-soporte-ok',function () {
        $('#modal-aprobacion-anulado-soporte').modal('hide');
        actualizarAnuladoSoporte();
    })

    $('body').on('click','#btn-anulado',function () {
        $('#modal-aprobacion-anulado').modal('show');
    })

    $('body').on('click','#btn-anulado-ok',function () {
        $('#modal-aprobacion-anulado').modal('hide');
        actualizarAnulado();
    })

    $('body').on('click','#btn-factura-pedido',function () {
        $('#modal-aprobacion-factura-pedido').modal('show');
    })

    $('body').on('click','#btn-factura-pedido-ok',function () {
        $('#modal-aprobacion-factura-pedido').modal('hide');
        guardarFacturaPendientePedido();
    })
})

function setCols(columns) {
    cols = columns
}

function cargarTablaPedidos() {
    var tabla_pedidos = $('#tabla-pedidos').dataTable({ "destroy": true });
    tabla_pedidos.fnDestroy();
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabla-pedidos').on('error.dt', function(e, settings, techNote, message) {
        console.log( 'DATATABLES ERROR: ', message);
    })
    $('#tabla-pedidos').on('preXhr.dt', function(e, settings, json) {
        if($('#estado').val()){
            json.estado = $('#estado').val();
        }
        if($('#razon_estado').val()){
            json.razon_estado = $('#razon_estado').val();
        }
    })

    tabla_pedidos = $('#tabla-pedidos').DataTable({
        lenguage: idioma_tablas,
        processing: true,
        serverSide: true,
        ajax: $("#general_url").val()+"/soporte-empresario/lista",
        columns: cols,
        fnRowCallback: function (nRow, aData, iDisplayIndex) {
            $(nRow).attr('id', aData.id);
        },
    });
}

function cargarOpciones() {
    if(pedido){
        var params = {_token:$('#general_token').val(),pedido:pedido};
        var url = $("#general_url").val()+"/soporte-empresario/opciones";

        abrirBlockUiCargando('Guardando ');

        $.post(url,params)
            .done(function (data) {
                $('#numero_orden').html(data.numero_orden);
                $('#contenido-soporte-empresario').html(data.html);
                $('#modal-soporte-empresario').modal('show');
                //pedido = null;
                cargarClasesNumeros();
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,state,error) {
                abrirAlerta("alertas-soporte-empresario","danger",JSON.parse(jqXHR.responseText),null,null);
                cerrarBlockUiCargando();
            })
    }
}

function cargarTracking() {
    if(pedido){
        var params = {_token:$('#general_token').val(),pedido:pedido};
        var url = $("#general_url").val()+"/soporte-empresario/tracking";

        abrirBlockUiCargando('Guardando ');

        $.post(url,params)
            .done(function (data) {
                $('#tracking_numero_orden').html(data.numero_orden);
                $('#contenido-tracking').html(data.html);
                $('#modal-tracking').modal('show');
                pedido = null;
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,state,error) {
                abrirAlerta("alertas-soporte-empresario","danger",JSON.parse(jqXHR.responseText),null,null);
                cerrarBlockUiCargando();
            })
    }
}

function cargarHistorialGuias() {
    if(pedido){
        var params = {_token:$('#general_token').val(),pedido:pedido};
        var url = $("#general_url").val()+"/soporte-empresario/historial-guias";

        abrirBlockUiCargando('Guardando ');

        $.post(url,params)
            .done(function (data) {
                $('#historial_numero_orden').html(data.numero_orden);
                $('#contenido-historial-guias').html(data.html);
                $('#modal-historial-guias').modal('show');
                pedido = null;
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,state,error) {
                abrirAlerta("alertas-soporte-empresario","danger",JSON.parse(jqXHR.responseText),null,null);
                cerrarBlockUiCargando();
            })
    }
}

function actualizarEmpresario() {
    var params = $('#form-empresario').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/actualizar-empresario";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-empresario", "success", ['La información del empresario ha sido actualizada con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-empresario","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarFacturaKit() {
    var params = $('#form-kit').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/guardar-factura-kit";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-kit", "success", ['El número de factura de kit ha sido almacenado con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-kit","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarFletePedido() {
    var params = $('#form-flete').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/guardar-flete-pedido";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-flete", "success", ['La factura del flete ha sido almacenada con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-flete","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function entregadoTienda() {
    var params = {_token:$('#general_token').val(),pedido:pedido};
    var url = $("#general_url").val()+"/soporte-empresario/entregado-tienda";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-soporte-empresario", "success", ['El estado del pedido fue actuallizado con éxito'], null, null);
                $('#modal-soporte-empresario').modal('hide');
                pedido = null;
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-flete","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function actualizarPendienteProducto() {
    var params = $('#form-pendiente-producto').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/actualizar-pendiente-producto";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-pendiente-producto", "success", ['El estado del pedido ha sido actualizado con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-pendiente-producto","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function actualizarAnuladoSoporte() {
    var params = $('#form-anulado-soporte').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/actualizar-anulado-soporte";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-soporte-empresario", "success", ['El estado del pedido ha sido actualizado con éxito'], null, null);
                cargarTablaPedidos();
                $('#modal-soporte-empresario').modal('hide');
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-anulado-soporte","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function actualizarAnulado() {
    var params = $('#form-anulado').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/actualizar-anulado";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-soporte-empresario", "success", ['El estado del pedido ha sido actualizado con éxito'], null, null);
                cargarTablaPedidos();
                $('#modal-soporte-empresario').modal('hide');
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-anulado","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function guardarFleteDevolucion() {
    var params = $('#form-flete-devolucion').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/guardar-flete-devolucion";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-flete-devolucion", "success", ['La factura del flete ha sido almacenada con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-flete-devolucion","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}

function cargarImagenesGuia() {
    if(pedido){
        var params = {_token:$('#general_token').val(),pedido:pedido};
        var url = $("#general_url").val()+"/soporte-empresario/imagenes-guia";

        abrirBlockUiCargando('Consultando ');

        $.post(url,params)
            .done(function (data) {
                $('#contenido-imagenes-guias').html(data.html);
                $('#modal-imagenes-guias').modal('show');
                pedido = null;
                cerrarBlockUiCargando();
            })
            .fail(function (jqXHR,state,error) {
                abrirAlerta("alertas-soporte-empresario","danger",JSON.parse(jqXHR.responseText),null,null);
                cerrarBlockUiCargando();
            })
    }
}

function guardarFacturaPendientePedido() {
    var params = $('#form-pendiente-pedido').serialize();
    var url = $("#general_url").val()+"/soporte-empresario/guardar-pendiente-pedido";

    abrirBlockUiCargando('Guardando ');

    $.post(url,params)
        .done(function (data) {
            if(data.success) {
                abrirAlerta("alertas-soporte-empresario", "success", ['La factura del pedido ha sido almacenada con éxito'], null, null);
                cargarTablaPedidos();
                cerrarBlockUiCargando();
                $('#modal-soporte-empresario').modal('hide');
            }
        })
        .fail(function (jqXHR,state,error) {
            abrirAlerta("alertas-pendiente-pedido","danger",JSON.parse(jqXHR.responseText),null,null);
            cerrarBlockUiCargando();
        })
}