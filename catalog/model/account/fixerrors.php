<?php

class AccountFixerrorsModel extends Model {
    
    public function staffimage(){
        $sql = "SELECT replace(image, '/images/staff/','') as image  FROM tbl_candidato_dados_extra WHERE length(image) > 1;";
        $query = $this->db->query($sql);
        return $row = $query->rows;
        
    }
    public function getStaff(){
        $sql = "select name,email,user_id from tbl_user;";
        $query = $this->db->query($sql);
        return $row = $query->rows;
    }
    public function resetPass($data = array()){
        $sql ="update tbl_user SET password = md5('".$data['__rm-password']."') WHERE user_id = '".$data['__rm-u']."';";
        $this->db->ExecuteUpdate($sql);
    }
    
} 
?>
