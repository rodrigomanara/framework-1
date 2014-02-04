<?php

class CandidatoCandidatoModel extends Model {

    public function getCandidatoHomeStatus() {
        $sql = "select c.status , count(0) as total from tbl_candidato a inner join tbl_candidato_dados_extra b
                on a.id_candidato = b.id_candidato
                inner join tbl_candidato_status c
                on b.id_status = c.id_status
                group by c.status;";

        $query = $this->db->query($sql);
        $row = $query->rows;

        return $row;
    }

    public function getCandidatoHomeStatusProcuracandidatoSelect() {
        $sql = "select id_status , status from tbl_candidato_status  ;";

        $query = $this->db->query($sql);
        $row = $query->rows;

        return $row;
    }

    public function addcandidato($data = array()) {

        $sql = "insert into tbl_candidato ( nome,rg ,cpf) VALUES 
            ( '" . $this->db->escape($data['nome']) . "' 
            ,'" . $this->db->escape($data['rg']) . "'  
                ,'" . $this->db->escape($data['cpf']) . "' );";
        $this->db->query($sql);
        $id = $this->db->getLastId();

        list($dia, $mes, $ano) = explode("/", $data['data_nascimento']);
        list($dia1, $mes1, $ano1) = explode("/", $data['data_expedicao']);

        $sql = "insert into tbl_candidato_dados (rua ,casa_numero ,bairro ,uf ,cidade ,nome_mae 
            ,nome_pai ,naturalidade ,objetivo ,telefone1,telefone2 , data_criacao
            ,data_expedicao , orgao , data_nascimento, cep
            ) VALUES 
            ('" . $this->db->escape($data['rua']) . "' 
            ,'" . $this->db->escape($data['casa_numero']) . "' 
            ,'" . $this->db->escape($data['bairro']) . "' 
            ,'" . $this->db->escape($data['uf']) . "' 
            ,'" . $this->db->escape($data['cidade']) . "' 
            ,'" . $this->db->escape($data['nome_mae']) . "'
            ,'" . $this->db->escape($data['nome_pai']) . "'
            ,'" . $this->db->escape($data['naturalidade']) . "' 
            ,'" . $this->db->escape($data['objetivo']) . "' 
            ,'" . $this->db->escape($data['telefone1']) . "'
            ,'" . $this->db->escape($data['telefone2']) . "'
            , now()
            ,data_expedicao = '" . $this->db->escape($ano1 . $mes1 . $dia1) . "'
            ,'" . $this->db->escape($data['orgao']) . "'
           ,data_nascimento = '" . $this->db->escape($ano . $mes . $dia) . "'
            ,'" . $this->db->escape($data['cep']) . "'
             );";
        $this->db->query($sql);

        $sql = "insert into tbl_candidato_dados_extra (image) VALUES 
            ('" . $this->db->escape($data['image']) . "');";
        $this->db->query($sql);
        
        unset($data);
        unset($sql);

        
        return $id;
        
    }

    public function checkcandidato($data = array()) {
        $sql = "select count(0) as total from tbl_candidato where rg = '" . $this->db->escape($data['rg']) . "' or cpf = '" . $this->db->escape($data['cpf']) . "';";
        $query = $this->db->query($sql);
        $row = $query->row['total'];
        return ((int) $row == 0) ? false : true;
    }

    public function deletecandidato($data = array()) {
        (boolean) $boolean = false;
        $sql[] = "delete from tbl_candidato where id_candidato = '" . $data['id_candidato'] . "';";
        $sql[] = "delete from tbl_candidato_dados where id_candidato = '" . $data['id_candidato'] . "';";
        $sql[] = "delete from tbl_candidato_dados_extra where id_candidato = '" . $data['id_candidato'] . "';";
        $sql[] = "delete from tbl_candidato_to_compania where id_candidato = '" . $data['id_candidato'] . "';";

        foreach ($sql as $sqls) {
            if ($this->db->query($sqls)) {
                $boolean = true;
            }
        }

        return $boolean;
    }

    public function updatecandidato($data = array()) {
        $sql[] = "update tbl_candidato SET  nome = '" . $this->db->escape($data['nome']) . "'
                ,rg = '" . $this->db->escape($data['rg']) . "'
                ,cpf = '" . $this->db->escape($data['cpf']) . "' 
                WHERE id_candidato = '" . $this->db->escape($data['id_candidato']) . "' ;";


        list($dia, $mes, $ano) = explode("/", $data['data_nascimento']);
        list($dia1, $mes1, $ano1) = explode("/", $data['data_expedicao']);

        $sql[] = "update  tbl_candidato_dados SET rua = '" . $this->db->escape($data['rua']) . "'
                   ,casa_numero = '" . $this->db->escape($data['casa_numero']) . "'
                   ,bairro = '" . $this->db->escape($data['bairro']) . "'
                   ,uf = '" . $this->db->escape($data['uf']) . "'
                   ,cidade = '" . $this->db->escape($data['cidade']) . "'
                   ,nome_mae = '" . $this->db->escape($data['nome_mae']) . "'
                   ,nome_pai = '" . $this->db->escape($data['nome_pai']) . "'
                   ,naturalidade = '" . $this->db->escape($data['naturalidade']) . "'
                   ,objetivo = '" . $this->db->escape($data['objetivo']) . "'
                   ,telefone1 = '" . $this->db->escape($data['telefone1']) . "'
                   ,telefone2 = '" . $this->db->escape($data['telefone2']) . "'
                   ,cep = '" . $this->db->escape($data['cep']) . "'
                   ,data_nascimento = '" . $this->db->escape($ano . $mes . $dia) . "'
                   ,data_expedicao = '" . $this->db->escape($ano1 . $mes1 . $dia1) . "'
                   ,orgao = '" . $this->db->escape($data['orgao']) . "'
                   
                    WHERE id_candidato = '" . $this->db->escape($data['id_candidato']) . "';";

        $sql[] = "update tbl_candidato_dados_extra SET image = '" . $this->db->escape($data['image']) . "' WHERE id_candidato = '" . $this->db->escape($data['id_candidato']) . "';";


        for ($i = 0; $i < count($sql); $i++) {

            $this->db->query($sql[$i]);
        }
    }

    public function selectcandidato($data = array()) {

        $array = array();
        if (!empty($data['procuracandidato']) or !is_null($data['procuracandidato'])) {
            $sql = "SELECT distinct a.nome,
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
                        LEFT JOIN tbl_candidato_status d
                           ON d.id_status = c.id_status
                         left JOIN tbl_candidato_to_compania e
                              ON e.id_candidato = a.id_candidato
                 WHERE (a.nome LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                     OR a.rg LIKE '" . $this->db->escape($data['procuracandidato']) . "'  
                         OR a.cpf LIKE '" . $this->db->escape($data['procuracandidato']) . "') 
                             AND e.id_compania is null ";
            if (isset($data['status']) and $data['status'] !== "")
                $sql .= " and d.id_status = '" . $this->db->escape($data['status']) . "'";
            $sql .= (isset($data['transferir']) && $data['transferir'] === true) ? " and d.position >= (SELECT max(position) FROM tbl_candidato_status)  " : "";
            $sql .=" order by a.nome asc limit " . (isset($data['page']) ? $data['page'] : 0 ) . " ,5;";

            $query = $this->db->query($sql);
            $row_select = $query->rows;

            $array['data'] = $row_select;
            unset($row_select);
            unset($sql);
            unset($query);

            $sql = "SELECT distinct count(0) as total FROM tbl_candidato a
                        INNER JOIN tbl_candidato_dados b
                           ON a.id_candidato = b.id_candidato
                        INNER JOIN tbl_candidato_dados_extra c
                           ON b.id_candidato = c.id_candidato
                        LEFT JOIN tbl_candidato_status d
                           ON d.id_status = c.id_status
                         left JOIN tbl_candidato_to_compania e
                              ON e.id_candidato = a.id_candidato
                 WHERE (a.nome LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                     OR a.rg LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                          OR d.status LIKE '" . $this->db->escape($data['procuracandidato']) . "' 
                         OR a.cpf LIKE '" . $this->db->escape($data['procuracandidato']) . "') 
                             AND e.id_compania is null ";

            if (isset($data['status']) and $data['status'] !== "")
                $sql .= " and d.id_status = '" . $this->db->escape($data['status']) . "'";
            $sql .= (isset($data['transferir']) && $data['transferir'] === true) ? " and d.position >= (SELECT max(position) FROM tbl_candidato_status)   " : "";
 
            $query = $this->db->query($sql);
            $row = $query->row['total'];
            $array['total'] = $row;

            unset($row);
            unset($sql);
            unset($query);
        }
        return $array;
    }

    public function selecteditcandidato($data = array()) {

        $sql = "SELECT a.nome,
                    a.rg,
                    a.cpf,
                    a.id_candidato,
                    b.id_candidato,
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
                    b.data_criacao,
                    b.data_expedicao,
                    b.orgao,
                    b.data_nascimento,
                    b.cep,
                    c.image
               FROM tbl_candidato a
                    INNER JOIN tbl_candidato_dados b
                       ON a.id_candidato = b.id_candidato
                    INNER JOIN tbl_candidato_dados_extra c
                       ON b.id_candidato = c.id_candidato
              WHERE a.id_candidato =  '" . (int) $data['procuracandidato'] . "'; ";
        $query = $this->db->query($sql);
        return $row_select = $query->row;
    }

    public function selectautocompletecandidato($data = array()) {

        $sql = "select a.nome , a.rg , a.cpf , c.image from tbl_candidato a inner join tbl_candidato_dados b on
                a.id_candidato = b.id_candidato
                inner join tbl_candidato_dados_extra c
                on a.id_candidato = c.id_candidato
                where a.nome like '%" . $this->db->escate($data['procuracandidato']) . "%' 
                    or  a.rg like '%" . $data['procuracandidato'] . "%' or a.cpf like '%" . $data['procuracandidato'] . "%'; ";
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function transferir_funcionario_para_empresa($data = array()) {
        $sql = "insert into tbl_candidato_to_compania (id_compania ,id_candidato ) VALUES ('" . (int) $data['id_compania'] . "','" . (int) $data['id_candidato'] . "' )";
        $this->db->query($sql);
    }

    public function getListadeEmpresa($data = array()) {
        $sql = "select a.id_compania , a.compania from tbl_compania a inner join tbl_compania_dados b on a.id_compania = b.id_compania";
        $query = $this->db->query($sql);
        $row = $query->rows;

        return $row;
    }

    public function getTitulosNomes($data = array()) {

        if (isset($data['id_candidato'])) {
            $sql = "select b.position from tbl_candidato_dados_extra a inner join tbl_candidato_status b on a.id_status = b.id_status where a.id_candidato = '" . $data['id_candidato'] . "'";
            $query = $this->db->query($sql);
            $row = $query->row;
        }

        $sql = "select * from tbl_candidato_status";
        if (!empty($data) && isset($data['id_status'])) {
            $sql .= " where id_status = " . (int) $data['id_status'] . "";
        } elseif (isset($row['position'])) {
            $sql .= " where position >= " . (int) $row['position'] . "";
        }

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function alteraTitulo($data = array()) {
        $sql = "update tbl_candidato_dados_extra SET id_status = " . (int) $data['id_status'] . " WHERE id_candidato = " . (int) $data['id_candidato'] . ";";
        if ($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCandidatoImage($data = array()) {
        $sql = "select image from tbl_candidato_dados_extra where id_candidato = '" . (int) $data['id'] . "'";
        $query = $this->db->query($sql);
        return $query->row;
    }

}

?>
