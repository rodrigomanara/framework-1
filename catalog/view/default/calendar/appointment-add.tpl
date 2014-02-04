<html>
    <head>
        <script type="text/javascript">
            $(function() {
                $("input[name=data_start]").datepicker({
                    changeYear: true
                            , yearRange: "<?php echo date('Y'); ?>:<?php echo date('Y') + 1; ?>"
                            , changeMonth: true
                            , dateFormat: 'dd-mm-yy'
                });
                $("input[name=data_time_start] , input[name=data_time_end]").timepicker({
                    controlType: 'select',
                    timeFormat: 'HH:mm',
                    hourMin: 7,
                    hourMax: 20,
                    minuteGrid: 15
                });

                $("input[name=gravar], input[name=excluir]").click(function() {
                    var data = $('#form-apoinment').serialize();
                    var url = '&type=' + $(this).attr('name');
                    var type = $(this).attr('name');

                    $.ajax({
                        url: '<?php echo $url; ?>' + url,
                        data: data,
                        dataType: 'json',
                        type: 'post',
                        beforeSend: function() {
                            if (type === 'excluir') {
                                var c = confirm('Os dados serao apagados da agenda!!!')
                                if (c === false) {
                                    return false;
                                }
                            } else {
                                var str = $("input[name=id_paciente]");

                                if (isNaN(str.val()) === false) {
                                    return valida('#form');
                                } else {
                                    $(str).val('Verifique o Nome do Paciente');
                                    return replaceTex(str);

                                }
                            }
                        },
                        success: function(e) {
                            var returno = (type === 'gravar') ? "<div> Dado Salvo!!!</div>" : "<div> Dado Excluido!!!</div>";
                            if (e.success) {
                                $(".form_desktop").html(returno);
                                setTimeout(fechar(), 3000);

                            } else {
                                $(".form_desktop").html(e.success);
                            }
                        }
                    });

                });
                $('input[name=id_paciente]').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "<?php echo $autocompleteP; ?>", //#autocompleteS  = paciente
                            data: {term: request.term},
                            dataType: "json",
                            type: 'post',
                            success: function(data) {
                                response($.map(data, function(item) {

                                    return {
                                        label: item.nome,
                                        value: item.id_paciente
                                    }


                                }));
                            }
                        });
                    }
                });
                $('input[name=id_staff]').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "<?php echo $autocompleteS; ?>", //autocompleteS  = staff
                            data: {term: request.term},
                            dataType: "json",
                            type: 'post',
                            success: function(data) {
                                response($.map(data, function(item) {

                                    return {
                                        label: item.name,
                                        value: item.id_staff
                                    }
                                })
                                        );
                            }
                        });
                    }
                });
                function fechar() {
                    parent.location.reload(true);
                }

               
            });

            function replaceTex(element) {
                setTimeout($(element).val(''), 50000);
                return false;
            }
        </script>
    </head>
    <body>
        <div>
            <form method="post" name="form-apoinment" method="post" id="form-apoinment">
                <div>
                    <h4> Novo Agendamento <div class="calendar"></div></h4>
                </div>
                <div class="form_desktop">
                    <?php if (isset($id_calendar)) echo $id_calendar; ?>
                    <table class="width-450">
                        <tr>
                            <td>Nome do Paciente</td>
                        </tr>
                        <tr>
                            <td> 
                                <?php echo $paciente; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nome do M&eacute;dico</td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $staff; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Motivo da Consulta</td>
                        </tr>
                        <tr>
                            <td><textarea name="title" rel="req"><?php echo $title; ?></textarea></td>
                        </tr>
                        <tr>
                            <td> Data do Agendamento</td>
                        </tr>
                        <tr>
                            <td>
                                <input name="data_start" value="<?php echo $start; ?>" type="text" style="width: 150px;"> 
                            </td>
                        </tr>
                        <tr>
                            <td>Horario</td>
                        </tr>
                        <tr>
                            <td> 
                                Entrada&nbsp;&nbsp;<input name="data_time_start" value="<?php echo $start_time; ?>" type="text" rel="req" style="width: 150px;">
                                Saida&nbsp;&nbsp;<input name="data_time_end" value="<?php echo $end_time; ?>" type="text" rel="req" style="width: 150px;"></td>
                        </tr>
                        <tr>
                            <td>salvar</td>
                        </tr>
                        <tr>
                            <td>
                                <div>

                                    <table>
                                        <tr>
                                            <td><input name="gravar" style="width:220px" value="concluir agendamento" type="button"/></td>
                                            <td><input name="excluir" style="width:220px" value="excluir agendamento" type="button"/></td>
                                        </tr> 

                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </body>
</html>