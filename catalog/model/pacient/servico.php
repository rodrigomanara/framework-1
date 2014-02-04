<?php

class PacientServicoModel extends Model {

    /**
     * 
     * @param type $data
     */
    public function out_financeiro($data) {
        $array = array();

        $sql = "select servico , value , metodo , quantidade , totalpago , data from tbl_paciente_financeiro  where id_paciente='" . $data['id_paciente'] . "'";
        $query1 = $this->db->query($sql);

        foreach ($query1->rows as $key => $value) {
            $_dado[$key] = $value;
            array_push($array, $_dado[$key]);
        }


        $sql = "select servico , value , metodo , quantidade , totalpago , data from tbl_paciente_medicamentos  where id_paciente='" . $data['id_paciente'] . "'";
        $query2 = $this->db->query($sql);

        foreach ($query2->rows as $key => $value) {
            $_dado[$key] = $value;
            array_push($array, $_dado[$key]);
        }

        return $array;
    }

    /**
     * 
     * @param type $data
     * @return boolean
     */
    public function updateDadosFinanceiros($data) {
        try {
            $sql = " replace into tbl_paciente_financeiro (
                    id_paciente
                   ,id_fin
                   ,data
                   ,servico
                   ,value
                   ,metodo
                   ,totalpago
                   ,quantidade
                 ) VALUES (
                    '{$data['id_paciente']}'   -- id_paciente - IN int(11)
                   ,'{$data['id_fin']}'   -- id_fin - IN int(11)
                   ,now()  -- data - IN timestamp
                   ,'{$data['servico']}'  -- servico - IN text
                   ,'{$data['value']}'   -- value - IN float
                   ,'{$data['metodo']}'  -- metodo - IN varchar(20)
                   ,'{$data['totalpago']}'   -- totalpago - IN float
                   ,'{$data['quantidade']}'   -- quantidade - IN int(11)
                 )";
                    
                   
            $this->db->ExecuteUpdate($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>