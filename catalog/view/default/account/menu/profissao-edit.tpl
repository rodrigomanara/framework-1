<div>
    <form name="edit_profissao" method="post" autocomplete="off" id="edit_profissao">
        <input name="id_role" value="0" type="hidden"/>
        <input name="input_form" value="__add_level" type="hidden"/>
        <input name="input_token" value="<?php echo $token; ?>" type="hidden"/>
        <h3> Editar Novo Profissional </h3>
        <table>
            <tr>
                <td colspan="2">
                    <select name="lista_profissao" id="lista_profissao">
                        <option value="0">...</option>    
                        <?php foreach ($profissao as $profissoes) { ?>
                            <option value="<?php echo $profissoes['id_role']; ?>"><?php echo $profissoes['name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Name</td>
                <td>Level</td>
            </tr>
            <tr>
                <td><input name="__name" type="text" value=""/></td>
                <td><input name="__level" type="text" value=""/></td>
            </tr>
            <tr>
                <td><input name="button_profissao" value="Editar"  type="button" style="width: 100%"/></td>
                <td><input name="button_delete_profissao" value="Deletar"  type="button" style="width: 100%"/></td>    
            </tr>
        </table>
    </form>
    <script>
        $(document.body).ready(function() {

            $('#lista_profissao').change(function() {
                var id = $(this).val();
                $.ajax({
                    data: '&id=' + id,
                    url: '<?php echo $url; ?>',
                    dataType: 'json',
                    type: 'get',
                    success: function(json) {

                        $('input[name=__name]').val(json.name);
                        $('input[name=__level]').val(json.level);
                        $('input[name=id_role]').val(json.id_role);
                    }
                });
            });
            $('input[name=button_profissao]').click(function() {
                var data = $("#edit_profissao").serialize();
                $.post('<?php echo $url; ?>', data, function(e) {
                    var json = jQuery.parseJSON(e);
                    if (json.success) {
                        var h = "Dados salvos com successo";
                        $('#edit_profissao').html(h);
                    }
                });
            });
            
            $('input[name=button_delete_profissao]').click(function() {
                var data = $("#edit_profissao").serialize();
                data += '&del=yes';
                $.post('<?php echo $url; ?>', data, function(e) {
                    var json = jQuery.parseJSON(e);
                    if (json.success) {
                        var h = "Dados salvos com successo";
                        $('#edit_profissao').html(h);
                    }
                });
            });
        });
    </script>
</div>