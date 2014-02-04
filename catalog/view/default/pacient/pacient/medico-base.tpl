<div style="width: 55%;float: left; margin: 5px;">
    <form name="form-nova-consulta" autocomplete="off" action="<?php echo $url_historical; ?>">
        <input name="id_paciente" value="<?php echo $id_paciente; ?>" type="hidden"/>
        <?php echo $adicionar ?>
    </form>
</div>
<div style="width: 40%;float: left; margin: 5px;">
    <h4> Follow Up + <span style="cursor: pointer" onclick="addForm();">Adicionar</span> </h4>
    <div id="add-novo-formulario" style="height: 350px;" id="atual"></div>
    <h4>Historical</h4>
    <div id="atual-h">
        <?php if(empty($historical_ficha)){?>
        <p>N&atilde;o h&aacute; dados dispon&iacute;veis</p>
        <?php }?>
        <?php foreach ($historical_ficha as $ficha) { ?>
            <h4>Data : <?php echo date('d-m-Y h:m:s', strtotime($ficha['data'])); ?></h4>
            <form name="form-follow-<?php echo $ficha['id_ficha'];?>" autocomplete="off" action="<?php echo $url_follow; ?>">
                <input name="id_ficha" value="<?php echo $ficha['id_ficha'];?>" type="hidden">
                <input name="id_paciente" value="<?php echo $ficha['id_paciente'];?>" type="hidden">
                <input name="data" value="<?php echo $ficha['data'];?>" type="hidden">
                <div>
                    <h5>Present Complaint (Queixa Principal)</h5>
                    <textarea name="dmp_queixa"><?php echo $ficha['dmp_queixa']; ?></textarea>
                    <h5>Follow Up</h5>
                    <textarea name="dmp_proxima_consulta"><?php echo $ficha['dmp_proxima_consulta']; ?></textarea>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<script>
        $(function() {
            $("[id^=atual]").accordion();
        });
        function addForm() {
            var form = '<form name="form-nova-consulta" autocomplete="off" action="<?php echo $url_follow; ?>">';
            form += '<input name="id_ficha" value="0" type="hidden"/>';
            form += '<input name="id_paciente" value="<?php echo $id_paciente; ?>" type="hidden"/>';
            form += '<div id="atual-A">';
            form += '<h5>Present Complaint (Queixa Principal) </h5>';
            form += '<textarea name="dmp_queixa"></textarea>';
            form += '</div>';
            form += '<div id="atual-B">';
            form += '<h5> Follow Up</h5>';
            form += '<textarea name="dmp_proxima_consulta"></textarea>';
            form += '</div>';
            form += '</form>';
            $("#add-novo-formulario").html(form);
        }
</script>
