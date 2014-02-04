<?php

class StockStockModel extends Model {

    public function StockUpdate($data = array()) {
        try {
            $date = explode("/", $data['data']);
            $calendario = date('Y-m-d H:i:s', mktime(0, 0, 0, $date[1], $date[0], $date[2]));

            $sql = "replace into tbl_estoque (
            id_estoque
           ,nome
           ,quantidade
           ,descricao
           ,barcode
           ,data
           ,`valor`
           ,lote
         ) VALUES (
            {$data['id_estoque']}   -- id_estoque - IN int(11)
           ,'" . $this->db->escape($data['nome']) . "'  -- nome - IN varchar(60)
           ,{$data['quantidade']}   -- quantidade - IN int(11)
           ,'" . $this->db->escape($data['descricao']) . "'  -- descricao - IN text
           ,'" . $this->db->escape($data['barcode']) . "'  -- barcode - IN varchar(14)
           ,'{$calendario}'  -- data - IN datetime
           ,{$data['valor-unitario']}   -- valor-unitario - IN float
           ,{$data['lote']}
            )";
            $this->db->ExecuteUpdate($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectStockAll($data = array()) {
        $sql = "select * from tbl_estoque";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * @see Dados de estoque
     * @param array $data
     * @return array
     */
    public function selectStock($data = array()) {
       
        $sql = "SELECT lote, id_estoque, nome, quantidade, descricao, barcode, date_format(data,'%d/%c/%Y') as data, format(valor, 2) as valor FROM tbl_estoque";
        $sql .= " WHERE 0=0";
        $sql .= isset($data['titulo']) && !empty($data['titulo']) ? " AND nome like '%{$data['titulo']}%'" : '';
        $sql .= isset($data['quantidade']) && !empty($data['quantidade']) ? " AND quantidade = '{$data['quantidade']}'" : '';
        $sql .= isset($data['barcode']) && !empty($data['barcode']) ? " AND barcode = '{$data['barcode']}'" : '';
        $sql .= isset($data['data-validade']) && !empty($data['data-validade']) ? " AND data = '{$data['data-validade']}'" : '';
        $sql .= isset($data['id_estoque']) && !empty($data['id_estoque']) ? " AND id_estoque = '{$data['id_estoque']}'" : '';
        $sql .= isset($data['lote']) && !empty($data['lote']) ? " AND lote = '{$data['lote']}'" : '';

        $sql .= ";";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function delete($data = array()) {
        try {
            $sql = "delete from tbl_estoque WHERE id_estoque = '{$data['id_estoque']}'  AND lote = '{$data['lote']}';";
            $this->db->ExecuteUpdate($sql);

            $sql = "delete from tbl_estoque_contar WHERE id_estoque = '{$data['id_estoque']}'";
            $this->db->ExecuteUpdate($sql);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
