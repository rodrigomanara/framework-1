<div class="menu_lateral">
    <?php if (isset($menu['menu'])) { ?>
        <ul>
            <?php foreach ($menu['menu'] as $menus) { ?>
                <li><a href="<?php echo $menus['href']; ?>" ><?php echo $menus['name']; ?></a></li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <ul>
            <?php foreach ($menu as $menus) { ?>
                <li><a href="<?php echo $menus['url']; ?>" ><?php echo $menus['name']; ?></a></li>
            <?php } ?>
        </ul>

    <?php } ?>
</div>