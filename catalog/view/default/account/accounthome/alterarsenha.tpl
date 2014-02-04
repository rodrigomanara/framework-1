<?php echo $header ; ?>
<div class="content">
    <div class="menu_lateral">
        <ul>
            <?php foreach($menu['menu']  as $menus){ ?>
            <li><a href="<?php echo $menus['href']; ?>" ><?php echo $menus['name']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
    <div class="form_desktop">
         <h4>Nova senha</h4>
        <form name="form">
            <input name="__rm-u" value="<?php echo $user_id ; ?>" type="hidden"/>
            <ul>
                <li>Alterar Senha</li>
                <li><input name="__rm-password" value="" /></li>
            </ul>
            <ul>
                <li>Confirmar Nova Senha</li>
                <li><input name="__rm-password2" value="" /></li>
            </ul>
            <ul>
                <li></li>
                <li><input name="send" value="Change Password" type="button"/></li>
            </ul>
        </form>
    </div>
    <div>

    </div>
</div>
<script>
    $("document.body").ready(function() {

        $("input[name=send]").click(function() {
            validation($('form[name=form]'), '<?php echo $form_url;?>');
        });
    });
</script>
<?php echo $bottom ; ?>