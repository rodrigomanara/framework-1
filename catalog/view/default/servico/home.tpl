<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Serviços</div>
    <div class="title-box">
        <div class="clear"></div>
        <?php foreach ($option as $value) { ?>
            <input type="button" value="<?php echo $value['nome']; ?>" name="" onclick="EnviarPara('<?php echo $value['url']; ?>');"/>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="search-box-main">
        <form name="form-servico-busca" action="<?php echo $url; ?>" method="post">
            <div class="search-box">
                <label>Titulo</label>
                <input value="" name="titulo"/>
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
                var id = $('input[name=id_servico]:checked').val();

                var patt3 = new RegExp('/del/');
                var patt = new RegExp('/edit/');
              
                if (patt.test(url)) {
                    
                    var http_url = url + '&id_servico=' + id;
                    redirect(http_url);

                } else if (patt3.test(url)) {

                    var data = '&id_servico=' + id ;

                    $.ajax({
                        data: data,
                        url: url,
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            var x = confirm('Tem Certeza,Deseja realmente apagar este Serviço!');
                            if (x !== true)
                                return false;
                        },
                        success: function() {
                            procuraDados();
                        }
                    });
                } else {

                    if (patt.test(url) || patt3.test(url)) {
                        alert('Por Favor, Selecione um Serviço');
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

            });

            function procuraDados() {
                var div = ('<div class="info">N&atilde;o h&aacute; dados dispon&iacute;veis. Fa&ccedil;a uma nova Pesquisa.</div>');
                var form = $('form[name=form-servico-busca]');
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

                        html += '<div class="list">';
                        html += '<div class="relatorio-topo">Total de Producto:<span>' + total + '</span></div>';
                        html += '</div>';

                        html += '<div class="list">';
                        html += '<div class="list-item-titulo">&nbsp; Selecione</div>';
                        html += '<div class="list-item-titulo">&nbsp; Titulo</div>';
                        html += '<div class="list-item-titulo">&nbsp;Valor do Serviço</div>';
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

                            html += '<div class="list">';
                            html += '<div class="list-item">&nbsp;'; 
                            html += '<input name="id_servico" id="' +  e.dados[i].id_servico + '" value="' + e.dados[i].id_servico + '" type="radio"/>';
                            html += '<label for="' +  e.dados[i].id_servico + '"></label>';  
                            html += '</div>';
                           
    
                            html += '<div class="list-item">&nbsp;' + e.dados[i].nome + '</div>';
                            html += '<div class="list-item">&nbsp;' + e.dados[i].valor + '</div>';
                            html += '</div>';
                            check_me = false;
                        }

                        if (check_me === false) {

                            html += '<div class="clear">&nbsp;</div><div class="list"><div id="pagination"></div></div>';
                            $("#retorno").html(html);

                            $("#pagination").pagination({
                                items: total,
                                itemsOnPage: 10,
                                currentPage: (number > 1 ? number : 1),
                                cssStyle: 'light-theme',
                                hrefTextPrefix: '<?php echo $url; ?>#_'
                            });
                        } else {
                            $("#retorno").html(div);
                        }
                    }
                });
            }
    </script>
<?php echo $bottom; ?>
