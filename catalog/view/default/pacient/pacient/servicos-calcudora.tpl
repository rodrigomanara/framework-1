<link rel="stylesheet" href="<?php echo $css; ?>"/>
<style>
    form div{float: left; width: 250px; padding: 5px; margin: 2px;}
</style>
<div style="width: 100%">
    <form method="post">
        <input type="hidden" value="<?php echo $id_paciente; ?>" name="id_paciente"/>
        <input type="hidden" value="" name="id_fin"/>
        <input type="hidden" value="" name="servico"/>
        <input type="hidden" value="" name="id_servico"/>
        <div>
            <label><h4>Nome do Servico Serviço </h4></label>
            <input name="nome_do_servico" value="" >
            <label><h4>Valor </h4></label>
            <input name="value" value="">
        </div>
        <div>
            <h4>Metodo de Pagamento </h4>
            <p>
            <input name="metodo" id="dinheiro" type="radio" value="dinheiro" checked="true">
            <label for="dinheiro"> &nbsp;&nbsp;&nbsp;Dinheiro </label>
            </p>
            <p>
            <input name="metodo" id="cartao" type="radio" value="cartao">
            <label for="cartao">&nbsp;&nbsp;&nbsp;Cart&atilde;o </label>
            </p>
            <label><h4>Quantidade </h4></label>
            <input name="quantidade" value="1">
            <label><h4>Total Pago </h4></label>
            <input name="totalpago" value="">
        </div>

        <div>

            <label> <h4>Adicionar Serviço</h4></label>
            <input type="button" value="Gravar" name="button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo $home; ?>/catalog/view/default/JS/jquery.maskMoney.js" ></script>
<script>
    $(document.ready).ready(function() {
        $('input[name=nome_do_servico]').click(function() {
            window.open('<?php echo $url_pop_up; ?>', 'servico', 'width=450,height=200')
        });
        $('input[name=nome_do_servico]').keypress(function() {
            window.open('<?php echo $url_pop_up; ?>', 'servico', 'width=450,height=200')
        });
        $('input[name=value] , input[name=totalpago]').maskMoney();
        $("input[name=button]").click(function() {
            var data = $('form').serialize();
            $.ajax({
                url: '<?php echo $url; ?>',
                data: data,
                dataType: 'json',
                type: 'post',
                success: function(e) {
                    if (e.success) {
                        parent.jQuery.colorbox.close();
                    }
                }
            })
        });
    });
</script>