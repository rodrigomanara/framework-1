<script>
    $(document.ready).ready(function(){
        $("#button-nova-consulta").click(function(){
            if(enviar_valida("form[name=form-nova-consulta]" ,'<?php echo $url ;?>')){
                $(".form_desktop").html('Dados Salvos');
                document.location.reload();
            }
        })
        
    });
</script>
 <h4 class="tab-form-click">  <span  id="open-9999999">[+] Novo Formulario Medico</span> </h4>
<form name="form-nova-consulta" autocomplete="off">
    <input name="id_paciente" value="<?php echo $id_paciente;?>" type="hidden"/>
        
    <div class="form_desktop" id="ficha-view-9999999" style="display:none">
        <table >
            <tr>
                <td colspan="6"> <h4>PRESENT COMPLAINT (QUEIXA PRINCIPAL ) </h4> </td>
            </tr>
            <tr>
                <td colspan="6"> <textarea name="dmp_queixa"></textarea></td>
            </tr>
            <tr>
                <td colspan="6"><h4>HISTORY OF PRESENT ILLNESS (HISTÓRIA DA DOENÇA ATUAL) </td>
            </tr>
            <tr>
                <td colspan="6"> <textarea name="dmp_historia_da_doenca_atual"></textarea></td>
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
                <td colspan="6"> <input name="dmp_local_de_nascimento" type="text" value="" /> </td>
            </tr>
            <tr>
                <td colspan="6"> <hr/></td>
            </tr>
            <tr>
                <td colspan="3"><h4> Childhood Diseases</br>(doenças de infância) </h4></td>
                <td colspan="3"><h4> Allergies (alergias)</h4></td>
            </tr>

            <tr>
                <td colspan="3"><textarea name="dmp_doenca_de_infancia"></textarea></td>
                <td colspan="3"><textarea name="dmp_alergia"></textarea></td>
            </tr>
            <tr>
                <td colspan="6"> <hr/></td>
            </tr>
            <tr>
                <td colspan="3"> <h4>Surgery (cirurgias)</h4> </td>
                <td colspan="3"> <h4>Medicines (medicamentos)</h4></td>
            </tr>
            <tr>
                <td colspan="3"> <textarea name="dmp_cirurgia"></textarea> </td>
                <td colspan="3"> <textarea name="dmp_medicamento"></textarea>  </td>
            </tr>
            <tr>
                <td colspan="6"> <hr/></td>
            </tr>
            <tr>
                <td colspan="6"><h4>Obstetric Problems (problemas obstétricos)</h4></td> 
            </tr>
            <tr>
                <td colspan="6"> <textarea name="dmp_problema_obstetricos"></textarea>  </td>
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
                <td colspan="3"> <textarea name="dmp_profissao"></textarea></td>
                <td colspan="3"> <textarea name="dmp_condicoes_de_habitacao"></textarea> </td>
            </tr>
            <tr>
                <td colspan="6"> <h4>Usual Diet  (dieta habitual)</h4>  </td>
            </tr>
            <tr>
                <td colspan="6">  <textarea name="dmp_dieta_habitual"></textarea>  </td>
            </tr>
            <tr>
                <td colspan="3"> <h4>Sleep (sono) </h4></td>
                <td colspan="3"><h4> Alcoholism (etilismo)</h4></td>
            </tr>
            <tr>
                <td colspan="3"> <textarea name="dmp_sono" ></textarea> </td>
                <td colspan="3"> <textarea name="dmp_etilismo"></textarea></td>
            <tr>
                <td colspan="3"> <h4>Smoker (tabagista)</h4></td>
                <td colspan="3"> <h4>Use of Toxic Drugs (uso de drogas)</h4> </td>
            </tr>

            <td colspan="3"><textarea name="dmp_tabagista"></textarea></td>
            <td colspan="3"><textarea name="dmp_uso_de_drogas"></textarea></td>
            </tr>
            <tr>

                <td colspan="3"> <h4>Marital Status (estado civil)</h4></td>
                <td colspan="3"> <h4>Sexual Activity (atividade sexual)</h4></td>
            </tr>
            <tr>

                <td colspan="3"> <textarea name="dmp_estdado_civil"></textarea></td>
                <td colspan="3"> <textarea name="dmp_atividade_sexual"></textarea></td>
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
                <td colspan="6"> <textarea name="dmp_hysical_examination"></textarea></td>
            </tr>
            <tr>
                <td colspan="6"><h4>VITAL SIGNS (SINAIS VITAIS)</h4></td>
            </tr>

            <tr>
                <td colspan="3"> <h4>Blood Pressure (pressão arterial)</h4></td>
                <td colspan="3"> <h4>Pulse  (pulso)</h4> </td>
            </tr>
            <tr>
                <td colspan="3"><textarea name="dmp_pressao_Arterial"></textarea> </td>
                <td colspan="3"><textarea name="dmp_pulso"></textarea>  </td>
            </tr>
            <tr>
                <td colspan="3"> <h4>Temp</h4> </td>
                <td colspan="3"> <h4>RF</h4> </td>
            </tr>

            <tr>
                <td colspan="3"><textarea name="dmp_temperatura"></textarea>   </td>
                <td colspan="3"><textarea name="dmp_RF"></textarea>  </td>
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
                <td colspan="2"><textarea name="dmp_estado_geral"></textarea> </td>
                <td colspan="2"> <textarea name="dmp_peso"></textarea> </td>
                <td colspan="2"> <textarea name="dmp_altura"></textarea> </td> 
            </tr>
            <tr>
                <td colspan="2"><h4> Head  <br/>(exame da cabeça) </h4></td>
                <td colspan="2"> <h4>Neck  <br/>(exame do pescoço)</h4> </td>
                <td colspan="2"> <h4>Breasts  <br/>(exame das mamas) </h4> </td>   
            </tr>
            <tr>
                <td colspan="2"> <textarea name="dmp_exame_cabeca"></textarea> </td>
                <td colspan="2"> <textarea name="dmp_exame_pescoco"></textarea> </td>
                <td colspan="2"><textarea name="dmp_exame_das_mamas"></textarea>  </td>   
            </tr>
            <tr>
                <td colspan="3"> <h4>RESPIRATORY SYSTEM  </h4></td>
                <td colspan="3"><h4> CIRCULATORY SYSTEM  </h4></td>
            </tr>
            <tr>
                <td colspan="3"> <textarea name="dmp_estado_geral"></textarea> </td>
                <td colspan="3"> <textarea name="dmp_estado_geral"></textarea> </td>
            </tr>
            <tr>
                <td colspan="3"> <h4>ABDOMEN </h4></td> 
                <td colspan="3"><h4> VERTEBRAL COLUMN  </h4></td>
            </tr>
            <tr>
                <td colspan="3"> <textarea name="dmp_abdomen"></textarea> </td> 
                <td colspan="3"> <textarea name="dmp_coluna_vertebral"></textarea> </td>
            </tr>
            <tr>
                <td colspan="6"> <h4>EXTERNAL GENITAL </h4>  </td>  
            </tr>
            <tr>
                <td colspan="6"> <textarea name="dmp_genital"></textarea> </td>  
            </tr>
            <tr>
                <td colspan="6"> <h4>DIAGNOSTIC </h4></td>
            </tr>
            <tr>
                <td colspan="6"><textarea name="dmp_diagnostic"></textarea>  </td>
            </tr>
            <tr>
                <td colspan="6"> <h4>TREATMENT </h4></td>
            </tr>    
            <tr>
                <td colspan="6"> <textarea name="dmp_trataento"></textarea> </td>
            </tr>
            <tr>
                <td colspan="6"> <h4>FOLLOW UP   </h4></td>
            </tr>    
            <tr>
                <td colspan="6"> <textarea name="dmp_proxima_consulta"></textarea></td>   
            </tr>
            <tr>
                <td>
                    <input name="" value="Salvar" type="button" id="button-nova-consulta"/>
                </td>
            </tr>
        </table>
    </div>
</form>