<link rel="stylesheet" href="<?php echo $header_url; ?>/catalog/view/default/CSS/style.css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo $header_url; ?>/catalog/view/default/CSS/timepicker.css"/>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?php echo $header_url; ?>/catalog/view/default/JS/timepicker.js"></script>
<script src="<?php echo $header_url; ?>/catalog/view/default/JS/js-default.js"></script>

<script type="text/javascript">
    $(function() {
      

        $("#root").css({display: 'none'});
        $(window).load(function() {     
            $("#root").css({display: ''});
        });


        $("#tabs").tabs();
    });
</script>
<div id="root">
    <div id="tabs">
        <ul>
            <li><a href="#tab-1">Agendamento</a></li>   
        </ul>
        <div id='tab-1'>
             <?php echo $ficha_add_agendamentp; ?>
        </div>
         
    </div>

</div>
