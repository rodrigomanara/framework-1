<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author rodrigo
 */
class AccountHomeModel extends Model {

    public function accoutrequestcheck($data =array()){
        $sql = "select if(count(0) = 0 , false , true) as boolean from tbl_account_request where user_id = '".$data['user_id']."';";
        $query = $this->db->query($sql);
        $row = $query->row;
        return $row;
    }
    public function accountrequestadd($data = array()) {
        $sql = "insert into tbl_account_request (account_name,user_id,limitation,enquiries_email ) VALUES ( '".$data['__rm-domain']."','".$data['__rm-u']."','10000','".$data['__rm-email-enquiries']."');";
        $query = $this->db->query($sql);
        return ($query === true) ? true : false;
    }
    public function accountrequestupdate($data = array()){
        $sql = "UPDATE tbl_account_request  SET account_name = '".$data['__rm-domain']."', enquiries_email = '".$data['__rm-email-enquiries']."' WHERE user_id = '".$data['__rm-u']."'";
        $this->db->query($sql);
    }
    public function accountrequestselect($data = array()){
        $sql = "select * from tbl_account_request where user_id = '".$data['user_id']."';";
        $query = $this->db->query($sql);
        $row = $query->row; 
        return $row;
    }
    
    /**
     *  account details part 
     */
    public function accountdetaisselect($data = array()){
        $sql = "SELECT *  FROM tbl_user  WHERE user_id = '".$data['user_id']."';";
        $query = $this->db->query($sql);
        return $query->row;
    }
    
    /**
     * 
     *  Accoutn security 
     * 
     * @comments
     
     * *****/
    public function accountaccountsecurityupdate($data = array()){
        $sql ="update tbl_user SET password = md5('".$data['__rm-password']."') WHERE user_id = '".$data['__rm-u']."';";
        $this->db->ExcuteUpdate($sql);
    }
    
    
    /* select account */
    public function selectaccount($data = array()){
        $sql ="select * from tbl_account where user_id = '".$data['user_id']."' and db_client_setup = '".$data['db_client_setup']."'";
        $query = $this->db->query($sql);
        $row = $query->row;
        
        return $row;
    }

}

?>
