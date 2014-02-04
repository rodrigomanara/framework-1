<?php echo $header; ?>
<div class="content">
    <div class="menu_lateral">
        <ul>
            <?php foreach ($menu as $menus) { ?>
                <?php foreach ($menus as $menuss) { ?>
                    <li> <a href="<?php echo $menuss['href']; ?>"><?php echo $menuss['name']; ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div class="form_desktop">
        <table>
            <thead class="title">
            <th style="width: 100px;">Name</th>
            <th style="width: 100px;">Action</th>
            </tr>
            <?php foreach ($staff as $data) { ?>
                <tr>
                    <td colspan="2">
                        <form action="<?php echo $url ;?>" method="post" id="form_<?php echo $data['id']; ?>">
                            <input name="__rm-u" type="hidden" value="<?php echo $data['id']; ?>">
                            <table>
                                <tr>    
                                    <td style="width: 250px;"><?php echo $data['name']; ?></td>
                                    <td style="width: 280px;"><input name="send_<?php echo $data['id']; ?>" type="button" value="Enviar" onclick="enviar_dados(<?php echo $data['id']; ?>)"/></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script type="text/javascript">
     function enviar_dados(id) {
        $.ajax({
            url: '<?php echo $url ;?>',
            data: $("#form_" + id ).serialize(),
            type: 'post',
            dataType: 'json',
            beforeSend : function(){
                $('input[name=send_' + id +']').hide();
            },
            success: function(e) {
            alert(e.success);
                if (e.success) $('input[name=send_' + id +']').show();
            }
        });
    }
</script>
<?php echo $bottom; ?>