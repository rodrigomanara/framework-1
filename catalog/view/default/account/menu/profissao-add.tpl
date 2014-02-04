<div>
    <form name="add_profissao" method="post" autocomplete="off" id="add_profissao">
        <input name="id_role" value="0" type="hidden"/>
        <input name="input_token" value="<?php echo $token; ?>" type="hidden"/>
        
        <h3> Adicionar Novo Profissional </h3>
        <table>
            <tr>
                <td>Name</td>
                <td>Level</td>
            </tr>
            <tr>
                <td><input name="__name" type="text" value=""/></td>
                <td><input name="__level" type="text" value=""/></td>
            </tr>
            <tr>
                <td colspan="2"><input name="add_profissao" value="Adicionar"  type="button" style="width: 100%"/></td>
            </tr>
        </table>
    </form>
    <script>
        $(document.body).ready(function() {
            
            $("input[name=add_profissao]").click(function() {
                var data = $("#add_profissao").serialize();
                $.post('<?php echo $url; ?>', data, function(e) {
                    var json = jQuery.parseJSON(e);
                    if (json.success) {
                        var h = "Dados salvos com successo";
                        $('#add_profissao').html(h);
                    }

                });
            });
        });
    </script>
</div>