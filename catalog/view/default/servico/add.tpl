<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Serviços / Adicionar novo Serviço</div>
    <div class="clear">&nbsp;</div>
    <form autocomplete="off" name="form-add-servico" action="" method="post">
        <input name="id_servico" value="0" type="hidden"/>
        <div style="width: 650px;">
            <div class="search-box">
                <label>Titulo</label>
                <input name="nome" value="" type="" maxlength="60" rel="req"/>
            </div>
            <div class="search-box">
                <label>Valor Unit&aacute;rio</label>
                <input name="valor-unitario" value="" type="text" rel="req"/>
            </div>
            
            <div class="search-box">
                <label>&nbsp;</label>
                <label>&nbsp;</label>
            </div>
            <div class="search-box">
                <label>&nbsp;</label>
                <label>&nbsp;</label>
            </div>
            <div class="search-box">
                <label>Descriç&atilde;o</label>
                <textarea name="descricao" value="" style="width: 250px;" maxlength="400"></textarea>
            </div>
            <div class="search-box">
                <label>&nbsp;</label>
                <input name="add-servico" value="Adicionar Novo Serviço" type="button"/>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="./catalog/view/default/JS/jquery.maskMoney.js" ></script>
<script type="text/javascript" src="./catalog/view/default/JS/mask.input.js"></script>
<script>
    $(document.body).ready(function() {
        $('input[name=valor-unitario]').maskMoney();
        $("input[name=data]").mask("99/99/9999");
        $("input[name=add-servico]").click(function() {
            var url = $('form[name=form-add-servico]').attr('action');
            var valida = enviar_valida($('form[name=form-add-servico]'), url);
            
            if(valida === true){
                setTimeout(redirect('<?php echo $url_home;?>') , 3000);
            }
        });
    });
</script>
<?php echo $bottom ?>