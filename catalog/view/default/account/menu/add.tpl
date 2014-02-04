<div id="add">    
    <h3> Add New Menu</h3>
    <form name="add_menu" action="../" method="post" autocomplete="off">
        <input name="input_form" value="__add" type="hidden"/>
        <input name="input_token" value="<?php echo $token; ?>" type="hidden"/>
        <table>
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
                            <?php foreach ($level_list as  $level){ ?>
                                <option value="<?php echo $level['level'] ; ?>"><?php echo $level['name'] ; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="2"><input name="add_menu_buttom" value="Add New Menu"  type="button"/></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript">
    $(document.body).ready(function() {
        var form = "Dados salvos corretamente !";
        $("input[name=add_menu_buttom]").click(function() {
            var data = $("form[name=add_menu]").serialize();
            $.ajax({
                type: 'POST',
                data: data,
                dataType: 'json',
                url: '<?php echo $url; ?>',
                success: function(e) {
                    if (e.success == true) {
                        var div = $("#add").html();
                        $("#add").html(form);
                        setTimeout(returnTO("#add", div), 3000);
                    }
                }
            });
        });
    });
</script>