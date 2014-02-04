<?php

class FinanceHomeController extends Controller {

    public function index() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = $this->load->model('finance_finance');
            $json = array();

            $dado = $db->SelectSaldos($this->post);


            $total = 0;
            $devedor = 0;
            foreach ($dado as $dados) {
                $devedor += ($dados['value'] - $dados['totalpago']);
                $total += $dados['totalpago'];
            }
            
            $json['total_devedor'] = "£" . $this->functions->formatNumber($devedor);
            $json['total_pago'] = "£" .$this->functions->formatNumber($total);
            $json['dados'] = $dado;
            $this->load->display(json_encode($json));
            exit();
        }


        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'finance/home/';

        $this->data['metodo'] = $this->methodos();
        $this->data['tipo'] = $this->tipo();

        $this->load->display($this->load->view('finance_home', $this->data));
    }

    protected function methodos() {
        $db = $this->load->model('finance_finance');
        return $db->metodos();
    }

    protected function tipo() {
        $array[] = array('nome' => 'Medico');
        $array[] = array('nome' => 'Paciente');
        return $array;
    }

}

?>
