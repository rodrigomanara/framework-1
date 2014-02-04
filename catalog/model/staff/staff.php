<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of staff
 *
 * @author rodrigo
 */
class AccountUserModel extends Model {

    /**
     * @see getRoles
     * @param type $data
     */
    
    public function addNewUser($data = array()) {
        $sql = "select count(0) as total from tbl_staff a inner join tbl_staff_extral b on a.id_staff = b.id_staff where b.email = '" . $this->db->escape($data['email']) . "';";
        $query = $this->db->query($sql);
        if ((int) $query->row['total'] === 0 && (int) $data['id_role'] >= 0) {

            try {

                $sql = "insert into tbl_staff ( name ,surname ,role , status ) VALUES ( '" . $this->db->escape($data['name']) . "','" . $this->db->escape($data['surname']) . "','" . $this->db->escape($data['id_role']) . "' , 1);";
                $this->db->ExecuteUpdate($sql);

                unset($sql);
                $date = date('Y-m-d H:s:1', strtotime($data['data_start']));
                $sql = "insert into tbl_staff_extral (email,data_start) VALUES ('" . $this->db->escape($data['email']) . "','" . $this->db->escape($date) . "');";
                $this->db->ExecuteUpdate($sql);

                $data['pass'] = '123123123';
                unset($sql);
                $sql = "insert into tbl_user ( name , email , password ) VALUES ('" . $this->db->escape($data['name']) . " " . $this->db->escape($data['surname']) . "','" . $data['email'] . "',md5('" . $data['pass'] . "'))";
                $this->db->ExecuteUpdate($sql);

                unset($sql);
                $sql = "insert into tbl_user_level ( user_id ,level ) VALUES (" . (int) $this->db->getLastId() . ",(select level from tbl_role where id_role = '" . $data['id_role'] . "'));";
                $this->db->ExecuteUpdate($sql);


                $sql = "SELECT a.id_staff, b.user_id
                          FROM tbl_staff_extral a INNER JOIN tbl_user b ON a.email = b.email
                         WHERE a.email = '" . $this->db->escape($data['email']) . "';";
                $query = $this->db->query($sql);

                unset($sql);
                $sql = "insert into tbl_user_staff (id_user,id_staff) VALUES (" . $query->row['user_id'] . " ," . $query->row['id_staff'] . " );";
                $this->db->ExecuteUpdate($sql);
                unset($sql);

                $sql = "insert into tbl_staff_agenda_cor ( id_staff ,cor ) VALUES ( " . $query->row['id_staff'] . "  ,'" . $this->db->escape($data['cores']) . "' );";
                $this->db->ExecuteUpdate($sql);
                unset($sql);

                return true;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } elseif (!is_int($data['id_role'])) {
            return "Antencao : Numero do Staff ( {$data['id_role']} ) nao encontrado!!!";
        } else {
            return "Antencao : Dados ja foram gravados anteriormente!!!";
        }
    }

    public function getName($data = array()) {

        $sql = "select * from tbl_user where user_id = '" . (int) ($data['user_id']) . "';";
        $query = $this->db->query($sql);
        return $query->row;
    }

    public function getListaFuncionarios($data = array()) {
        $sql = "SELECT 
                    c.name as profissao,
                    b.email,
                    b.data_start,
                    a.id_staff,
                    if(a.status > 0 , 'Ativo','Inativo') as status_nome,
                    a.status ,
                    concat(a.name,' ', a.surname) as nome
                             FROM tbl_staff a
                     INNER JOIN tbl_staff_extral b
                        ON a.id_staff = b.id_staff
                     INNER JOIN tbl_role c
                        ON c.id_role = a.role where (a.name like '%{$data['search']}%' 
                            or a.surname  like '%{$data['search']}%')  order by a.status desc ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getFuncionario($data = array()) {
        $sql = "SELECT c.name AS profissao,
                    b.email,
                    b.data_start,
                    a.id_staff,
                    a.name,
                    a.surname,
                    d.cor as cores,
                    c.id_role
               FROM tbl_staff a
                    INNER JOIN tbl_staff_extral b
                       ON a.id_staff = b.id_staff
                    INNER JOIN tbl_role c
                       ON c.id_role = a.role
                    INNER JOIN tbl_staff_agenda_cor d
                       ON d.id_staff = a.id_staff 
                    where a.id_staff = '{$data['id_staff']}';";

        $query = $this->db->query($sql);

        return $query->row;
    }

    public function updateFuncionario($data = array()) {
      $sql =   "UPDATE   tbl_staff a
             INNER JOIN
                tbl_staff_extral b
                    ON a.id_staff = b.id_staff
                 INNER JOIN
                    tbl_role c
                 ON c.id_role = a.role
              INNER JOIN
                 tbl_staff_agenda_cor d
              ON d.id_staff = a.id_staff
            SET a.name = '{$data['name']}',
                b.email = '{$data['email']}',
                a.surname = '{$data['surname']}',
                d.cor = '{$data['cores']}',
                a.role = '{$data['id_role']}'
          WHERE a.id_staff = '{$data['id_staff']}';";

        $this->db->ExecuteUpdate($sql);
    }

}

?>
