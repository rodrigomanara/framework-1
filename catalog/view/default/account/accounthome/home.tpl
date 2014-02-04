<?php echo $header ; ?> 
    <div class="menu_lateral">
        <ul>
        <?php foreach($menu['menu']  as $menus){ ?>
            <li><a href="<?php echo $menus['href']; ?>" ><?php echo $menus['name']; ?></a></li>
        <?php } ?>
        </ul>
    </div>
    <div class="form_desktop">
       
    </div>
    <div>
       
    </div> 
<?php echo $bottom ; ?>