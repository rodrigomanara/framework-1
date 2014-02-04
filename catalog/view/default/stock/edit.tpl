<?php echo $header; ?>
<?php echo $menu; ?>
<div class="desktop">
    <div class="clear">&nbsp;</div>
    <div class="title">Gerenciamento de Estoque / Editar Produto no Estoque</div>
    <div class="clear">&nbsp;</div>
    <form autocomplete="off" name="form-edit-produto" action="" method="post">
        <?php foreach($dados as $dado){ ?>
        <input name="id_estoque" value="<?php echo $dado['id_estoque'];?>" type="hidden"/>
        <input name="lote" value="<?php echo $dado['lote'];?>" type="hidden" />
        <div style="width: 650px;">
            <div class="search-box">
                <label>Titulo</label>
                <input name="nome" value="<?php echo $dado['nome'];?>" type="" maxlength="60" rel="req"/>
            </div>
            <div class="search-box">
                <label>Quantidade</label>
                <input name="quantidade" value="<?php echo $dado['quantidade'];?>" type="number" min="2" maxlength="11" rel="req"/>
            </div>
            <div class="search-box">
                <label>Codigo de Barra</label>
                <input name="barcode" value="<?php echo $dado['barcode'];?>" type="text" min="8" maxlength="14" rel="req"/>
            </div>
            <div class="search-box">
                <label>Data de Validade</label>
                <?php $data = explode("/", $dado['data']);
                $month = strlen($data[1]) > 1 ? $data[1] : "0".$data[1] ;
                $date = $data[0] . "/" . $month . "/" . $data[2];
                    
                ?>      
                <input name="data" value="<?php echo $date;?>" type="test" rel="req"/>
            </div>
            <div class="search-box">
                <label>Valor Unit&aacute;rio</label>
                <input name="valor-unitario" value="<?php echo $dado['valor'];?>" type="text" rel="req"/>
            </div>
            
            <div class="search-box">
                <label>Lote de Fab.</label>
                <input name="" value="<?php echo $dado['lote'];?>" type="text" disabled="yes" rel="req"/>
                
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
                <input name="edit-produto" value="Editar Produto" type="button"/>
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
        $("input[name=edit-produto]").click(function() {
            var url = $('form[name=form-edit-produto]').attr('action');
            if(!enviar_valida($('form[name=form-edit-produto]'), url)){
                setTimeout(redirect('<?php echo $url_home ;?>') , 3000);
            }
        });
    });
</script>
<?php echo $bottom ?>