<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calendar
 *
 * @author rodrigo
 */
class CalendarCalendarModel extends Model {

    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function addToCalendar($data = array()) {
            
        $sql = "REPLACE INTO  
                tbl_calendar ( id_calendar , start_date ,end_date  ,descricao  ,id_paciente ,id_staff)
                VALUES (
                '" . (int) $data['id_calendar'] . "',
                '" . $data['start'] . "'
                ,'" . $data['end'] . "'
                ,'" . $this->db->escape($data['title']) . "' 
                ,'" . (int) $data['id_paciente'] . "'
                ,'" . (int) $data['id_staff'] . "');";
        $this->db->ExecuteUpdate($sql);

    }

    private function checkCalendar($data = array()) {
        $sql = "SELECT count(0) as `total`
                FROM    tbl_calendar a
                     
               WHERE a.start_date = '" . $data['start'] . "'
               AND a.end_date = '" . $data['end'] . "' 
                   AND a.id_paciente = '" . (int) $data['id_paciente'] . "';";

        $query = $this->db->query($sql);
        return ((int) $query->row['total'] === 0) ? true : false;
    }

    public function getCalendar($data = array()) {

        $sql = "SELECT a.id_calendar AS id,
       a.start_date AS `start`,
       a.end_date AS `end`,
       CASE
          WHEN concat(b.name,
                      b.surname,
                      c.nome,
                      a.descricao)
                  IS NULL
          THEN
             'falta dados'
          ELSE
             concat('Dr(a)' , b.name,
                    ' ',
                    b.surname,
                    ' |- Paciente :',
                    c.nome,
                    ' = ',
                    a.descricao)
       END
          AS title,
       'false' AS 'allDay',
       a.id_staff,
       a.id_calendar,
       a.id_paciente , 
       cor.cor
  FROM tbl_calendar a
       INNER JOIN tbl_staff b
          ON a.id_staff = b.id_staff
       LEFT JOIN tbl_paciente c
          ON c.id_paciente = a.id_paciente
       Left join tbl_staff_agenda_cor cor
          on cor.id_staff = a.id_staff
 WHERE 0 = 0 ";


        if (isset($data['id_calendar'])) {
            $sql .= " and a.id_calendar = '" . (int) $data['id_calendar'] . "'";
        }
        if (isset($data['id_paciente']) && (int) $data['id_paciente'] > 0) {
            $sql .= " and a.id_paciente = '" . $data['id_paciente'] . "'";
        }
        $sql .= ";";


        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getStaff($data = array()) {
        $sql = "SELECT *  FROM tbl_staff WHERE id_staff =  '" . (int) $data['id_staff'] . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getStaffs($data = array()) {
        $sql = "SELECT *  FROM tbl_staff WHERE name like  '%" . $this->db->escape($data['term']) . "%';";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * @see getStaffCalendar
     * @return type
     */
    public function getStaffCalendar() {
        $sql = "SELECT staff.name AS name,
                    staff.id_staff,
                    staff.surname,
                    role.level AS level,
                    color.cor,
                    role.level
               FROM tbl_staff staff
                    INNER JOIN tbl_role role
                       ON role.id_role = staff.role
                    INNER JOIN tbl_staff_agenda_cor color
                       ON color.id_staff = staff.id_staff
               where staff.status = 1
                ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getPaciente($data = array()) {
        $sql = "SELECT *
                FROM    tbl_paciente 
               WHERE id_paciente ='" . (int) $data['id_paciente'] . "'";

        $query = $this->db->query($sql);
        return $query->row;
    }

    public function getPacientes($data = array()) {
        $sql = "SELECT *  FROM tbl_paciente WHERE nome like  '%" . $this->db->escape($data['term']) . "%';";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * delete from tb calendar
     */
    public function excluirFromCalendar($data = array()) {
        $sql = "delete from tbl_calendar WHERE id_calendar ='" . $data['id_calendar'] . "'";
        $this->db->ExecuteUpdate($sql);
    }

}

?>
