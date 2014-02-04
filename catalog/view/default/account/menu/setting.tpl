<?php echo $header; ?>

<div class="menu_lateral">

    <ul>
        <?php foreach ($menu as $menus) { ?>
            <?php foreach ($menus as $menuss) { ?>
                <li> <a href="<?php echo $menuss['href']; ?>"><?php echo $menuss['name']; ?></a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div> 

<script>
    $(function() {
        $("#tabs").tabs();
    });
</script>
<div class="desktop">
    <div class="settings-rules">
        <p>Regras do Sistema nivel menor que 10 sera funcionario </p>
        <p>Regras do Sistema nivel Maior que 10 e menor que 20 sera Medico </p>
        <p>Regras do Sistema nivel Maior que 20 e menor que 30 sera Administradores do Sistema </p>
    </div>
    <div id="tabs">
        <ul>
            <li><a href="./account/menu/add#tabs-1">Add New Menu</a></li>
            <li><a href="./account/menu/edit#tabs-2">Edit Menu</a></li> 
            <li><a href="./account/menu/addlevel#tabs-5"> Add Menu Level</a></li>
            <li><a href="./account/menu/editlevel#tabs-6"> Edit Menu Level</a></li>
            <li><a href="./account/menu/addProfissao#tabs-3">Adicionar Nova Profissao</a></li>
            <li><a href="./account/menu/editProfissao#tabs-4">Edit Nova Profissao</a></li>

        </ul>
        <div id="tabs-1"></div>
        <div id="tabs-2"></div>
        <div id="tabs-3"></div>
        <div id="tabs-4"></div>
        <div id="tabs-5"></div>
        <div id="tabs-6"></div>
    </div>
</div>
<script type="text/javascript">
    $(document.body).ready(function() {


        $("input[name=__send_add_level]").click(function() {
            var data = $("form[name=__add_level]").serialize();
            $.ajax({
                type: 'POST',
                data: data,
                dataType: 'json',
                url: '<?php echo $url; ?>',
                success: function() {
                    if (e.success == true) {
                        var div = $("#tabs-3").html();
                        $("#tabs-3").html(form);
                        setTimeout(returnTO("#tabs-3", div), 3000);
                    }
                }
            });
        })
    });
    function returnTO(e, d) {
        $(e).html(d);
    }
</script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php echo $bottom; ?>