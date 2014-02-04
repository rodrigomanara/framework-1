<?php

class CandidatoConfiguracoesModel extends Model {
    //put your code here
    public function addStatus($data = array()){
        $sql = "insert into tbl_candidato_status (status , position) VALUES ('".$this->db->escape($data['status'])."' , '".(int)$data['position']."')";
        $this->db->query($sql);
    }
    public function selectStatus($data = array()){
        $sql = "select * from tbl_candidato_status " ; 
        if(!empty($data)){
         $sql .= " where id_status = '".$this->db->escape($data['id_status'])."'";
        }
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function checkSelectStatus($data = array()){
        $sql = "select count(0) as total from tbl_candidato_status where status = '".$this->db->escape($data['status'])."'";
        $query = $this->db->query($sql);
        return $query->row;
    }
    public function editStatus($data = array()){
        $sql = "update tbl_candidato_status SET status = '".$data['editstatus']."' WHERE id_status = '".$data['editid_status']."';";
        $this->db->query($sql);
    }
    public function deleteStatus(){}
    
}

?>
