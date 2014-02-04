<div>
    <?php if (empty($query)) { ?>

        <div class="info"> Funcionário não encontrado, por favor crie um novo cadastro <a href="<?php echo $add_funcionario; ?>">click aqui</a></div>

    <?php } else { ?>

        <div class="div_form">
            <div class="div_form_header width-250 div_space_between">Nome</div>
            <div class="div_form_header width-100 div_space_between">profissao</div>
            <div class="div_form_header width-100 div_space_between">Estatus</div>
            <div class="div_form_header width-250 div_space_between">Email</div>
        </div>
        <?php foreach ($query as $data) { ?>
            <div class="div_form">
                <div class="div_form_body width-250 div_space_between"><?php echo $data['nome']; ?></div>
                <div class="div_form_body width-100 div_space_between"><?php echo $data['profissao']; ?></div>
                <div class="div_form_body width-100 div_space_between"><?php echo $data['status_nome']; ?></div>
                <div class="div_form_body width-250 div_space_between"><?php echo $data['email']; ?></div>


                <div class="div_form_body width-100 div_space_between">  
                    <div onclick="$(this).go(<?php echo $data['id_staff']; ?>, '<?php echo $edit; ?>');" class="edit"> &nbsp;&nbsp;&nbsp;</div>  
                    <div onclick="deleta(<?php echo $data['id_staff']; ?>, '<?php echo $delete; ?>', '<?php echo $data['status']; ?>');" class="delete"> &nbsp;&nbsp;&nbsp;</div> 
                </div>
            </div>
        <?php } ?>
        <script>
                    $(function() {
                        $.fn.go = function(id, url) {
                            window.location = url + '&id_staff=' + id + '/'
                        }

                    })
                    function deleta(id, url, estatus) {
                        var acao = (estatus == 0 ? 1 : 0);
                        $.ajax({
                            url: url,
                            data: '&id_staff=' + id + '&status=' + acao,
                            dataType: 'json',
                            type: 'post',
                            beforeSend: function() {
                                var conf = confirm('Este funcionário será excluido totalmente do sistema! Tem certesa disso?')

                                if (conf === false) {
                                    return false;
                                }
                            },
                            success: function() {
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
                                })
                            }
                        });
                    }
        </script>
    <?php } ?>
</div>