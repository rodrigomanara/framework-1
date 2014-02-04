<div id="part-1"> 
    <h5>History of Present Illness (Hist&oacute;ria da  Doença Atual)</h5>
    <textarea name="dmp_historia_da_doenca_atual"></textarea>
</div>
<h4>Medical History (ANTECEDENTES MÓRBIDOS PESSOAIS)</h4>
<div id="part-2">
    <h5>Birthday (local de nascimento)</h5> 
    <input name="dmp_local_de_nascimento" type="text" value="<?php echo $data['dmp_local_de_nascimento'] ;?>" />

    <h5> Childhood Diseases(doenças de infância) </h5>
    <textarea name="dmp_doenca_de_infancia"><?php echo $data['dmp_doenca_de_infancia'] ;?></textarea>

    <h5> Allergies (alergias)</h5>
    <textarea name="dmp_alergia"><?php echo $data['dmp_alergia'] ;?></textarea>

    <h5>Surgery (cirurgias)</h5>
    <textarea name="dmp_cirurgia"><?php echo $data['dmp_cirurgia'] ;?></textarea>

    <h5>Medicines (medicamentos)</h5>
    <textarea name="dmp_medicamento"><?php echo $data['dmp_medicamento'] ;?></textarea>

    <h5>Obstetric Problems (problemas obstétricos)</h5>
    <textarea name="dmp_problema_obstetricos"><?php echo $data['dmp_problema_obstetricos'] ;?></textarea>
</div>
<h4>Lifestyle (Hist&oacute;ria Social e H&aacute;bitos de Vida)</h4>
<div id="part-3">
    <h5>Occupation (profissão) </h5>
    <textarea name="dmp_profissao"><?php echo $data['dmp_profissao'] ;?></textarea>

    <h5> Housing  (condições de habitação)</h5>
    <textarea name="dmp_condicoes_de_habitacao"><?php echo $data['dmp_condicoes_de_habitacao'] ;?></textarea>

    <h5>Usual Diet  (dieta habitual)</h5>
    <textarea name="dmp_dieta_habitual"><?php echo $data['dmp_dieta_habitual'] ;?></textarea>

    <h5>Sleep (sono) </h5>
    <textarea name="dmp_sono" ><?php echo $data['dmp_sono'] ;?></textarea>

    <h5> Alcoholism (etilismo)</h5>
    <textarea name="dmp_etilismo"><?php echo $data['dmp_etilismo'] ;?></textarea>

    <h5>Smoker (tabagista)</h5>
    <textarea name="dmp_tabagista"><?php echo $data['dmp_tabagista'] ;?></textarea>

    <h5>Use of Toxic Drugs (uso de drogas)</h5>
    <textarea name="dmp_uso_de_drogas"><?php echo $data['dmp_uso_de_drogas'] ;?></textarea>

    <h5>Marital Status (estado civil)</h5>
    <textarea name="dmp_estdado_civil"><?php echo $data['dmp_estdado_civil'] ;?></textarea>

    <h5>Sexual Activity (atividade sexual)</h5>
    <textarea name="dmp_atividade_sexual"><?php echo $data['dmp_atividade_sexual'] ;?></textarea>
</div>
<h4>Family Background (Antecedentes M&oacute;rbidos Familiares)</h4>
<div id="part-4">
    <h5>Phsysical Examination (Exame Fisico)</h5>
    <textarea name="dmp_hysical_examination"><?php echo $data['dmp_hysical_examination'] ;?></textarea>
</div>
<h4>VITAL SIGNS (Sinais Vitais)</h4>    
<div id="part-5">
    <h5>Blood Pressure (Pressão arterial)</h5>
    <textarea name="dmp_pressao_Arterial"><?php echo $data['dmp_pressao_Arterial'] ;?></textarea>

    <h5>Pulse  (Pulso)</h5>
    <textarea name="dmp_pulso"><?php echo $data['dmp_pulso'] ;?></textarea>

    <h5>Temp (Temperatura)</h5>
    <textarea name="dmp_temperatura"><?php echo $data['dmp_temperatura'] ;?></textarea>

    <h5>RF</h5>
    <textarea name="dmp_RF"><?php echo $data['dmp_RF'] ;?></textarea>
</div>
<h4>Ectoscoy  (Ectoscopia)</h4>
<div id="part-6">
    <h5>Overall  (estado geral) </h5>
    <textarea name="dmp_estado_geral"><?php echo $data['dmp_estado_geral'] ;?></textarea>

    <h5>Weight  (peso)</h5>
    <textarea name="dmp_peso"><?php echo $data['dmp_peso'] ;?></textarea>

    <h5>Height  (altura)</h5> 
    <textarea name="dmp_altura"><?php echo $data['dmp_altura'] ;?></textarea>

    <h5> Head  (exame da cabeça) </h5>
    <textarea name="dmp_exame_cabeca"><?php echo $data['dmp_exame_cabeca'] ;?></textarea>

    <h5>Neck  (exame do pescoço)</h5>
    <textarea name="dmp_exame_pescoco"><?php echo $data['dmp_exame_pescoco'] ;?></textarea>

    <h5>Breasts  (exame das mamas) </h5>
    <textarea name="dmp_exame_das_mamas"><?php echo $data['dmp_exame_das_mamas'] ;?></textarea>

    <h5>Respiratory System (Sistema Respiratorio)  </h5>
    <textarea name="dmp_estado_geral_repiratorio"><?php echo $data['dmp_estado_geral_repiratorio'] ;?></textarea> 

    <h5> Circulatory System  (Sistema Circulatorio)</h5>
    <textarea name="dmp_estado_geral_circulatorio"><?php echo $data['dmp_estado_geral_circulatorio'] ;?></textarea>

    <h5>ABDOMEN </h5>
    <textarea name="dmp_abdomen"><?php echo $data['dmp_abdomen'] ;?></textarea> 

    <h5> Vertebral Column (Coluna Vertebral)  </h5>
    <textarea name="dmp_coluna_vertebral"><?php echo $data['dmp_coluna_vertebral'] ;?></textarea>

    <h5>External Genital (Genital) </h5>
    <textarea name="dmp_genital"><?php echo $data['dmp_genital'] ;?></textarea>

    <h5>Diagnostic </h5>
    <textarea name="dmp_diagnostic"><?php echo $data['dmp_diagnostic'] ;?></textarea>

    <h5>Treatment (Tratamento) </h5>
    <textarea name="dmp_tratamento"><?php echo $data['dmp_tratamento'] ;?></textarea>
</div>

<script>
    $(function() {
        $("[id^=part-]").accordion();
    });
</script>