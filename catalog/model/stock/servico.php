<?php

class StockServicoModel extends Model {

    public function ServicoUpdate($data = array()) {
        try {
            $sql = "replace into tbl_servico (
            id_servico
           ,nome
           ,descricao
           ,data
           ,`valor`
           ) VALUES (
            {$data['id_servico']}   -- id_servico - IN int(11)
           ,'" . $this->db->escape($data['nome']) . "'  -- nome - IN varchar(60)
           ,'" . $this->db->escape($data['descricao']) . "'  -- descricao - IN text
           ,now()  -- data - IN datetime
           ,{$data['valor-unitario']}   -- valor-unitario - IN float
            )";
            $this->db->ExecuteUpdate($sql);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectServicoAll($data = array()) {
        $sql = "select * from tbl_servico";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    /**
     * @see Dados de estoque
     * @param array $data
     * @return array
     */
    public function selectServico($data = array()) {
       
        $sql = "SELECT  id_servico, nome, descricao, date_format(data,'%d/%c/%Y') as data, format(valor, 2) as valor FROM tbl_servico";
        $sql .= " WHERE 0=0";
        $sql .= isset($data['titulo']) && !empty($data['titulo']) ? " AND nome like '%{$data['titulo']}%'" : '';
        $sql .= isset($data['id_servico']) && !empty($data['id_servico']) ? " AND id_servico = '{$data['id_servico']}'" : '';
    
        $sql .= ";";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function delete($data = array()) {
        try {
            $sql = "delete from tbl_servico WHERE id_servico = '{$data['id_servico']}';";
            $this->db->ExecuteUpdate($sql);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}

?>
