<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta name="robots" content="noindex">
            <meta http-equiv="X-UA-Compatible" content='IE=edge,chrome=1'/>
            <base href="http://<?php echo $server; ?>" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Messina Clinic ::  Seja Bem Vindo ao Clinic Service Online</title>
            <link href="./catalog/view/default/CSS/style.css" rel=stylesheet />
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
            <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
            <script type="text/javascript" src="./catalog/view/default/JS/js-default.js"></script>
    </head>
    <body>
        <div class="framecontent">
            <div class="logo">&nbsp;</div>
            <div class="user_string"><span class="user"><?php echo $bem_vindo; ?></span></div>
            <div class='menu'> 
                <ul>
                    <?php
                    $i = 0;
                    foreach ($menu as $menus) {
                        ?>
                        <li>
                            <?php if ((int) $menu[$i]['level'] <= (int) $level['level']) { ?>  <a href="<?php echo $menu[$i]['href']; ?>"><?php echo $menu[$i]['name']; ?></a> <?php } ?> 
                        </li>
                        <?php $i++;
                    } ?>
                </ul>
            </div>
            <div class="content"> 
