<?php

class ModelLevelModel extends Model{
    //put your code here
    public function userlevel($data=array()){
        $sql = "select level from tbl_user_level where user_id = '".(int)$data['user_id']."';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }
   
}

?>
