<?php

class PacientConsultamedicaModel extends Model {

    /**
     * 
     * @param type $data
     * @return type
     */
    public function selectDadosFicha($data = array()) {
        $sql = "select * from tbl_paciente_dados_ficha where id_paciente = '{$this->db->escape($data['id_paciente'])}';";
        $query = $this->db->query($sql);
        $row = $query->rows;
        return $row;
    }

    
    /**
     * 
     * @param type $data
     * @return type
     */
    public function selectDadosHistoricaFicha($data = array()) {
        $sql = "select * from tbl_paciente_dados_fichamedica where id_paciente = '{$this->db->escape($data['id_paciente'])}';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getTempSaveFile($data) {
        $sql = "select * from tbl_save_temp_file where id_paciente = '" . $data['id_paciente'] . "';";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    //===========================

    public function save_temp_file($data) {
        $sql = "insert into tbl_save_temp_file ( 
                    name
                    ,type
                    ,content
                    ,size 
                    ,id_paciente
                    ,data
            ) VALUES (
                '" . $this->db->escape($data['name']) . "'
                ,'" . $this->db->escape($data['type']) . "'
                ,'" . $this->db->escape($data['content']) . "'
                ,'" . $this->db->escape($data['size']) . "'
                ,'" . $this->db->escape($data['id_paciente']) . "'
                , now()
            );";
        $this->db->ExecuteUpdate($sql);
        return $this->db->getLastId();
    }

    public function updateDadosPacienteDadosMedicosFollow($data) {
        $sql = "replace into tbl_paciente_dados_ficha (
                    id_ficha
                   ,id_paciente
                   ,dmp_queixa
                   ,dmp_proxima_consulta
                   ,data
                 ) VALUES (
                    '{$this->db->escape($data['id_ficha'])}'   -- id_ficha - IN int(11)
                   ,'{$this->db->escape($data['id_paciente'])}'   -- id_paciente - IN int(11)
                   ,'{$this->db->escape($data['dmp_queixa'])}'  -- dmp_queixa - IN text
                   ,'{$this->db->escape($data['dmp_proxima_consulta'])}'  -- dmp_proxima_consulta - IN text
                   ,now()  -- data - IN datetime
                 )";

        $this->db->ExecuteUpdate($sql);
        return true;
    }

    /**
     * 
     */
    public function updateDadosPacientedadosMedicos($data = null) {
        $sql = "replace into tbl_paciente_dados_fichamedica (
                        id_paciente
                       ,dmp_historia_da_doenca_atual
                       ,dmp_local_de_nascimento
                       ,dmp_doenca_de_infancia
                       ,dmp_alergia
                       ,dmp_cirurgia
                       ,dmp_medicamento
                       ,dmp_problema_obstetricos
                       ,dmp_profissao
                       ,dmp_condicoes_de_habitacao
                       ,dmp_dieta_habitual
                       ,dmp_sono
                       ,dmp_etilismo
                       ,dmp_tabagista
                       ,dmp_uso_de_drogas
                       ,dmp_estdado_civil
                       ,dmp_atividade_sexual
                       ,dmp_hysical_examination
                       ,dmp_pressao_Arterial
                       ,dmp_pulso
                       ,dmp_temperatura
                       ,dmp_RF
                       ,dmp_estado_geral
                       ,dmp_peso
                       ,dmp_altura
                       ,dmp_exame_cabeca
                       ,dmp_exame_pescoco
                       ,dmp_exame_das_mamas
                       ,dmp_estado_geral_repiratorio
                       ,dmp_estado_geral_circulatorio
                       ,dmp_abdomen
                       ,dmp_coluna_vertebral
                       ,dmp_genital
                       ,dmp_diagnostic
                       ,dmp_tratamento
                     ) VALUES (
                        {$data['id_paciente']}   -- id_paciente - IN int(11)
                       ,'{$this->db->escape($data['dmp_historia_da_doenca_atual'])}'  -- dmp_historia_da_doenca_atual - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_local_de_nascimento'])}'  -- dmp_local_de_nascimento - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_doenca_de_infancia'])}'  -- dmp_doenca_de_infancia - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_alergia'])}'  -- dmp_alergia - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_cirurgia'])}'  -- dmp_cirurgia - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_medicamento'])}'  -- dmp_medicamento - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_problema_obstetricos'])}'  -- dmp_problema_obstetricos - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_profissao'])}'  -- dmp_profissao - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_condicoes_de_habitacao'])}'  -- dmp_condicoes_de_habitacao - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_dieta_habitual'])}'  -- dmp_dieta_habitual - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_sono'])}'  -- dmp_sono - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_etilismo'])}'  -- dmp_etilismo - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_tabagista'])}'  -- dmp_tabagista - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_uso_de_drogas'])}'  -- dmp_uso_de_drogas - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_estdado_civil'])}'  -- dmp_estdado_civil - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_atividade_sexual'])}'  -- dmp_atividade_sexual - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_hysical_examination'])}'  -- dmp_hysical_examination - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_pressao_Arterial'])}'  -- dmp_pressao_Arterial - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_pulso'])}'  -- dmp_pulso - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_temperatura'])}'  -- dmp_temperatura - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_RF'])}'  -- dmp_RF - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_estado_geral'])}'  -- dmp_estado_geral - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_peso'])}'  -- dmp_peso - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_altura'])}'  -- dmp_altura - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_exame_cabeca'])}'  -- dmp_exame_cabeca - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_exame_pescoco'])}'  -- dmp_exame_pescoco - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_exame_das_mamas'])}'  -- dmp_exame_das_mamas - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_estado_geral_repiratorio'])}'  -- dmp_estado_geral_repiratorio - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_estado_geral_circulatorio'])}'  -- dmp_estado_geral_circulatorio - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_abdomen'])}'  -- dmp_abdomen - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_coluna_vertebral'])}'  -- dmp_coluna_vertebral - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_genital'])}'  -- dmp_genital - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_diagnostic'])}'  -- dmp_diagnostic - IN varchar(255)
                       ,'{$this->db->escape($data['dmp_tratamento'])}'  -- dmp_tratamento - IN varchar(255)
                     );";
        $this->db->ExecuteUpdate($sql);
        return true;
    }

    
}

?>
