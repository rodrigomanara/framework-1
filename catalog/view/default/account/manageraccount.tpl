<?php echo $header ; ?> 
    <div class="menu_lateral">
        <ul>
       <?php foreach($menu as $menus){ ?>
            <?php foreach($menus as $menuss){ ?>
            <li> <a href="<?php echo $menuss['href'];?>"><?php echo $menuss['name'];?></a></li>
            <?php } ?>
       <?php } ?>
       </ul>
    </div>
     
<?php echo $bottom ; ?>