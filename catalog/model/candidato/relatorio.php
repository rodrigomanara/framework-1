<?php
class CandidatoRelatorioModel extends Model {
    
    public function relatoriospccriminal() {
        $sql = "SELECT DISTINCT a.nome as 'Nome do Candidato',
                        a.rg as 'RG',
                        a.cpf as 'CPF',
                        b.rua as 'Rua',
                        b.casa_numero as 'Numero',
                        b.bairro as 'Bairro',
                        concat(mid(b.cep , 1 , 5),'-',mid(b.cep , 6 , 3)) as 'Cep',
                        b.cidade as 'Cidade',
                        b.nome_mae as 'Nome da Mae',
                        b.nome_pai as 'Nome do Pai',
                        b.naturalidade as 'Naturalidade',
                        b.uf as 'UF',
                        b.objetivo as 'Objetivo'
          FROM tbl_candidato a
               INNER JOIN tbl_candidato_dados b
                  ON a.id_candidato = b.id_candidato
               INNER JOIN tbl_candidato_dados_extra c
                  ON a.id_candidato = c.id_candidato
               left JOIN tbl_candidato_status d
                        ON d.id_status = c.id_status
           WHERE (c.id_status IS NULL OR d.`position` = 0);";

        $query = $this->db->query($sql);
        $row = $query->rows;
        return $row;
    }
    
    public function relatoriospccriminaldashboard() {

        $sql = "SELECT count(0) as total,  b.data_criacao , b.uf
                FROM tbl_candidato a
                     INNER JOIN tbl_candidato_dados b
                        ON a.id_candidato = b.id_candidato
                     INNER JOIN tbl_candidato_dados_extra c
                        ON a.id_candidato = c.id_candidato
                     left JOIN tbl_candidato_status d
                        ON d.id_status = c.id_status
                    WHERE (c.id_status IS NULL OR d.position = 0) 
                group by date(b.data_criacao);";

        $query = $this->db->query($sql);
        $row = $query->rows;
        return $row;
    }
    public function enviadosEstatusCandidatosRelatorioSPCCriminal($data = array()) {

        foreach ($data as $value) {
            $sql = " update tbl_candidato_dados_extra set 
                    id_status = (select id_status from tbl_candidato_status where `position` = 0)  
                 where id_candidato = (select id_candidato from tbl_candidato where  rg = '" . $value['RG'] . "' and cpf = '" . $value['CPF'] . "'); ";
            $this->db->query($sql);

        }
    }
    
}

?>
