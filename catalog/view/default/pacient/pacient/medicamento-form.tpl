<link rel="stylesheet" href="<?php echo $css; ?>"/>
<style>
    form div{float: left; width: 250px; padding: 5px; margin: 2px;}
</style>
<div style="width: 100%">
    <form method="post">
        <input type="hidden" value="<?php echo $id_paciente; ?>" name="id_paciente"/>
        <input type="hidden" value="" name="id_med"/>
        <input type="hidden" value="" name="id_estoque"/>
        <input type="hidden" value="" name="lote"/>
        <input type="hidden" name="servico" value="">
       <div>
            <label><h4>Nome do Rem&eacute;dio</h4></label>
            <input type="" name="nome_do_remedio" value="" rel="req">
            <label><h4>Valor </h4></label>
            <input name="value" value="">
            <label><h4>Dosagem </h4></label>
            <input name="dosagem" value="">
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
            <label><h4>Forma de Uso </h4></label>
            <textarea name="prescricao"></textarea>
        </div>

        <div>
            <label> <h4>Gravar Medicamento</h4></label>
            <input type="button" value="Gravar" name="button"/>
        </div>
    </form>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo $home; ?>/catalog/view/default/JS/jquery.maskMoney.js" ></script>
<script src="<?php echo $js;?>js-default.js"></script>
<script>
    $(document.ready).ready(function() {
        
        $('input[name=nome_do_remedio]').click(function(){
            window.open('<?php echo $home; ?>/pacient/home/medicamentoFormLista' , 'medicamento' , 'width=450,height=200')
        });
        $('input[name=nome_do_remedio]').keypress(function(){
            window.open('<?php echo $home; ?>/pacient/home/medicamentoFormLista' , 'medicamento' , 'width=450,height=200')
        });
    
        $('input[name=value] , input[name=totalpago]').maskMoney();
        $("input[name=button]").click(function() {
            var data = $('form').serialize();
            $.ajax({
                url: '<?php echo $url; ?>',
                data: data,
                dataType: 'json',
                type: 'post',
                beforeSend:function(){
                    return valida($('form'));
                },
                success: function(e) {
                    if (e.success) {
                        parent.jQuery.colorbox.close();
                    }
                }
            })
        });
    });
</script>