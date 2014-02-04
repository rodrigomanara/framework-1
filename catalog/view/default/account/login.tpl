<?php print($header) ; ?>
<div class="content">
    <div>
        <?php echo $newlogin ; ?>
    </div>
    <div class="login">
        <form name="form">
            <ul>
                <li>Accesso</li>
                <li><input name="__rm-login" value="" type="text" rel='login'></li>
            </ul>
            <ul>
                <li>Senha</li>
                <li><input name="__rm-pass" value="" type="password" rel='pass'></li>
            </ul>
            <ul>
                <li><?php echo $randon_image;?></li>
                <li><input name="__rm-span" value="" type="text" rel='randon'></li>
            </ul>
            <ul>
                <li></li>
                <li><input name="send" value="Login" type="button"></li>
            </ul>
        </form>
    </div>
</div>
<script>
    $("document.body").ready(function(){
        $("input[name=send]").click(function(){
            validation($('form[name=form]') , '<?php echo $form_url;?>');
        });
    });
</script>
<?php print($bottom) ; ?>