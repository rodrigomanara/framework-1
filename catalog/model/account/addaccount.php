<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of addaccount
 *
 * @author rodrigo
 */
class AccountAddaccountModel extends Model {

    //put your code here
    var $user_total;
    /**
     * addaccount
     * 
     * 
     *  */
    public function addaccount($data) {

        $sql = "select count(0)total from tbl_user  where email = '" . $this->db->escape($data['email']) . "';";
        $query = $this->db->query($sql);
        $this->user_total = (int) $query->row['total'];

        if ($this->user_total == 0) {
            $sql = "insert into tbl_user ( name , email , password ) VALUES ('" . $data['name'] . "','" . $data['email'] . "',md5('" . $data['pass'] . "'))";
            $this->db->ExecuteUpdate($sql);

            unset($sql);
            $sql = "insert into tbl_user_level ( user_id ,level ) VALUES (" . (int) $this->db->getLastId() . ",0 );";
            $this->db->ExecuteUpdate($sql);

            return true;
        } else {
            return false;
        }
    }

    public function check_user($data) {
        $sql = "select count(0)total from tbl_user  where email = '" . $this->db->escape($data['email']) . "';";
        $query = $this->db->query($sql);
        return (int) $query->row['total'];
    }

}

?>
