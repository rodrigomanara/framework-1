<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menulateral
 *
 * @author rodrigo
 */
class ModelMenulateralModel extends Model {
    //put your code here
    
    public function menulateral($data = array()){
        $sql = "select name , url from tbl_menu where level ='".(int)$data."' ";
        $query = $this->db->query($sql);
        $row = $query->rows;
        
        return $row;
    }
    public function userlevel($data=array()){
        $sql = "select level from tbl_user_level where user_id = '".(int)$data['user_id']."';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }
}

?>
