<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Serviços / Editar Serviços</div>
    <div class="clear">&nbsp;</div>
    <form autocomplete="off" name="form-edit-servico" action="" method="post">
        <?php foreach($dados as $dado){ ?>
        <input name="id_servico" value="<?php echo $dado['id_servico'];?>" type="hidden"/>
        <div style="width: 650px;">
            <div class="search-box">
                <label>Titulo</label>
                <input name="nome" value="<?php echo $dado['nome'];?>" type="" maxlength="60" rel="req"/>
            </div>
            <div class="search-box">
                <label>Valor Unit&aacute;rio</label>
                <input name="valor-unitario" value="<?php echo $dado['valor'];?>" type="text" rel="req"/>
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
                <input name="edit-servico" value="Editar Produto" type="button"/>
            </div>
        <?php } ?>
        </div>
    </form>
</div>
<script type="text/javascript" src="./catalog/view/default/JS/jquery.maskMoney.js" ></script>
<script type="text/javascript" src="./catalog/view/default/JS/mask.input.js"></script>
<script>
    $(document.body).ready(function() {
        $('input[name=valor-unitario]').maskMoney();
        $("input[name=data]").mask("99/99/9999");
        $("input[name=edit-servico]").click(function() {
            var url = $('form[name=form-edit-servico]').attr('action');
            if(!enviar_valida($('form[name=form-edit-servico]'), url)){
                setTimeout(redirect('<?php echo $url_home ;?>') , 3000);
            }
        });
    });
</script>
<?php echo $bottom ?>