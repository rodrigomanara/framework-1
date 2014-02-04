<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author rodrigo
 */
class CommonMenuModel extends Model {
    //put your code here
    
    /**
     * 
     * GetMenu
     * 
     * @name GetMenu for Pacient Model
     * @param string $parent the sistem will only acept this type of string
     * @param array __parent key
     */
    public function getMenu($data = array()) {
        $sql = "SELECT  `url`,`name`,`parent` FROM `tbl_menu` WHERE `parent` like '%" . $data['__parent'] . "%'";

        $query = $this->db->query($sql);
        return $query->rows;
    }
    
}

?>
