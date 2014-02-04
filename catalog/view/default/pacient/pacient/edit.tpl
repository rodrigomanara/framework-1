<?php echo $header; ?>
<?php echo $menu; ?>
<div class="clear">&nbsp;</div>
<div class="title"> Gerenciamento de Pacientes / Ver & Editar Paciente :<b> <?php echo $dados['nome'];?></b></div>
<div class="top-button"><div id="gravar"><input name="save" type="button" value="atualizar"/></div></div>
<div class="desktop" id="root">
    <input name="id_paciente" value="<?php echo $id_paciente; ?>" type="hidden"/>
    <div id="tabs">
        <ul>
            <?php
            $i = 1;
            $divs = array();
            foreach ($menu_tab as $tab) {
                echo " <li><a href='{$tab['url']}$id#tab-{$i}'>{$tab['name']}</a></li>";
                array_push($divs, "<div id='tab-{$i}'> </div>");
                $i++;
            }
            ?>
        </ul>
        <?php
        foreach ($divs as $div) {
            echo $div;
        }
        ?>
        <div class="clear">&nbsp;</div>
    </div>

</div>
<script type="text/javascript">
    $('document.body').ready(function() {

        $('input[name=save]').click(function() {
            var reload = false;
            $.each($('form'), function(i, v) {
                var name = $(v).attr('name');
                var url = $(v).attr('action');
                var form_name = 'form[name=' + name + ']';
                reload = enviar_valida(form_name, url);
                
            });
            
           // window.location = '<?php echo $url;?>';
        });


        var unsaved = false;

        $(":input").change(function() { //trigers change in all input fields including text type
            unsaved = true;
        });

        function unloadPage() {
            if (unsaved) {
                return "Esta pagina teve alterecoes, por favor salve antes de sair.";
            }
        }

        window.onbeforeunload = unloadPage;
    });
    $(function() {
        $("#root").css({display: 'none'});
        $(window).load(function() {
            $("#root").css({display: ''});
        });
        /**
         * 
         */
        $("#tabs").tabs({
            beforeLoad: function(event, ui) {
                var id = ui.panel.index();

                var prev = $('#ui-tabs-' + id).children().size();

                if (prev >= 1)
                    return false;
                ui.jqXHR.error(function() {
                    ui.panel.html("Couldn't load this tab. We'll try to fix this as soon as possible. If this wouldn't be a demo.");
                });
            }
        });

    });
    /**
     * 
     * @returns {undefined}
     */

    $(function() {
        $("input[name=telephone]").mask("(99) 9999 999 9999");
        $("input[name=mobile]").mask("(99) 9999 999 9999");
        $("input[name=ppc_telefone]").mask("(99) 9999 999 9999");
        $("input[name=data_nascimento]").mask("99/99/9999");
        $("input[name=data_nascimento]").blur(function() {
            var data = $(this).val();
            var str = data.split("/");
            var dia = str[0];
            var mes = str[1];
            var ano = str[2];
            $("input[name=idade]").val(calculateAge(mes, dia, ano));

        });
        $("[id=cur]").formatCurrency({symbol: '£',
            positiveFormat: '%s%n',
            negativeFormat: '-%s%n',
            decimalSymbol: '.',
            digitGroupSymbol: ',',
            groupDigits: true
        }).on('blur', function() {
            $("[id=cur]").formatCurrency({
                symbol: '£',
                positiveFormat: '%s%n',
                negativeFormat: '-%s%n',
                decimalSymbol: '.',
                digitGroupSymbol: ',',
                groupDigits: true
            })
        });
    });

</script> 
<script type="text/javascript" src="./catalog/view/default/JS/mask.input.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script src="./catalog/view/default/JS/jquery.formatCurrency-1.4.0/jquery.formatCurrency-1.4.0.js"></script>
<script src="./catalog/view/default/JS/jquery.formatCurrency-1.4.0/i18n/jquery.formatCurrency.all.js"></script>
<?php echo $bottom; ?>