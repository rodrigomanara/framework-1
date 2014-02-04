<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FinanceFinanceModel extends Model {

    /**
     * 
     * @return type array
     */
    public function selectServicosMedicos() {
        $sql = "SELECT nome , servico , value , metodo , quantidade , totalpago 
                    FROM tbl_calendar cal
                         INNER JOIN tbl_paciente p
                            ON cal.id_paciente = p.id_paciente
                         INNER JOIN tbl_staff st
                            ON st.id_staff = cal.id_staff
                         INNER JOIN tbl_paciente_financeiro pf
                            ON pf.id_paciente = p.id_paciente
                               AND date_format(pf.data, '%d%b%Y') = date_format(cal.start_date, '%d%b%Y') 
                   WHERE 0 = 0";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * 
     * @param type $data array
     * @return type array
     */
    public function SelectSaldos($data = array()) {
        $array = array();

        if (isset($data['data-max']) && !empty($data['data-max'])) {
            $date = explode("-", $data['data-max']);
            $date_max = $date[1] . '/' . $date[0] . '/' . $date[2];
        } else {
            $date_max = null;
        }

        if (isset($data['data-min']) && !empty($data['data-min'])) {
            $date = explode("-", $data['data-min']);
            $date_min = $date[1] . '/' . $date[0] . '/' . $date[1];
        } else {
            $date_min = null;
        }

        /** servico */
        $sql = "select servico , value , metodo , quantidade , totalpago  
            from tbl_paciente_financeiro   where 0=0";

        if (!empty($date_min) or !empty($date_max))
            $sql .= " and data between '{$date_min}' and '{$date_max}'";

        $query1 = $this->db->query($sql);

        foreach ($query1->rows as $key => $value) {
            $_dado[$key] = $value;
            array_push($array, $_dado[$key]);
        }

        /*         * * Medicamento ** */



        $sql = "select servico , value , metodo , quantidade , totalpago  
            from tbl_paciente_medicamentos  where 0=0";

        if (!empty($date_min) or !empty($date_max))
            $sql .= " and data between '{$date_min}' and '{$date_max}'";


        $query2 = $this->db->query($sql);

        foreach ($query2->rows as $key => $value) {
            $_dado[$key] = $value;
            array_push($array, $_dado[$key]);
        }
        
        return $array;
    }

    public function metodos() {
        $sql = "select metodo from tbl_paciente_medicamentos group by metodo;";
        $query = $this->db->query($sql);
        return $query->rows;
    }

}

?>
