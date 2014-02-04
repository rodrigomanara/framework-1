<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author rodrigo
 */
class AccountLoginModel extends Model {
    //put your code here
    
     public function checkemail($data = array()){
        
        $sql = "select count(0) as total from tbl_user where email = '".$this->db->escape($data['email'])."';";
        $query = $this->db->query($sql);
        $row = $query->row['total'];
        return $row;
    }
    
    public function user($data = array()){
        $sql = "select *  from tbl_user where email = '".$this->db->escape($data['email'])."';";
        $query = $this->db->query($sql);
        $row = $query->row['user_id'];
        return $row;
    }
    
    public function login($data = array()){
        
        $sql = "select count(0) as total from tbl_user where email = '".$this->db->escape($data['email'])."'
            and password = md5('".$this->db->escape($data['pass'])."');";
 
        $query = $this->db->query($sql);
        $row = $query->row['total'];
        return $row;
    }
    public function user_id($data = array()){
        $sql = "select user_id  from tbl_user where email = '".$this->db->escape($data['email'])."';";
        $query = $this->db->query($sql);
        $row = $query->row['user_id'];
        return $row;
    }
    public function forgot($data){
        $sql = "select email , name  from tbl_user where email = '".$this->db->escape($data['email'])."';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }
    public function resetPass($data = array()){
        $sql ="update tbl_user SET password = md5('".$data['__rm-password']."') WHERE user_id = '".(int)$data['__rm-u']."';";
        $this->db->ExecuteUpdate($sql);
    }
    
     public function userlevel($data=array()){
        $sql = "select b.level  as level from tbl_user a inner join tbl_user_level b on a.user_id = b.user_id where a.email =  '".$this->db->escape($data['email'])."';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }
     public function databasesetup($data = array()){
        $sql = "SELECT if(count(db_settings) = 0, 'null', db_settings) AS db_settings FROM tbl_account_settings  WHERE account_id = '".(int)$data['user_id']."';";
        $query = $this->db->query($sql);
        $row = $query->row['db_settings'];
        return $row;
    }
}

?>
