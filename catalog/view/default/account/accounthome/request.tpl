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
        <form name="form">
            
            <ul>
                <li>Nome</li>
                <li><input name="__rm-name" value="" rel="name"/></li>
            </ul>

            <ul>
                <li>Email</li>
                <li><input name="__rm-email" value="" type="text" rel="email"/></li>
            </ul>

            <ul>
                <li>Senha</li>
                <li><input name="__rm-pass" value="" type="password" rel="pass"/></li>
            </ul>
            <ul>
                <li><?php echo $randon_image;?></li>
                <li><input name="__rm-span" value="" type="text" rel="randon"/></li>
            </ul>
            <ul>
                <li></li>
                <li><input name="__rm-sing-in" value="sing-in" type="button" /></li>
            </ul>
        </form>
    </div>
    <div id="return"></div>
</div>
<script>
    $("document.body").ready(function() {
        $("input[name=__rm-sing-in]").click(function() {
           validation($('form[name=form]') , '<?php echo $form_url;?>');
        });

    });
</script>    
<?php echo $bottom; ?>