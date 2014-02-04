<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AccountMenuModel extends Model {

    /**
     * AddMenuModel
     * 
     * @param
     * @todo "insert into tbl_menu (  parent ,name ,url )"
     * @comments [__parent (string limit 40 caracters) , __name (string 40 caracters) , __url(string text)]
     */
    public function AddMenuModel($data = array()) {

        $sql = "insert into tbl_menu (  parent ,name ,url , `level` ) VALUES ( '" . $data['__parent'] . "' ,'" . $data['__name'] . "'  ,'" . $data['__url'] . "' , '" . $data['__level'] . "')";
        return $this->db->ExecuteUpdate($sql);
        unset($sql);
    }

    /**
     * EditMenuModel
     * @param
     * @todo "update tbl_menu (  parent ,name ,url ) where id_menu = id"
     * @comments [__parent (string limit 40 caracters) , __name (string 40 caracters) , __url(string text)]
     */
    public function EditMenuModel($data) {
        $sql = "update  tbl_menu set
            parent ='" . $data['__parent'] . "'
            ,name  ='" . $data['__name'] . "'
            ,url   ='" . $data['__url'] . "';";
        return $this->db->ExecuteUpdate($sql);
        unset($sql);
    }

    /**
     * checkMenuExistModel
     * 
     * @param
     * @todo [checkMenuExist = able to check is the menu already existe or not on the db]
     * @Comments  Allways use: __name , __parent
     * @return int [if is equal 0 then the return is false(donot exist) ,  if is equal 1 then the return is false(do exist)]
     */
    public function checkMenuExistModel($data = array()) {

        $sql = "select count(0) from tbl_menu where name like '%" . $data['__name'] . "%' and parent like '%" . $data['__parent'] . "%';";
        $query = $this->db->query($sql);
        return $query->row;
    }

    /**
     * GetMenu
     * 
     * @param
     * @todo [checkMenuExist = able to check is the menu already existe or not on the db]
     * @Comments  Allways use: __name , __parent
     * @return int [if is equal 0 then the return is false(donot exist) ,  if is equal 1 then the return is false(do exist)]
     */
    public function GetMenu($data = array()) {
        $sql = "SELECT `id_menu`,`name`,`parent`,`url` FROM `tbl_menu`;";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * LevelMenu
     * 
     * @comments this is to add new level to manage the mesnu and access level
     * 
     */
    public function setMenuLevel($data = array()) {
        // $sql = "insert into tbl_level (level ) VALUES ('" . (int) $data['__level'] . "');";
        //$this->db->ExecuteUpdate($sql); 
        //unset($sql);

        $sql = "insert into tbl_role (name,level) VALUES ( '" . $data['__name'] . "', '" . (int) $data['__level'] . "');";
        $this->db->ExecuteUpdate($sql);
        unset($sql);
    }

    /**
     * 
     */

    /**
     * 
     */
    public function getRoleLevel() {
        $sql = "select * from tbl_role;";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getMenuLevel($data = array()) {
        $sql = "select * from tbl_level where name like '%" . $data['__name'] . "%'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    /**
     * upDateMenuLevel
     * 
     * @param type $data
     * @return array
     */
    public function upDateMenuLevel($data = array()) {
        $sql = "update tbl_level SET name = '" . $data['__name'] . "'  level = '" . $data['__level'] . "'; WHERE id_level = '" . $data['__id_level'] . "'";
        $this->db->ExecuteUpdate($sql);
    }

    /** **************************************************
     *  ===========  Menu Manage Section =======
     * 
     * @param type $data
     * @return type
     */
    public function getMenuSingleReturn($data) {
        $sql = "SELECT *  FROM tbl_menu  WHERE id_menu = '" . $data['id_menu'] . "';";
        $query = $this->db->query($sql);
        return $query->row;
    }
    /**
     * deleteMenuLevel
     * 
     */
    public function deleteMenuLevel($data = array()) {
        $sql = "delete from tbl_level WHERE id_level = '" . $data['__name'] . "';";
        $this->db->ExecuteUpdate($sql);
    }
    /**
     *  Menu Settings 
     * 
     */
    public function menuUpdate($data = array()) {
        $sql = "replace into tbl_menu (id_menu ,parent ,name ,url,level) VALUES (
            '" . $this->db->escape($data['id_menu']) . "'
            ,'" . $this->db->escape($data['__parent']) . "' 
            ,'" . $this->db->escape($data['__name']) . "' 
            ,'" . $this->db->escape($data['__url']) . "' 
            ,'" . $this->db->escape($data['__level']) . "' )";
        $this->db->ExecuteUpdate($sql);
    }
    
    /**
     * ======== Profissao Section =====
     */
    public function Profissao($data = array()) {
        $sql = "replace into tbl_role (id_role,name ,level) VALUES ('{$data['id_role']}','{$this->db->escape($data['__name'])}','{$data['__level']}');";
        $this->db->ExecuteUpdate($sql);
    }

    public function SelectProfissao($data = array()) {
        $sql = "select * from  tbl_role where id_role='{$data['id']}';";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function SelectTodosProfissao() {
        $sql = "select * from  tbl_role;";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function deleteProfissao($data) {
        $sql = "delete from tbl_role where id_role='{$data['id_role']}';";
        $this->db->ExecuteUpdate($sql);
    }

}

?>
