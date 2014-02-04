<?php

/**
 * Description of manager
 *
 * @author rodrigo
 */
class AccountManagerModel extends Model {

    public function clientes() {
        $sql = "select name , user_id from tbl_user";
        $query = $this->db->query($sql);
        $row = $query->rows;
        unset($sql);
        return $row;
    }

    public function checkaccount($id) {
        $sql = "select count(0)  from tbl_account where user_id = '" . $id . "'";
        $query = $this->db->query($sql);
        unset($sql);
        return $query->row;
    }

    public function createaccount($data = array()) {
        $sql = "insert into tbl_account (subdomain,user_id,open_account,db_client_setup) 
            VALUES ((select account_name  from tbl_account_request where user_id = '" . (int) $data['user_id'] . "')," . $data['user_id'] . ",now(),0)";
        $this->db->query($sql);
        unset($sql);

        $sql = "update tbl_account_request set approved = 1 where user_id = '" . (int) $data['user_id'] . "'";
        $this->db->query($sql);
        unset($sql);
    }

    public function selectaccoutrequestpendentes($data = array()) {
        $sql = "select a.name , a.user_id , if(isnull(b.approved ), 2 ,b.approved) as approved, b.account_name , a.email from  tbl_user a left join  tbl_account_request  b on a.user_id = b.user_id where (b.approved = 0 or isnull(b.approved))";
        // print($sql);
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function selectaccount($data = array()) {
        $sql = "SELECT b.name, a.subdomain, a.open_account , b.user_id , a.account_id FROM tbl_account a INNER JOIN tbl_user b ON a.user_id = b.user_id ";

        if (isset($data['user_id'])) {
            $sql .= " WHERE a.user_id = '" . $data['user_id'] . "';";
        } else {
            $sql .= " WHERE a.db_client_setup = '" . $data['db_not_set'] . "';";
        }
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function selectaccountrequest($data = array()) {
        $sql = "";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function accoutsetupdbsetting($data = array()) {
        $sql = "insert into tbl_account_settings ( account_id ,user_id ,db_settings,root) VALUES ( '" . $data['account_id'] . "' ,'" . $data['user_id'] . "' ,'" . $data['db_settings'] . "' ,'" . $data['root'] . "');";
        $this->db->query($sql);

        unset($sql);
        $sql = "update tbl_account SET db_client_setup = 1 WHERE user_id = '" . $data['user_id'] . "'";
        $this->db->query($sql);
        unset($sql);
    }

}

?>
