<?php

/**
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * @name ControllerStock
 * 
 */
class StockHomeController extends Controller {

    /**
     * 
     */
    public function index() {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $db = $this->load->model('stock_stock');
            $json = array();
            $json['success'] = true;
            $json['dados'] = $db->selectStock($this->post);
            echo json_encode($json);
            exit();
        }

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/home/';



        $array[] = array('nome' => 'Adicionar novo Produto', 'url' => $this->http_host . 'stock/home/add/');
        $array[] = array('nome' => 'Editar novo Produto', 'url' => $this->http_host . 'stock/home/edit/');
        $array[] = array('nome' => 'Apagar Produto', 'url' => $this->http_host . 'stock/home/del/');

        $this->data['option'] = $array;

        $this->load->display($this->load->view('stock_home', $this->data));
    }

    public function add() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/home/add/';
        $this->data['url_home'] = $this->http_host . 'stock/home/';


        $db = $this->load->model('stock_stock');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return = $db->StockUpdate($this->post);
            $json = array();

            $json['success'] = $return;

            $this->load->display(json_encode($json));
            exit;
        }


        $this->load->display($this->load->view('stock_add', $this->data));
    }

    public function edit() {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'stock/home/edit/';
        $this->data['url_home'] = $this->http_host . 'stock/home/';

        $db = $this->load->model('stock_stock');
        $data['id_estoque'] = isset($this->get['id_estoque']) ? $this->get['id_estoque'] : 0;
        $data['lote'] = isset($this->get['lote']) ? $this->get['lote'] : null;
        $this->data['dados'] = $db->selectStock($data);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return = $db->StockUpdate($this->post);
            $json = array();

            $json['success'] = $return;

            $this->load->display(json_encode($json));
            exit;
        }


        $this->load->display($this->load->view('stock_edit', $this->data));
    }

    public function del() {
        $db = $this->load->model('stock_stock');
        $return = $db->delete($this->post);
        $json = array();
        $json['success'] = $return;
        $this->load->display(json_encode($json));
        exit;
    }

}

?>
