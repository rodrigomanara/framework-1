/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/** justo com php  return json */
/**
 * 
 * @param {type} form
 * @param {type} url
 * @returns {undefined}
 */
function validation(form, url) {
    //var $ = jQuery;
    var data = $(form).serialize();

    $.ajax({
        url: url,
        data: data,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
            $("form").fadeTo("slow", 0.33);
        },
        success: function(e) {
            $("form").fadeTo("slow", 1);
            if (e.error !== undefined && e.error === true) {
                var div = "<div class='error' id='after_for'>" + e.info + "</div>";

                if ($("#after_for").length < 1) {
                    $("form").after(div);
                } else {
                    $("#after_for").html(e.info);
                }
            } else {
                $.each(e, function(i, value) {

                    $('#' + i).length < 1 && value != true
                            ? $('input[name=' + i + ']').after('<div class="error" id="' + i + '">' + value + '</div>').fadeIn('slow')
                            : $('#' + i).length > 0 && value == true
                            ? $('#' + i).remove().fadeOut()
                            : $('#' + i).length > 0 && value != true
                            ? $('#' + i).remove().fadeOut() && $('input[name=' + i + ']').after('<div class="error" id="' + i + '">' + value + '</div>').fadeIn('slow') : '';
                });
            }
            if (undefined !== e.url) {
                window.location = e.url;
            }
            if (undefined !== e.already_exist) {
                alert('Dados já existentes no Banco de Dados, Verifique CFP e RG');
            }
        }
    });
}

/***
 * 
 * @param {type} form
 * @returns {Boolean}
 */

function valida(form) {
    var stop = false;

    $(form).fadeTo("slow", 0.33);

    $(":input").each(function(index) {
        if ($(this).val() === "" && $(this).attr('rel') === 'req') {

            if ($('#' + index).length < 1)
                $(this).before('<div id="' + index + '" class="error">por favor verifique o valor</div>');
            stop = true;
        } else if ($('#' + index).length === 1 && $(this).val() !== "") {
            $('#' + index).html('ok');
        }
    });
    $("form").fadeTo("slow", 1);


    if (stop === true)
        return false;
    else
        return true;
}

/**
 * 
 * @param {type} elemento
 * @param {type} url
 * @returns {string}
 */
function enviar_valida(elemento, url) {

    var data = $(elemento).serialize();
    var retorno = null;
    $.ajax({
        url: url,
        data: data,
        type: 'post',
        dataType: 'json',
        beforeSend: function() {
            retorno = valida(elemento);
        },
        success: function(e) {
            retorno = e.success;
        }
    });
    return retorno;
}

/**
 * 
 * @param {type} id
 * @param {type} text
 * @returns {undefined}
 */
function permission(id, text) {
    $(id).html(text)
}
/**
 * 
 * @param {type} birthMonth
 * @param {type} birthDay
 * @param {type} birthYear
 * @returns {todayYear}
 */
function calculateAge(birthMonth, birthDay, birthYear) {
    todayDate = new Date();
    todayYear = todayDate.getFullYear();
    todayMonth = todayDate.getMonth();
    todayDay = todayDate.getDate();
    age = todayYear - birthYear;

    if (todayMonth < birthMonth - 1) {
        age--;
    }

    if (birthMonth - 1 == todayMonth && todayDay < birthDay) {
        age--;
    }
    return age;
}

/**
 * 
 * @param {type} content
 * @returns {undefined}
 */
function writeConsole(content) {
    var w = window.open();
    w.document.writeln(content);
}

/**
 * 
 */
$(document.body).ready(function() {
    $("span").click(function() {

        var str = $(this).attr('id');
        var id = str.split("-");
        $("#ficha-view-" + id[1]).fadeIn();
    });
    $("span").dblclick(function() {

        var str = $(this).attr('id');
        var id = str.split("-");
        $("#ficha-view-" + id[1]).fadeOut();
    });

});

/**
 * @see  Soment utilizado para fazer busca justmente com qualquer tipo de sistema...
 * @param {type} element
 * @returns json
 * @function busca_formularion
 */
function busca_formulario(element) {
    var url = $(element).attr('action');
    var data = $(element).serialize();
    var method = $(element).attr('method');
    var json = null;

    $.ajax({
        url: url,
        data: data,
        type: method,
        dataType: 'json',
        success: function(e) {
            return e;
        }
    });
}


/**
 * 
 * @param {type} url
 * @returns {undefined}
 */
function redirect(url) {
    window.location = url;
}

/**
 * 
 * @returns {undefined}
 * 
 * save form
 */

$(function() {
    $.fn.salvarFormulario = function(form, url) {
        var data = $(form).serialize();
        $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            type: 'post',
            beforeSend: function() {
                return valida("form[name=form]");
            },
            success: function(e) {
                if (e.success) {
                    $("#tab-1").html('...Salvo');
                    $("#tab-2").html('...Salvo');
                    $("#tab-3").html('...Salvo');
                    setTimeut(redirect(e.url), 4000);
                }
            }
        });
    }
});

/*
 * 
 * @param {type} page_index
 * @param {type} jq
 * @returns {Boolean}
 * 
 */


