var idioma_tablas = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};
$(function () {
    //evita que se cierren las alertas como lo hace bootstrap (quitando la clase de la alert) y oculta con la clase hide la alerta
    $('body').on('click','.alert .close',function () {
        $(this).parent().addClass('hide');
    })

    //Cuando se presione enter dentro de un formulario se realiza click sobre el elemento que contenga la clase btn-submit
    $("body").on('keyup','form',function (e) {
        if(e.keyCode == 13 && e.target.nodeName != 'TEXTAREA'){
            $(this).find('.btn-submit').click();
        }
    })

    //evita que se realice el submit de un form
    $('body').on('submit','form.no_submit',function (e) {
        e.preventDefault();
    })

    $(window).scroll(function () {
        if($(window).scrollTop() >= 160){
            $('.contenedor-opciones-vista').addClass('contenedor-opciones-vista-fixed');
        }else{
            $('.contenedor-opciones-vista').removeClass('contenedor-opciones-vista-fixed');
        }
    })

    $('.toggle-items').click(function () {
        var elemento = $(this).parent().children('.contenedor-items').eq(0);
        if($(elemento).css('display') == 'none'){
            $('.contenedor-items').slideUp(300);
            $('.contenedor-item').removeClass('item-selected');
            $(elemento).parent().addClass('item-selected');
        }
        $(elemento).slideToggle(300);
    })

    $('.contenedor-btn-menu a').click(function () {
        $('#contenedor-menu').toggleClass('hidden-sm hidden-xs');
    })

    //CLASES PARA INGRESO DE NUMEROS
    cargarClasesNumeros();
})

/**
 * Funcion para mostrar las alertas del sistema
 * @param id_contenedor => contenedor de las alertas
 * @param tipo => info - success - warning - danger
 * @param data => array con la información
 * @param duracion => duracion en segundos
 * @param id_contenedor_scroll => id del contenedor que posee el scroll que debe quedar en top = 0
 */
function abrirAlerta(id_contenedor,tipo, data, duracion = null,id_contenedor_scroll = false){
    var html = "";
    $.each(data, function(key,value){
        html += "• "+value+"<br/>";
    });
    $("#"+id_contenedor+" .alert").addClass("hide");
    $("#"+id_contenedor+" .alert-"+tipo+" .mensaje").html(html);
    $("#"+id_contenedor+" .alert-"+tipo).removeClass("hide");

    if(duracion != null && $.isNumeric(duracion)){
        setTimeout(function () {
            $("#"+id_contenedor+" .alert-"+tipo).addClass("hide");
        },(duracion*1000));
    }

    if(id_contenedor_scroll != false)
        $("#"+id_contenedor_scroll).stop().animate({scrollTop:0}, '5000', 'swing');
}

/**
 * Abre dialog de bloqueo de pantalla
 * Debe incluir framework de diseñño MATERIALIZECSS o las clases de color contenidas en él
 *
 * @param mensaje => mensaje a mostrar, si se pasa el valor undefined muestra el mensaje por defecto
 * @param load => si debe mostrar icono de carga o no
 */
function abrirBlockUiCargando(mensaje = "Cargando",load = true) {
    var html = '<img src="'+$('#general_url').val()+'/imagenes/sistema/logo.png" style="width: 100px !important;" /><h4 class="white-text">'+mensaje;
    if(load)
        html += ' <i class="fa fa-spin fa-circle-o-notch white-text"></i>';
    html += '</h4>';
    $.blockUI({ message: html });
}


function cerrarBlockUiCargando() {
    $.unblockUI();
}


function abrirBlockUiElemento(elemento, mensaje = "Cargando",load = true) {
    var html = '<h4 class="white-text">'+mensaje;
    if(load)
        html += ' <i class="fa fa-spin fa-circle-o-notch white-text"></i>';
    html += '</h4>';
    $(elemento).block({ message: html });
}

function cerrarBlockUiElemento(elemento) {
    $(elemento).unblock();
}

function cargarClasesNumeros() {
    $(".num-int-positivo").numericInput({ allowNegative: false,allowFloat: false});
    $(".num-int").numericInput({ allowNegative: true,allowFloat: false});
    $(".num-float-positivo").numericInput({ allowNegative: false,allowFloat: true});
    $(".num-float").numericInput({ allowNegative: true,allowFloat: true});
}