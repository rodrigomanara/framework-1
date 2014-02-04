<link rel="stylesheet" href="<?php echo $header_url; ?>/catalog/view/default/CSS/style.css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"/>
<link rel="stylesheet" href="<?php echo $header_url; ?>/catalog/view/default/CSS/timepicker.css"/>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="<?php echo $header_url; ?>/catalog/view/default/JS/timepicker.js"></script>
<script src="<?php echo $header_url; ?>/catalog/view/default/JS/js-default.js"></script>

<script type="text/javascript">
    $(function() {
        $("#root").css({display : 'none'});
        $(window).load(function(){
            $("#root").css({display : ''});   
        });
        
    
        $("#tabs").tabs();
        $("#tabs").tabs({select:0});
        <?php if((int)$paciente_id === 0){ ?>    
            $("#tabs").tabs({disabled: [1,2]});
            $("#tab-2 , #tab-3").html('');
        <?php }?>
        $("input[name=__ver-ficha-medica]").click(function() {
            var url = "/pacient/home/edit/&id_paciente=<?php echo $paciente_id; ?>/";
            windowOpen(url);
        });
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
            hourMax: 20
        });

        $("input[type=button]").click(function() {
            var data = $('#form').serialize();
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
                        return valida('#form');
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

        function windowOpen(url) {
            var w = $(window).width();
            var h = $(window).height();

            var link = '/calendar/home/fichaMedica/&id_paciente=5/'


            //window.open(url , 'ficha medica' , 'width=' + w + 'px,height=' + h + 'px');
        }
    });
</script>
<div id="root">
    <form method="post" name="form" method="post" id="form">
        <div id="tabs">
            <ul>
                <li><a href="#tab-1">Agendamento</a></li>
                <li><a href="#tab-2">Ficha Medica</a></li>  
                <li><a href="#tab-3">Dados Pessoais do Paciente</a></li>  
            </ul>
            <div id='tab-1'>
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
                            <td>Title</td>
                        </tr>
                        <tr>
                            <td><input name="title" value="<?php echo $title; ?>" type="text" rel="req"></td>
                        </tr>
                        <tr>
                            <td> Inicio Data</td>
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
                                            <td><input name="gravar" value="concluir agendamento" type="button"/></td>
                                            <td><input name="excluir" value="excluir agendamento" type="button"/></td>
                                        </tr> 

                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id='tab-2'>
                <div class="form_desktop">
                    <table >
                        <tr>
                            <td colspan="6"> <h4>PRESENT COMPLAINT (QUEIXA PRINCIPAL ) </h4> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <textarea name="dmp_queixa"><?php echo isset($dados['dmp_queixa']) ? $dados['dmp_queixa'] : ""; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>HISTORY OF PRESENT ILLNESS (HISTÓRIA DA DOENÇA ATUAL) </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <textarea name="dmp_historia_da_doenca_atual"><?php echo isset($dados['dmp_historia_da_doenca_atual']) ? $dados['dmp_historia_da_doenca_atual'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <hr/></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>MEDICAL HISTORY (ANTECEDENTES MÓRBIDOS PESSOAIS)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>Birthday (local de nascimento)</h4> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <input name="dmp_local_de_nascimento" type="text" value="<?php echo isset($dados['dmp_local_de_nascimento']) ? $dados['dmp_local_de_nascimento'] : ''; ?>" /> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <hr/></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h4> Childhood Diseases</br>(doenças de infância) </h4></td>
                            <td colspan="3"><h4> Allergies (alergias)</h4></td>
                        </tr>

                        <tr>
                            <td colspan="3"><textarea name="dmp_doenca_de_infancia"><?php echo isset($dados['dmp_doenca_de_infancia']) ? $dados['dmp_doenca_de_infancia'] : ''; ?></textarea></td>
                            <td colspan="3"><textarea name="dmp_alergia"><?php echo isset($dados['dmp_alergia']) ? $dados['dmp_alergia'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <hr/></td>
                        </tr>
                        <tr>
                            <td colspan="3"> <h4>Surgery (cirurgias)</h4> </td>
                            <td colspan="3"> <h4>Medicines (medicamentos)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"> <textarea name="dmp_cirurgia"><?php echo isset($dados['dmp_cirurgia']) ? $dados['dmp_cirurgia'] : ''; ?></textarea> </td>
                            <td colspan="3"> <textarea name="dmp_medicamento"><?php echo isset($dados['dmp_medicamento']) ? $dados['dmp_medicamento'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <hr/></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>Obstetric Problems (problemas obstétricos)</h4></td> 
                        </tr>
                        <tr>
                            <td colspan="6"> <textarea name="dmp_problema_obstetricos"><?php echo isset($dados['dmp_problema_obstetricos']) ? $dados['dmp_problema_obstetricos'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="6"><hr/></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>LIFESTYLE (HISTÓRIA SOCIAL E HÁBITOS DE VIDA)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h4>Occupation (profissão) </h4></td>
                            <td colspan="3"><h4> Housing  (condições de habitação)</h4> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <textarea name="dmp_profissao"><?php echo isset($dados['dmp_profissao']) ? $dados['dmp_profissao'] : ''; ?></textarea></td>
                            <td colspan="3"> <textarea name="dmp_condicoes_de_habitacao"><?php echo isset($dados['dmp_condicoes_de_habitacao']) ? $dados['dmp_condicoes_de_habitacao'] : ''; ?></textarea> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>Usual Diet  (dieta habitual)</h4>  </td>
                        </tr>
                        <tr>
                            <td colspan="6">  <textarea name="dmp_dieta_habitual"><?php echo isset($dados['dmp_dieta_habitual']) ? $dados['dmp_dieta_habitual'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <h4>Sleep (sono) </h4></td>
                            <td colspan="3"><h4> Alcoholism (etilismo)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"> <textarea name="dmp_sono" ><?php echo isset($dados['dmp_sono']) ? $dados['dmp_sono'] : ''; ?></textarea> </td>
                            <td colspan="3"> <textarea name="dmp_etilismo"><?php echo isset($dados['dmp_etilismo']) ? $dados['dmp_etilismo'] : ''; ?></textarea></td>
                        <tr>
                            <td colspan="3"> <h4>Smoker (tabagista)</h4></td>
                            <td colspan="3"> <h4>Use of Toxic Drugs (uso de drogas)</h4> </td>
                        </tr>

                        <td colspan="3"><textarea name="dmp_tabagista"><?php echo isset($dados['dmp_tabagista']) ? $dados['dmp_tabagista'] : ''; ?></textarea></td>
                        <td colspan="3"><textarea name="dmp_uso_de_drogas"><?php echo isset($dados['dmp_uso_de_drogas']) ? $dados['dmp_uso_de_drogas'] : ''; ?></textarea></td>
                        </tr>
                        <tr>

                            <td colspan="3"> <h4>Marital Status (estado civil)</h4></td>
                            <td colspan="3"> <h4>Sexual Activity (atividade sexual)</h4></td>
                        </tr>
                        <tr>

                            <td colspan="3"> <textarea name="dmp_estdado_civil"><?php echo isset($dados['dmp_estdado_civil']) ? $dados['dmp_estdado_civil'] : ''; ?></textarea></td>
                            <td colspan="3"> <textarea name="dmp_atividade_sexual"><?php echo isset($dados['dmp_atividade_sexual']) ? $dados['dmp_atividade_sexual'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <hr/></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>FAMILY BACKGROUND (ANTECEDENTES MÓRBIDOS FAMILIARES)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>PHYSICAL EXAMINATION</h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <textarea name="dmp_hysical_examination"><?php echo isset($dados['dmp_hysical_examination']) ? $dados['dmp_hysical_examination'] : ''; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="6"><h4>VITAL SIGNS (SINAIS VITAIS)</h4></td>
                        </tr>

                        <tr>
                            <td colspan="3"> <h4>Blood Pressure (pressão arterial)</h4></td>
                            <td colspan="3"> <h4>Pulse  (pulso)</h4> </td>
                        </tr>
                        <tr>
                            <td colspan="3"><textarea name="dmp_pressao_Arterial"><?php echo isset($dados['dmp_pressao_Arterial']) ? $dados['dmp_pressao_Arterial'] : ''; ?></textarea> </td>
                            <td colspan="3"><textarea name="dmp_pulso"><?php echo isset($dados['dmp_pulso']) ? $dados['dmp_pulso'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <h4>Temp</h4> </td>
                            <td colspan="3"> <h4>RF</h4> </td>
                        </tr>

                        <tr>
                            <td colspan="3"><textarea name="dmp_temperatura"><?php echo isset($dados['dmp_temperatura']) ? $dados['dmp_temperatura'] : ''; ?></textarea>   </td>
                            <td colspan="3"><textarea name="dmp_RF"><?php echo isset($dados['dmp_RF']) ? $dados['dmp_RF'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="6"><hr/></td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>ECTOSCOPY  (ECTOSCOPIA)</h4></td>
                        </tr>
                        <tr>
                            <td colspan="2"><h4>Overall  (estado geral) </h4></td>
                            <td colspan="2"><h4>Weight  (peso)</h4></td>
                            <td colspan="2"><h4>Height  (altura)</h4> </td> 
                        </tr>
                        <tr>
                            <td colspan="2"><textarea name="dmp_estado_geral"><?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?></textarea> </td>
                            <td colspan="2"> <textarea name="dmp_peso"><?php echo isset($dados['dmp_peso']) ? $dados['dmp_peso'] : ''; ?></textarea> </td>
                            <td colspan="2"> <textarea name="dmp_altura"><?php echo isset($dados['dmp_altura']) ? $dados['dmp_altura'] : ''; ?></textarea> </td> 
                        </tr>
                        <tr>
                            <td colspan="2"><h4> Head  <br/>(exame da cabeça) </h4></td>
                            <td colspan="2"> <h4>Neck  <br/>(exame do pescoço)</h4> </td>
                            <td colspan="2"> <h4>Breasts  <br/>(exame das mamas) </h4> </td>   
                        </tr>
                        <tr>
                            <td colspan="2"> <textarea name="dmp_exame_cabeca"><?php echo isset($dados['dmp_exame_cabeca']) ? $dados['dmp_exame_cabeca'] : ''; ?></textarea> </td>
                            <td colspan="2"> <textarea name="dmp_exame_pescoco"><?php echo isset($dados['dmp_exame_pescoco']) ? $dados['dmp_exame_pescoco'] : ''; ?></textarea> </td>
                            <td colspan="2"><textarea name="dmp_exame_das_mamas"><?php echo isset($dados['dmp_exame_das_mamas']) ? $dados['dmp_exame_das_mamas'] : ''; ?></textarea>  </td>   
                        </tr>
                        <tr>
                            <td colspan="3"> <h4>RESPIRATORY SYSTEM  </h4></td>
                            <td colspan="3"><h4> CIRCULATORY SYSTEM  </h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"> <textarea name="dmp_estado_geral"><?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?></textarea> </td>
                            <td colspan="3"> <textarea name="dmp_estado_geral"><?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?></textarea> </td>
                        </tr>
                        <tr>
                            <td colspan="3"> <h4>ABDOMEN </h4></td> 
                            <td colspan="3"><h4> VERTEBRAL COLUMN  </h4></td>
                        </tr>
                        <tr>
                            <td colspan="3"> <textarea name="dmp_abdomen"><?php echo isset($dados['dmp_abdomen']) ? $dados['dmp_abdomen'] : ''; ?></textarea> </td> 
                            <td colspan="3"> <textarea name="dmp_coluna_vertebral"><?php echo isset($dados['dmp_coluna_vertebral']) ? $dados['dmp_coluna_vertebral'] : ''; ?></textarea> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>EXTERNAL GENITAL </h4>  </td>  
                        </tr>
                        <tr>
                            <td colspan="6"> <textarea name="dmp_genital"><?php echo isset($dados['dmp_genital']) ? $dados['dmp_genital'] : ''; ?></textarea> </td>  
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>DIAGNOSTIC </h4></td>
                        </tr>
                        <tr>
                            <td colspan="6"><textarea name="dmp_diagnostic"><?php echo isset($dados['dmp_diagnostic']) ? $dados['dmp_diagnostic'] : ''; ?></textarea>  </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>TREATMENT </h4></td>
                        </tr>    
                        <tr>
                            <td colspan="6"> <textarea name="dmp_trataento"><?php echo isset($dados['dmp_trataento']) ? $dados['dmp_trataento'] : ''; ?></textarea> </td>
                        </tr>
                        <tr>
                            <td colspan="6"> <h4>FOLLOW UP   </h4></td>
                        </tr>    
                        <tr>
                            <td colspan="6"> <textarea name="dmp_proxima_consulta"><?php echo isset($dados['dmp_proxima_consulta']) ? $dados['dmp_proxima_consulta'] : ''; ?></textarea></td>   
                        </tr>
                    </table>
                </div>
            </div>
            <div id='tab-3'>
                
            </div>
        </div>
    </form>
</div>