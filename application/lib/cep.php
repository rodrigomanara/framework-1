<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class getAddress {

    public function getCEP($data = array()) {
        // Definição da localização
        $wsdl = 'http://www.toolsweb.com.br/webservice/serverWebService.php?wsdl';

        try {
            
            $proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
            $proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
            $proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
            $proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
            
            $client = new soapclient($wsdl, true, $proxyhost, $proxyport, $proxyusername, $proxypassword);

            $param = array($data);
            $result = $client->call('consultaCEP', $param);
            $xml = simplexml_load_string($result);

            $json = array();
            $json['tipoLogradouro'] = $xml->dados->tipoLogradouro;
            $json['logradouro'] = $xml->dados->logradouro;
            $json['bairro'][] = utf8_decode($xml->dados->bairro);
            $json['cep'] = $xml->dados->cep;
            $json['cidade'] = $xml->dados->cidade;
            $json['estados'][] = utf8_decode($xml->dados->estado);

            return json_encode($json);
            /*

              $client = new soapclient($wsdl);
              $var = $client->consultaCEP($data);
              $xml = simplexml_load_string($var);


              $json = array();
              $json['tipoLogradouro'] = $xml->dados->tipoLogradouro;
              $json['logradouro'] = $xml->dados->logradouro;
              $json['bairro'] = $xml->dados->bairro;
              $json['cep'] = $xml->dados->cep;
              $json['cidade'] = $xml->dados->cidade;
              $json['estados'] = $xml->dados->estado;

              return json_encode($json);
             */
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}

?>
