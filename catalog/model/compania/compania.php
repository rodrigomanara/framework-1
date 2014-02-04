<?php

class CompaniaCompaniaModel extends Model {

    public function addcompania($data = array()) {

        $sql = "insert into tbl_compania (compania ,cnpj) VALUES ( '" . $this->db->escape($data['compania']) . "' ,'" . $this->db->escape($data['cnpj']) . "' )";
        $this->db->query($sql);

        $sql = "insert into tbl_compania_dados ( rua ,numero ,bairro  ,uf ,cidade ,naturalidade ,descricao , cmc) 
            VALUES ( '" . $this->db->escape($data['rua']) . "'  
                    ,'" . $this->db->escape($data['numero']) . "'  
                    ,'" . $this->db->escape($data['bairro']) . "' 
                    ,'" . $this->db->escape($data['uf']) . "' 
                    ,'" . $this->db->escape($data['cidade']) . "' 
                    ,'" . $this->db->escape($data['naturalidade']) . "' 
                    ,'" . $this->db->escape($data['descricao']) . "'
                    ,'" . $this->db->escape($data['cmc']) . "')    ";
        $this->db->query($sql);
    }

     

    public function selectcompania($data = array()) {
        $sql = "SELECT a.compania , a.cnpj , b.id_compania FROM    tbl_compania a INNER JOIN tbl_compania_dados b ON a.id_compania = b.id_compania WHERE a.compania LIKE '" . $this->db->escape($data['descricao']) . "' OR a.cnpj = '" . $this->db->escape($data['descricao']) . "';";
        $query = $this->db->query($sql);
        $row = $query->rows;
        return $row;
    }

    /* edita compania section */
    public function selectcompaniaEdit($data = array()) {

        $sql = "SELECT a.compania,
                    a.cnpj,
                    b.id_compania,
                    b.rua,
                    b.numero,
                    b.bairro,
                    b.uf,
                    b.cidade,
                    b.naturalidade,
                    b.descricao,
                    b.cmc
               FROM    tbl_compania a
                    INNER JOIN
                       tbl_compania_dados b
                    ON a.id_compania = b.id_compania
              WHERE a.id_compania =" . (int) $data['id_compania'] . " ;";


        $query = $this->db->query($sql);
        $row = $query->row;

        return $row;
    }
    public function updateCompania($data){
        $sql = "update  tbl_compania set 
            compania = '" . $this->db->escape($data['compania']) . "' 
            where id_compania= " . (int) $data['id_compania'] . ";";
        $this->db->query($sql);

        $sql = "update  tbl_compania_dados set rua ='" . $this->db->escape($data['rua']) . "'
            ,numero ='" . $this->db->escape($data['numero']) . "' 
            ,bairro = '" . $this->db->escape($data['bairro']) . "' 
            ,uf ='" . $this->db->escape($data['uf']) . "' 
            ,cidade= '" . $this->db->escape($data['cidade']) . "' 
            ,naturalidade= '" . $this->db->escape($data['naturalidade']) . "' 
            ,descricao= '" . $this->db->escape($data['descricao']) . "' 
            , cmc='" . $this->db->escape($data['cmc']) . "' 
            where id_compania= '" . (int) $data['id_compania'] . "';";    
        $this->db->query($sql);
    }
    
    public function selectcandidato($data = array()) {

        $array = array();

        if (!empty($data['procuracandidato']) or !is_null($data['procuracandidato'])) {
            $sql = "SELECT a.nome,
                a.rg,
                a.cpf,
                a.id_candidato,
                b.rua,
                b.casa_numero,
                b.bairro,
                b.uf,
                b.cidade,
                b.nome_mae,
                b.nome_pai,
                b.naturalidade,
                b.objetivo,
                b.telefone1,
                b.telefone2,
                d.status,
                c.image
           FROM tbl_candidato a
                INNER JOIN tbl_candidato_dados b
                   ON a.id_candidato = b.id_candidato
                INNER JOIN tbl_candidato_dados_extra c
                   ON b.id_candidato = c.id_candidato
                INNER JOIN tbl_candidato_to_compania e
                   ON e.id_candidato = a.id_candidato
                LEFT JOIN tbl_candidato_status d
                   ON d.id_status = c.id_status
                 WHERE (a.nome LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                     OR a.rg LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                         OR a.cpf LIKE '" . $this->db->escape($data['procuracandidato']) . "')";
            $sql .=" AND e.id_compania = '" . (int) $data['compania'] . "' ";
            $sql .= (isset($data['transferir']) && $data['transferir'] === true) ? " and d.position >= (SELECT max(position) FROM tbl_candidato_status)  " : "";
            $sql .= "limit 20; ";

            
            $query = $this->db->query($sql);
            $row_select = $query->rows;

            $array['data'] = $row_select;
            unset($row_select);
            unset($sql);
            unset($query);

            $sql = "SELECT count(0) as total FROM tbl_candidato a 
                INNER JOIN tbl_candidato_dados b ON a.id_candidato = b.id_candidato 
                INNER JOIN tbl_candidato_dados_extra c ON b.id_candidato = c.id_candidato 
                 INNER JOIN tbl_candidato_to_compania e  ON e.id_candidato = a.id_candidato
                WHERE (a.nome LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                     OR a.rg LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                         OR a.cpf LIKE '" . $this->db->escape($data['procuracandidato']) . "')";
            $sql .=" AND e.id_compania = '" . (int) $data['compania'] . "' ";

            $query = $this->db->query($sql);
            $row = $query->row['total'];
            $array['total'] = $row;

            unset($row);
            unset($sql);
            unset($query);
        }
        return $array;
    }

    /*     * ******
     * 
     * Este funcao sera para deletar a compania e desvincular funcionario a empresa
     * deve ser feito varias verificacoes
     * 
     */

    public function deletecompania() {
        $sql = "";
        $this->db->query($sql);
    }

}

?>
