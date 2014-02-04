<div id="id">    
    <h3> Edit or Delete Menu</h3>
    <form name="edit_menu_form"  method="post" autocomplete="off">
        <input name="input_form" value="__edit" type="hidden"/>
        <input name="input_token" value="<?php echo $token; ?>" type="hidden"/>
        
        <table>
            <thead>
                <tr>
                    <td colspan="2">
                        <select name="id_menu">
                            <option value="0">All</option>
                            <?php foreach ($menu_list as $list) { ?>
                                <option value="<?php echo $list['id_menu']; ?>"><?php echo $list['name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Parent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input name="__name" value=""  type="text" /></td>
                    <td><input name="__parent" value=""  type="text" /></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th colspan="2">Url</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><input name="__url" value=""  type="text"/></td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="2">
                        <select name="__level">
                            <option>...</option>
                            <?php foreach ($level_list as $level) { ?>
                                <option value="<?php echo $level['level']; ?>"><?php echo $level['name']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td ><input name="edit_menu_buttom" value="Edit Menu"  type="button"/></td>
                    <td ><input name="delete_menu_buttom" value="Delete Menu"  type="button"/></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script>
    $(document.ready).ready(function() {
        var form = "Dados salvos corretamente !";
        $("select[name=id_menu]").change(function() {
            var dados = ''
            dados += $('form[name=edit_menu_form]').serialize();
            dados += '&action=select';

            $.ajax({
                type: 'POST',
                data: dados,
                dataType: 'json',
                url: '<?php echo $url; ?>',
                beforeSend: function() {
                    $("#id").fadeTo("slow", 0.33);
                },
                success: function(e) {
                    $.each(e, function(i, v) {
                        $('input[name=__' + i + ']').val(v);
                    });
                    $("#id").fadeTo("slow", 1);
                }
            });
        });
        $('input[name=edit_menu_buttom]').click(function() {
            var dados = ''
            dados += $('form[name=edit_menu_form]').serialize();
            dados += '&action=update';

            $.post('<?php echo $url; ?>', dados, function(e) {
                var json = jQuery.parseJSON(e);
                
            });
        })

        $('input[name=delete_menu_buttom]').click(function() {
            var dados = ''
            dados = $('form[name=edit_menu_form]').serialize();
            dados += '&action=delete';

            $.post('<?php echo $url; ?>', dados, function(e) {
                var json = jQuery.parseJSON(e);
                
            });
        });
    });
</script>