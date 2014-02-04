<div>
    <form name="__add_level">
        <input name="input_form" value="__add_level" type="hidden"/>
        <input name="input_token" value="<?php echo $token; ?>" type="hidden"/>
        <h3> Adicionar </h3>
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
                <td colspan="2"><input name="__send_add_level" value="Add New Menu/Access Level"  type="button" style="width: 100%"/></td>
            </tr>
        </table>
    </form>
    <script>
        $(document.body).ready(function(){
            var data = $("form[name=__add_level]").serialize();
            $.post('<?php echo url;?>' , data , function(){
                
            });
        });
    </script>
</div>