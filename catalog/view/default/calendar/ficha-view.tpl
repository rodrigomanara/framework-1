
<?php if (!empty($dado)) { ?>
    <?php $id = 0; foreach ($dado as $d) { 
        
        ?>
        <div>
            <h4 class="tab-form-click">  <span  id="open-<?php echo $id; ?>">[+]</span>  Consulta :[<?php echo $id; ?>]   / Data da consulta [<?php  echo date('d-m-Y h:i' , strtotime($d['data']));?>]</h4>
            <div  id="ficha-view-<?php echo $id; ?>"class="form_desktop tab-form" style="display: none">
            <?php foreach($d as $dados){ ?>
             <table >
                <tr>
                    <td colspan="6"> <h4>PRESENT COMPLAINT (QUEIXA PRINCIPAL ) </h4> </td>
                </tr>
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_queixa']) ? $dados['dmp_queixa'] : ""; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><h4>HISTORY OF PRESENT ILLNESS (HISTÓRIA DA DOENÇA ATUAL) </td>
                </tr>
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_historia_da_doenca_atual']) ? $dados['dmp_historia_da_doenca_atual'] : ''; ?></td>
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
                    <td colspan="6"> <?php echo isset($dados['dmp_local_de_nascimento']) ? $dados['dmp_local_de_nascimento'] : ''; ?></td>
                </tr>
                <tr>
                    <td colspan="6"> <hr/></td>
                </tr>
                <tr>
                    <td colspan="3"><h4> Childhood Diseases</br>(doenças de infância) </h4></td>
                    <td colspan="3"><h4> Allergies (alergias)</h4></td>
                </tr>

                <tr>
                    <td colspan="3"><?php echo isset($dados['dmp_doenca_de_infancia']) ? $dados['dmp_doenca_de_infancia'] : ''; ?></td>
                    <td colspan="3"><?php echo isset($dados['dmp_alergia']) ? $dados['dmp_alergia'] : ''; ?></td>
                </tr>
                <tr>
                    <td colspan="6"> <hr/></td>
                </tr>
                <tr>
                    <td colspan="3"> <h4>Surgery (cirurgias)</h4> </td>
                    <td colspan="3"> <h4>Medicines (medicamentos)</h4></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo isset($dados['dmp_cirurgia']) ? $dados['dmp_cirurgia'] : ''; ?> </td>
                    <td colspan="3"> <?php echo isset($dados['dmp_medicamento']) ? $dados['dmp_medicamento'] : ''; ?>  </td>
                </tr>
                <tr>
                    <td colspan="6"> <hr/></td>
                </tr>
                <tr>
                    <td colspan="6"><h4>Obstetric Problems (problemas obstétricos)</h4></td> 
                </tr>
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_problema_obstetricos']) ? $dados['dmp_problema_obstetricos'] : ''; ?>  </td>
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
                    <td colspan="3"> <?php echo isset($dados['dmp_profissao']) ? $dados['dmp_profissao'] : ''; ?></td>
                    <td colspan="3"><?php echo isset($dados['dmp_condicoes_de_habitacao']) ? $dados['dmp_condicoes_de_habitacao'] : ''; ?> </td>
                </tr>
                <tr>
                    <td colspan="6"> <h4>Usual Diet  (dieta habitual)</h4>  </td>
                </tr>
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_dieta_habitual']) ? $dados['dmp_dieta_habitual'] : ''; ?>  </td>
                </tr>
                <tr>
                    <td colspan="3"> <h4>Sleep (sono) </h4></td>
                    <td colspan="3"><h4> Alcoholism (etilismo)</h4></td>
                </tr>
                <tr>
                    <td colspan="3"> <?php echo isset($dados['dmp_sono']) ? $dados['dmp_sono'] : ''; ?> </td>
                    <td colspan="3"> <?php echo isset($dados['dmp_etilismo']) ? $dados['dmp_etilismo'] : ''; ?></td>
                <tr>
                    <td colspan="3"> <h4>Smoker (tabagista)</h4></td>
                    <td colspan="3"> <h4>Use of Toxic Drugs (uso de drogas)</h4> </td>
                </tr>

                <td colspan="3"><?php echo isset($dados['dmp_tabagista']) ? $dados['dmp_tabagista'] : ''; ?></td>
                <td colspan="3"><?php echo isset($dados['dmp_uso_de_drogas']) ? $dados['dmp_uso_de_drogas'] : ''; ?></td>
                </tr>
                <tr>

                    <td colspan="3"> <h4>Marital Status (estado civil)</h4></td>
                    <td colspan="3"> <h4>Sexual Activity (atividade sexual)</h4></td>
                </tr>
                <tr>

                    <td colspan="3"><?php echo isset($dados['dmp_estdado_civil']) ? $dados['dmp_estdado_civil'] : ''; ?></td>
                    <td colspan="3"> <?php echo isset($dados['dmp_atividade_sexual']) ? $dados['dmp_atividade_sexual'] : ''; ?></td>
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
                    <td colspan="6"><?php echo isset($dados['dmp_hysical_examination']) ? $dados['dmp_hysical_examination'] : ''; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><h4>VITAL SIGNS (SINAIS VITAIS)</h4></td>
                </tr>

                <tr>
                    <td colspan="3"> <h4>Blood Pressure (pressão arterial)</h4></td>
                    <td colspan="3"> <h4>Pulse  (pulso)</h4> </td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo isset($dados['dmp_pressao_Arterial']) ? $dados['dmp_pressao_Arterial'] : ''; ?> </td>
                    <td colspan="3"><?php echo isset($dados['dmp_pulso']) ? $dados['dmp_pulso'] : ''; ?>  </td>
                </tr>
                <tr>
                    <td colspan="3"> <h4>Temp</h4> </td>
                    <td colspan="3"> <h4>RF</h4> </td>
                </tr>

                <tr>
                    <td colspan="3"><?php echo isset($dados['dmp_temperatura']) ? $dados['dmp_temperatura'] : ''; ?>   </td>
                    <td colspan="3"><?php echo isset($dados['dmp_RF']) ? $dados['dmp_RF'] : ''; ?>  </td>
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
                    <td colspan="2"><?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?> </td>
                    <td colspan="2"><?php echo isset($dados['dmp_peso']) ? $dados['dmp_peso'] : ''; ?> </td>
                    <td colspan="2"><?php echo isset($dados['dmp_altura']) ? $dados['dmp_altura'] : ''; ?> </td> 
                </tr>
                <tr>
                    <td colspan="2"><h4> Head  <br/>(exame da cabeça) </h4></td>
                    <td colspan="2"> <h4>Neck  <br/>(exame do pescoço)</h4> </td>
                    <td colspan="2"> <h4>Breasts  <br/>(exame das mamas) </h4> </td>   
                </tr>
                <tr>
                    <td colspan="2"> <?php echo isset($dados['dmp_exame_cabeca']) ? $dados['dmp_exame_cabeca'] : ''; ?> </td>
                    <td colspan="2"> <?php echo isset($dados['dmp_exame_pescoco']) ? $dados['dmp_exame_pescoco'] : ''; ?> </td>
                    <td colspan="2"><?php echo isset($dados['dmp_exame_das_mamas']) ? $dados['dmp_exame_das_mamas'] : ''; ?>  </td>   
                </tr>
                <tr>
                    <td colspan="3"> <h4>RESPIRATORY SYSTEM  </h4></td>
                    <td colspan="3"><h4> CIRCULATORY SYSTEM  </h4></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?> </td>
                    <td colspan="3"> <?php echo isset($dados['dmp_estado_geral']) ? $dados['dmp_estado_geral'] : ''; ?> </td>
                </tr>
                <tr>
                    <td colspan="3"> <h4>ABDOMEN </h4></td> 
                    <td colspan="3"><h4> VERTEBRAL COLUMN  </h4></td>
                </tr>
                <tr>
                    <td colspan="3"> <?php echo isset($dados['dmp_abdomen']) ? $dados['dmp_abdomen'] : ''; ?> </td> 
                    <td colspan="3"><?php echo isset($dados['dmp_coluna_vertebral']) ? $dados['dmp_coluna_vertebral'] : ''; ?> </td>
                </tr>
                <tr>
                    <td colspan="6"> <h4>EXTERNAL GENITAL </h4>  </td>  
                </tr>
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_genital']) ? $dados['dmp_genital'] : ''; ?> </td>  
                </tr>
                <tr>
                    <td colspan="6"> <h4>DIAGNOSTIC </h4></td>
                </tr>
                <tr>
                    <td colspan="6"><?php echo isset($dados['dmp_diagnostic']) ? $dados['dmp_diagnostic'] : ''; ?>  </td>
                </tr>
                <tr>
                    <td colspan="6"> <h4>TREATMENT </h4></td>
                </tr>    
                <tr>
                    <td colspan="6"> <?php echo isset($dados['dmp_trataento']) ? $dados['dmp_trataento'] : ''; ?> </td>
                </tr>
                <tr>
                    <td colspan="6"> <h4>FOLLOW UP   </h4></td>
                </tr>    
                <tr>
                    <td colspan="6"><?php echo isset($dados['dmp_proxima_consulta']) ? $dados['dmp_proxima_consulta'] : ''; ?></td>   
                </tr>
            </table>
            <?php } ?>    
        </div>

        </div>

        <?php $id++;
    }
    ?>
<?php } ?>
