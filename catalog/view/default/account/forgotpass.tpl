<?php print($header) ; ?>
    <div class="info"> info: Sera enviado a senha para a sua conta de email.</div>
    <div class="login">
        <form name="form">
            <ul>
                <li>email</li>
                <li><input name="__rm-email" value=""  rel="email"></li>
            </ul>
           
            <ul>
                <li><?php echo $randon_image;?></li>
                <li><input name="__rm-span" value=""></li>
            </ul>
            <ul>
                <li></li>
                <li><input name="send" value="Login" type="button"></li>
            </ul>
        </form>
    </div> 
<script>
    $("document.body").ready(function(){

        $("input[name=send]").click(function(){
            validation($('form[name=form]') , '<?php echo $form_url;?>');
        });
    });
</script>
<?php print($bottom) ; ?>