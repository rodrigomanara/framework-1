<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $css; ?>"/>
<form name="form-servico-lista">
    <div>
        <select size="3" style="width: 400px;height: 50px;" name="id_servico">
            <?php foreach ($lista as $item) { ?>
                <option value="<?php echo $item['id_servico']; ?>"><?php echo $item['nome']; ?> </option> 
            <?php } ?>
        </select>
    </div>
    <div>
        <input name="selecionar" value="Selecionar Produto" type="button">
    </div>
</form>
<script>
    $(document.body).ready(function() {

        $("input[name=selecionar]").click(function() {
            var data = $("form[name=form-servico-lista]").serialize();
            $.ajax({
                data: data,
                url: '<?php echo $url; ?>',
                type: 'post',
                dataType: 'json',
                success: function(e) {
                    $.each(e.dados, function(i, v) {
                        window.opener.$('input[name=servico]').val(v.nome);
                        window.opener.$('input[name=nome_do_servico]').val(v.nome);
                        window.opener.$('input[name=value]').val(v.valor);
                        window.opener.$('input[name=id_servico]').val(v.id_servico);
                    })
                    
                    window.close();
                }
            });
        });
    });
</script>