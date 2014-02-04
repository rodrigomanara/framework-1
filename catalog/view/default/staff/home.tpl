<?php echo $header; ?>
<?php echo $menu; ?>

<div class="clear">&nbsp;</div>
<div class="title">Gerenciamento de Funcion&aacute;rio / Procurar Funcion&aacute;rio</div>
<div class="clear">&nbsp;</div>
<divc class="desktop">
    <form name="form_staff" autocomplete="no" action="javascript:void(0);">
        <table>
            <tr>
                <td><input style="width: 350px;" name="search" value="" type="text"/></td>
                <td><input name="buscar" value="Search" type="button"/></td>
            </tr>
        </table>
    </form>
    <div id="html"></div>
</div>
<?php echo $bottom; ?>
<script>
    $(document.body).ready(function() {
        $('input[name=buscar]').click(function() {
            var data = $('form[name=form_staff]').serialize();
            $.ajax({
                data: data,
                dataType: 'json',
                type: 'POST',
                url: '<?php echo $url; ?>',
                beforeSend: function() {
                    $("#html").css({opacity: '0.5'});
                    $("#html").html("Loading...");
                },
                success: function(e) {
                    $("#html").css({opacity: '1'})
                    $('#html').html(e.html);
                }
            });
        });
    });
</script>