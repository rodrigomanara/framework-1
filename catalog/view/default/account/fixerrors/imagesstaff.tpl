<?php echo $header ;?>
<div class="content">
    <div class="menu_lateral">
        <ul>
            <?php foreach($menu as $menus){ ?>
            <?php foreach($menus as $menuss){ ?>
            <li> <a href="<?php echo $menuss['href'];?>"><?php echo $menuss['name'];?></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="form_desktop">
        <?php var_dump($files); ?>
    </div>
</div>
<?php echo $bottom ;?>