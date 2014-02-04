<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class StockServicoController extends Controller {

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $db = $this->load->model('stock_servico');
            $json = array();
            $json['success'] = true;
            $json['dados'] = $db->selectServico($this->post);
            echo json_encode($json);
            exit();
        }

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/servico/';



        $array[] = array('nome' => 'Adicionar novo Servico', 'url' => $this->http_host . 'stock/servico/add/');
        $array[] = array('nome' => 'Editar Servico', 'url' => $this->http_host . 'stock/servico/edit/');
        $array[] = array('nome' => 'Apagar Produto', 'url' => $this->http_host . 'stock/servico/del/');

        $this->data['option'] = $array;

        $this->load->display($this->load->view('servico_home', $this->data));
    }

    public function add() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/servico/add/';
        $this->data['url_home'] = $this->http_host . 'stock/servico/';

        $db = $this->load->model('stock_servico');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return = $db->ServicoUpdate($this->post);
            $json = array();

            $json['success'] = $return;

            $this->load->display(json_encode($json));
            exit;
        }


        $this->load->display($this->load->view('servico_add', $this->data));
    }

    public function edit() {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/servico/edit/';
        $this->data['url_home'] = $this->http_host . 'stock/servico/';

        $db = $this->load->model('stock_servico');
        $data['id_servico'] = isset($this->get['id_servico']) ? $this->get['id_servico'] : 0;
        $data['lote'] = isset($this->get['lote']) ? $this->get['lote'] : null;
        $this->data['dados'] = $db->selectServico($data);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return = $db->ServicoUpdate($this->post);
            $json = array();

            $json['success'] = $return;

            $this->load->display(json_encode($json));
            exit;
        }


        $this->load->display($this->load->view('servico_edit', $this->data));
    }

    public function del() {
        $db = $this->load->model('stock_servico');
        $return = $db->delete($this->post);
        $json = array();
        $json['success'] = $return;
        $this->load->display(json_encode($json));
        exit;
    }

}

?>
