<?php

/**
 * 
 */
class PacientStockModel extends Model {

    public function selectStock($data = array()) {
        $sql = "select * from tbl_estoque where 0=0";
        $sql .= isset($data['id_estoque']) ? " and id_estoque = '{$data['id_estoque']}'" : '';
        $query = $this->db->query($sql);
        return $query->rows;
    }
    public function out_medicamento(){
        
    }
    
    
}
?>
