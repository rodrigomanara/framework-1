<?php

class PacientPacientModel extends Model {

    public function getPacients($data = array()) {
        if (isset($data['data-nascimento']) && !empty($data['data-nascimento'])) {
            $date = explode("-", $data['data-nascimento']);
            $calendario = $date[2] . '/' . $date[1] . '/' . $date[0];
        }

        $sql = "SELECT *  FROM tbl_paciente WHERE 0=0";
        $sql .= isset($data['search']) ? " and nome LIKE '%" . $this->db->escape($data['search']) . "%' " : '';
        $sql .= isset($data['id_paciente']) ? " and id_paciente = '" . (int) $data['id_paciente'] . "'" : '';
        $sql .= isset($data['nome']) && !empty($data['nome']) ? " and nome like '%{$data['nome']}%'" : '';
        $sql .= isset($data['email']) && !empty($data['email']) ? " and email like '%{$data['email']}%'" : '';
        $sql .= isset($data['telefone']) && !empty($data['telefone']) ? " and telefone like '%{$data['telefone']}%'" : '';
        $sql .= isset($data['data-nascimento']) && !empty($data['data-nascimento']) ? " and data_nascimento = '{$calendario}'" : '';
        $sql .= " ;";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getPacient($data = array()) {
        $sql = "select * from tbl_paciente";
        $sql .= " WHERE id_paciente = '" . (int) $data['id_paciente'] . "'";

        $query = $this->db->query($sql);
        return $query->row;
    }

    public function getPPCPacient($data = array()) {
        $sql = "select * from tbl_paciente_pessoa_para_contato where id_paciente = '{$data['id_paciente']}'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    //===================================
    // Parte de Salvar e Inserir Dados no banco de dados
    /**
     * 
     * @param type $data
     * @return boolean
     */
    public function updateDadosPaciente($data = null) {
        try {
            foreach ($data as $key => $value) {
                $str_a_1[] = $key;
                $str_a_2[] = $value;
            }
            $sql = "REPLACE INTO tbl_paciente (" . implode(",", $str_a_1) . ") ";
            $sql .= "values ('" . implode("','", $str_a_2) . "')";
            
            $this->db->ExecuteUpdate($sql);
            
            $sql = "select id_paciente from tbl_paciente order by id_paciente desc limit 1;";
            $query = $this->db->qury($sql);
            $_SESSION['id_paciente'] = $query->row['id_paciente'];

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param type $data
     * @return boolean
     */
    public function updateDadosPacientePessoaContato($data = null) {

        foreach ($data as $key => $value) {
            $str_a_1[] = $key;
            $str_a_2[] = $value;
        }
        $sql = "REPLACE INTO tbl_paciente_pessoa_para_contato (" . implode(",", $str_a_1) . ") ";
        $sql .= "values ('" . implode("','", $str_a_2) . "')";

        $this->db->ExecuteUpdate($sql);
        return true;
    }

}