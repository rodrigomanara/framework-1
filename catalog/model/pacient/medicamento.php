<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PacientMedicamentoModel extends Model {

    /**
     * 
     */
    public function out_medicamento($data) {
        $sql = "select * from tbl_paciente_medicamentos where id_paciente ='" . $data['id_paciente'] . "'";
        $query = $this->db->query($sql);
        return $query->rows;
    }
    /**
     * 
     * @param type $data
     * @return boolean
     */
    public function in_medicamento($data) {

        $sql = "REPLACE into tbl_paciente_medicamentos (
                    id_paciente
                   ,id_med
                   ,data
                   ,servico
                   ,value
                   ,metodo
                   ,totalpago
                   ,quantidade
                   ,prescricao
                   ,dosagem
                 ) VALUES (
                    '" . $data['id_paciente'] . "'   -- id_paciente - IN int(11)
                   ,'" . $data['id_med'] . "'  -- id_med - IN int(11)
                   ,now()  -- data - IN timestamp
                   ,'" . $data['servico'] . "'  -- servico - IN text
                   ,'" . $data['value'] . "'   -- value - IN float
                   ,'" . $data['metodo'] . "'  -- metodo - IN varchar(20)
                   ,'" . $data['totalpago'] . "'   -- totalpago - IN float
                   ,'" . $data['quantidade'] . "'   -- quantidade - IN int(11)
                   ,'" . $data['prescricao'] . "'  -- prescricao - IN text
                   ,'" . $data['dosagem'] . "'  -- dosagem - IN varchar(20)
                 )";
        $this->db->ExecuteUpdate($sql);
        /*
          $sql = "REPLACE INTO tbl_paciente_financeiro ( id_paciente , servico ,value ,metodo ,totalpago ,quantidade) ";
          $sql .= "values (
          '" . $data['id_paciente'] . "'
          , '" . $data['servico'] . "'
          , '" . $data['value'] . "'
          , '" . $data['metodo'] . "'
          , '" . $data['totalpago'] . "'
          , '" . $data['quantidade'] . "' )";

          $this->db->ExecuteUpdate($sql);
         */

        $sql = "insert into tbl_estoque_venda (
                id_estoque
               ,quantidade
               ,data
               ,valor
             ) VALUES (
                '" . $data['id_estoque'] . "'   -- id_estoque - IN int(11)
               ,'" . $data['quantidade'] . "'   -- quantidade - IN int(11)
               ,now()  -- data - IN datetime
               ,'" . $data['value'] . "'  -- valor - IN float
             )";
        $this->db->ExecuteUpdate($sql);

        $sql = "update tbl_estoque SET quantidade = (quantidade - {$data['quantidade']})   WHERE id_estoque = '" . $data['id_estoque'] . "'  AND lote = '" . $data['lote'] . "'";
        $this->db->ExecuteUpdate($sql);
        return true;
    }

}

?>
