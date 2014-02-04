<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Financeiro</div>
    <div class="title-box">
        <div class="clear"></div>
    </div>
    <div class="search-box-main">
        <form name="form-paciente-busca" action="<?php echo $url; ?>" method="post">
            <div class="search-box">
                <label>Data Min</label>
                <input value="" name="data-min" type="text"/>
            </div>
            <div class="search-box">
                <label>Data Max</label>
                <input value="" name="data-max" type="text"/>
            </div>
            <div class="search-box">
                <label>&nbsp;</label>
                <input value="Procurar" name="" id="procura" type="button" onclick="procuraDados()"/>
            </div>
        </form>
        <div class="clear">&nbsp;</div>
    </div>
    <div id="retorno" class="list-item-holder"></div>
</div>
<script src="./catalog/view/default/JS/pagination/jquery.simplePagination.js"></script>
<link href="./catalog/view/default/JS/pagination/simplePagination.css" rel="stylesheet"/>
<script type="text/javascript">
    
function EnviarPara(url) {
    var id = $('input[name=id_paciente]:checked').val();

    var patt3 = new RegExp('/del/');
    var patt = new RegExp('/edit/');
    var patt4 = new RegExp('/agendamento/');
    var patt2 = new RegExp('[0-9]');

    if (patt.test(url) && patt2.test(id) || patt4.test(url) && patt2.test(id)) {
        var http_url = url + '&id_paciente=' + id;
        redirect(http_url);

    } else if (patt3.test(url) && patt2.test(id)) {

        var str = id.split('_');
        var data = '&id_paciente=' + id;
        ;

        $.ajax({
            data: data,
            url: url,
            type: 'post',
            dataType: 'json',
            beforeSend: function() {
                var x = confirm('Tem Certeza,Deseja realmente apagar este Paciente!');
                if (x !== true)
                    return false;

            },
            success: function() {
                procuraDados();
            }
        });
    } else {

        if (patt.test(url) || patt3.test(url)) {
            alert('Por Favor, Selecione um Paciente');
        }
    }
    var patt = new RegExp('/add/');
    if (patt.test(url)) {
        redirect(url);
    }

}
$(document.ready).ready(function() {
    $('#retorno').html('<div class="info">N&atilde;o h&aacute; dados dispon&iacute;veis. Fa&ccedil;a uma nova Pesquisa.</div>');

    $(window).on('hashchange', function() {
        procuraDados();
    }); 
    
    $("input[name=data-min] , input[name=data-max]").datepicker({
        changeYear: true
                , yearRange: "<?php echo date('Y') - 5; ?>:<?php echo date('Y') + 1; ?>"
                , changeMonth: true
                , dateFormat: 'dd-mm-yy'
    });

});

function procuraDados() {
    var div = ('<div class="info">N&atilde;o h&aacute; dados dispon&iacute;veis. Fa&ccedil;a uma nova Pesquisa.</div>');
    var form = $('form[name=form-paciente-busca]');
    var html = '';
    $.ajax({
        url: $(form).attr('action'),
        data: $(form).serialize(),
        dataType: 'json',
        type: $(form).attr('method'),
        beforeSend: function() {
            html = '<div class="list">';
            html += '<div> loading ... </div>';
            html += '</div>';
            $("#retorno").html(html);
            html = '';
        },
        success: function(e) {

            var total = e.dados.length;
            var calc = e.total_pago;
            var devedor = e.total_devedor;

             
            html += '<div class="list">';
            html += '<div class="relatorio-topo"> Total de registro Consultados:<span>' + total + '</span></div>';
            html += '<div class="relatorio-topo"> Total Pago:<span id="total"></span></div>';
            html += '<div class="relatorio-topo"> Total a serem Pagos:<span id="devedor"></span></div>';
            html += '</div>';

            
                //servico , value , metodo , quantidade , totalpago
            html += '<div class="list">';
            html += '<div class="list-item-titulo">Tipo de Serviç/ Produto</div>';
            html += '<div class="list-item-titulo">Valor(£)</div>';
            html += '<div class="list-item-titulo">Metodo de Pagamento</div>';
            html += '<div class="list-item-titulo">Quantidade de produtos/ Servico Prestados</div>';
            html += '<div class="list-item-titulo">Total Pago</div>';
            html += '<div class="list-item-titulo">Total Devedor</div>';
            html += '</div>';

            var check_me = true;
            var limit = 10;
            var url_hash = window.location.hash;
            var str = url_hash.split('_');
            var number = (str[1] > 1) ? str[1] : 0;

            var start = number > 1 ? (number - 1) * limit : number;
            var end = number > 1 ?
                    (number * limit) >= total ? total : (number * limit) // parte 1
                    : (limit > total) ? total : limit;
                    
             
             
             
            for (var i = start; i < end; i++) {
                //servico , value , metodo , quantidade , totalpago
                html += '<div class="list">';
                /*
                html += '<div class="list-item">&nbsp;';
                html += '<input name="id_paciente" id="' + e.dados[i].id_paciente + '" value="' + e.dados[i].id_paciente + '" type="radio"/>';
                html += '<label for="' + e.dados[i].id_paciente + '"></label>';
                html += '</div>';
                */
                html += '<div class="list-item">&nbsp;' + e.dados[i].servico + '</div>';
                html += '<div class="list-item">&nbsp;' + e.dados[i].value + '</div>';
                html += '<div class="list-item">&nbsp;' + e.dados[i].metodo + '</div>';
                html += '<div class="list-item">&nbsp;' + e.dados[i].quantidade + '</div>';
                html += '<div class="list-item">&nbsp;' + e.dados[i].totalpago + '</div>';
                html += '<div class="list-item">&nbsp;' + (e.dados[i].value - e.dados[i].totalpago) + '</div>';
                html += '</div>';
                check_me = false;
            }

            if (check_me === false) {

                html += '<div class="clear">&nbsp;</div><div class="list"><div id="pagination" ></div></div>';
                $("#retorno").html(html);

                $("#pagination").pagination({
                    items: total,
                    itemsOnPage: 10,
                    currentPage: (number > 1 ? number : 1),
                    cssStyle: 'light-theme',
                    hrefTextPrefix: '<?php echo $url; ?>#_'
                });
                
                $("#total").html(calc);
                $("#devedor").html(devedor);
                
                
            } else {
                $("#retorno").html(div);
            }
        }
    });
}



</script>
<?php echo $bottom; ?>
