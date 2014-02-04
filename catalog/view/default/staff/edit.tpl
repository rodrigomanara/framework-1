<?php echo $header; ?>
<?php echo $menu; ?>
<div class="clear">&nbsp;</div>
<div class="title"> Gerenciamento de Funcion&aacute;rio /Editar Funcion&aacute;rio</div>
<div class="desktop">
    <form name="form" autocomplete="no" id="form" method="post">
        <input name="id_staff" value="<?php echo $data['id_staff']; ?>" type="hidden"/>
        <div class="form_desktop external-events" id="base">
            <table style="width:800px">
                <tr>
                    <td colspan="3" class="width-250"><h4>Nome </h4></td>
                    <td colspan="3" class="width-250"><h4>SobreNome </h4></td>
                </tr>
                <tr>
                    <td colspan="3"><input name="name" value="<?php echo $data['name']; ?>" type="text"/></td>
                    <td colspan="3"><input name="surname" value="<?php echo $data['surname']; ?>" type="text"/></td>
                </tr>
                <tr>
                    <td colspan="3" class="width-250"><h4>Posi&ccedil;&atilde;o </h4></td>
                    <td colspan="3" class="width-250"><h4>Adicionar cores No Agendamento</h4></td>
                </tr>
                <tr>
                    <td colspan="3" id="id_select"></td>
                    <td colspan="3">
                        <div id="colorSelector"> <div style="background-color: <?php echo $data['cores']; ?>;width: 28px;height: 28px;cursor: pointer">&nbsp;</div>
                            <input name="cores" value="<?php echo $data['cores']; ?>" type="hidden"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="width-250"><h4>Data de Inicio</h4></td>
                    <td colspan="3" class="width-250"><h4>Email</h4></td>
                </tr>
                <tr>
                    <td colspan="3"><input name="data_start" value="<?php echo $data['data_start']; ?>" type="text"/></td>
                    <td colspan="3"><input name="email" value="<?php echo $data['email']; ?>" type="text"/></td>
                </tr>
                <tr>
                    <td colspan="6"><input name="gravar" value="Gravar" type="button"/></td>
                </tr>
            </table>       
        </div>
    </form>
</div>
<script>
    $(function() {
        /* ================================================ */
        var T_each = <?php echo $list_roles; ?>;
        var select = '<select name="id_role">';
        $.each(T_each, function(i, v) {
            select += '<option value="' + v.id_role + '"';
            select += ('<?php echo $data['id_role']; ?>' === v.id_role) ? 'selected' : '';
            select += ' >' + v.name + '</option>';
        });
        select += '</select>';
        $("#id_select").html(select);
        /* ================================================ */

        $("select[name=cores]").change(function() {
            var valor = $(this).val()
            $("#cor").css({background: valor});
        });

        $("input[name=data_start]").datepicker({changeYear: true, yearRange: '1950:<?php echo date('Y'); ?>', changeMonth: true, dateFormat: 'dd-mm-yy'});
        $("input[name=gravar]").click(function() {
            var data = $('#form').serialize();
            $.ajax({
                url: '<?php echo $url; ?>',
                data: data,
                dataType: 'json',
                type: 'post',
                success: function(e) {
                    var returno = "<div> Dado Salvo!!!</div>";
                    if (e.success === true) {
                        $("#base").html(returno);
                        setTimeout(location.reload(), 3000);
                    } else {
                        $("#base").html(e.success);
                        setTimeout(location.reload(), 3000);
                    }
                }
            });
        });

        $('#colorSelector').ColorPicker({
            color: '#0000ff',
            onShow: function(colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function(colpkr) {
                $(colpkr).fadeOut(500);

                return false;
            },
            onChange: function(hsb, hex, rgb) {
                $('input[name=cores]').val('#' + hex);
                $('#colorSelector div').css('backgroundColor', '#' + hex);
            }
        });
    });
</script>
<link rel="stylesheet"  type="text/css" href="./catalog/view/default/JS/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="./catalog/view/default/JS/colorpicker/js/colorpicker.js"></script>
<script type="text/javascript" src="./catalog/view/default/JS/colorpicker/js/eye.js"></script>
<script type="text/javascript" src="./catalog/view/default/JS/colorpicker/js/utils.js"></script>
<script type="text/javascript" src="./catalog/view/default/JS/colorpicker/js/layout.js?ver=1.0.2"></script>
<?php echo $bottom; ?>