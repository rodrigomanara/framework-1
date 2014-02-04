<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Estoque / Adicionar novo Produto no Estoque</div>
    <div class="clear">&nbsp;</div>
    <form autocomplete="off" name="form-add-produto" action="" method="post">
        <input name="id_estoque" value="0" type="hidden"/>
        <div style="width: 650px;">
            <div class="search-box">
                <label>Titulo</label>
                <input name="nome" value="" type="" maxlength="60" rel="req"/>
            </div>
            <div class="search-box">
                <label>Quantidade</label>
                <input name="quantidade" value="" type="" min="2" maxlength="11" rel="req"/>
            </div>
            <div class="search-box">
                <label>Codigo de Barra</label>
                <input name="barcode" value="" type="text" min="8" maxlength="14" rel="req"/>
            </div>
            <div class="search-box">
                <label>Data de Validade</label>
                <input name="data" value="" type="text" rel="req"/>
            </div>
            <div class="search-box">
                <label>Valor Unit&aacute;rio</label>
                <input name="valor-unitario" value="" type="text" rel="req"/>
            </div>
            
            <div class="search-box">
                <label>Lote de Fab.</label>
                <input name="lote" value="" type="text" rel="req"/>
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
                <input name="add-produto" value="Adicionar Novo Produto" type="button"/>
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
        $("input[name=add-produto]").click(function() {
            var url = $('form[name=form-add-produto]').attr('action');
            if(enviar_valida($('form[name=form-add-produto]'), url) === true){
                setTimeout(redirect('<?php echo $url_home;?>') , 3000);
            }
        });
    });
</script>
<?php echo $bottom ?>