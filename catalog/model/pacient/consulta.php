<?php

class PacientConsultaModel extends Model {

    public function AdicionarNovaConsulta($data = array()) {
        $id = $this->selectFichaId($data);
        $sql = "INSERT into tbl_paciente_dados_ficha ( id_paciente , ficha , id_ficha , data) values
            ('" . $data['id_paciente'] . "'
            ,'" . $data['dados'] . "'
            , '".$id['contar']."'
            , now())";    
        $this->db->ExecuteUpdate($sql);
    }
    public function selectFichaId($data = array()){
        $sql = "(SELECT count(0) + 1 as contar
             FROM tbl_paciente_dados_ficha
            WHERE id_paciente = '".$data['id_paciente']."')";
        
        $query = $this->db->query($sql);
        return $query->row;
    }

}

?>
