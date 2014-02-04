<?php

/**
 * 
 * PacientHomeController
 */
class PacientHomeController extends Controller {

    public function index() {

        $this->data['url'] = $this->http_host . 'pacient/home/';
        $this->data['add_paciente'] = $this->http_host . 'pacient/home/add/';
        $this->data['nome'] = (isset($this->get['n'])) ? $this->get['n'] : '';

        $array[] = array('nome' => 'Adicionar Novo Paciente', 'url' => $this->http_host . 'pacient/home/add/');
        $array[] = array('nome' => 'Ver & Editar Dados do Paciente', 'url' => $this->http_host . 'pacient/home/edit/');
        //$array[] = array('nome' => 'APagar dados Do Paciente', 'url' => $this->http_host.'pacient/home/del/');
        $array[] = array('nome' => 'Agendar Consulta', 'url' => $this->http_host . 'pacient/home/agendamento/');

        $this->data['option'] = $array;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $db = $this->load->model('pacient_pacient');
            $json['dados'] = $db->getPacients($this->post);
            $this->load->display(json_encode($json));
            exit();
        }

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');


        $this->load->display($this->load->view('pacient/pacient_home', $this->data));
    }

    public function add() {
        if (isset($_SESSION['id_paciente'])) :
            unset($_SESSION['id_paciente']);
        endif;

        $this->data['dados'] = null;
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['menu_tab'] = $this->menuTab();
        $this->data['url_home'] = $this->http_host;
        $this->data['url_redirect'] = $this->http_host . "/pacient/home/";

        $this->data['level'] = $this->session['level'];
        $this->data['url'] = $this->http_host . 'pacient/home/edit/';
        $this->load->display($this->load->view('pacient/pacient_add', $this->data));
    }

    public function edit($data = null) {

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] :
                                $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));


        $this->data['id'] = '&id_paciente=' . $id;
        $this->data['id_paciente'] = $id;

        $db = $this->load->model("pacient_pacient");
        $this->data['dados'] = $db->getPacient($this->data);
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['menu_tab'] = $this->menuTab();
        $this->data['url_home'] = $this->http_host;

        $this->data['level'] = $this->session['level'];
        $this->data['url'] = $this->url;
        $this->data['calendar'] = $this->http_host . '/calendar/home/pacienteCalendar/';
        $this->load->display($this->load->view('pacient/pacient_edit', $this->data));
    }

    /** fin main pages * */
    public function dadosPaciente() {
        $db = $this->load->model('pacient_pacient');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = array();
            $return = $db->updateDadosPaciente($this->post);

            if ($return) {
                $json['success'] = $return;
            } else {
                $json['success'] = FALSE;
            }
            $this->load->display(json_encode($json));
            exit();
        }

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;
        $this->data['url'] = $this->http_host . 'pacient/home/dadosPaciente/&id_paciente=' . $id;

        $query = $db->getPacient($this->data);
        $this->data['dados'] = $query;
        $this->load->display($this->load->view('pacient/pacient_dados-paciente', $this->data));
    }

    public function ppContato() {
        $db = $this->load->model('pacient_pacient');


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $return = $db->updateDadosPacientePessoaContato($this->post);
            $json = array();
            if ($return) {
                $json['success'] = $return;
            } else {
                $json['success'] = false;
            }
            $this->load->display(json_encode($json));
            exit;
        }
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $this->data['pp_contato'] = $db->getPPCPacient($this->data);
        $this->data['url'] = $this->http_host . 'pacient/home/ppContato/';

        $this->load->display($this->load->view('pacient/pacient_pp-contato', $this->data));
    }

    public function DadosMedicos() {
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $this->data['url_historical'] = $this->http_host . 'pacient/home/DadosMedicosHistorical/';
        $this->data['url_follow'] = $this->http_host . 'pacient/home/DadosMedicosFollow/';
        $this->data['header_url'] = $this->http_host;
        $this->data['adicionar'] = $this->load->view('pacient/pacient_medico-ficha-adicionar');

        $db = $this->load->model('pacient_consultamedica');
        $this->data['historical_ficha'] = $db->selectDadosFicha($this->data);
        $this->data['data'] = $db->selectDadosHistoricaFicha($this->data);

        $this->load->display($this->load->view('pacient/pacient_medico-base', $this->data));
    }

    public function DadosMedicosHistorical() {
        $db = $this->load->model('pacient_consultamedica');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $return = $db->updateDadosPacientedadosMedicos($this->post);
            if ($return) {
                $json['success'] = $return;
            } else {
                $json['success'] = FALSE;
            }
            $this->load->display(json_encode($json));
            exit();
        }
    }

    public function DadosMedicosFollow() {
        $db = $this->load->model('pacient_consultamedica');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $return = $db->updateDadosPacienteDadosMedicosFollow($this->post);
            if ($return) {
                $json['success'] = $return;
            } else {
                $json['success'] = FALSE;
            }
            $this->load->display(json_encode($json));
            exit();
        }
    }

    /**
     * 
     */
    public function DocumentoFileScan() {

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;
        $this->data['id'] = $id;

        $this->data['url'] = $this->http_host . 'pacient/home/DocumentoFileScan/';
        $this->data['url_js'] = $this->http_host . '/catalog/view/default/JS/';
        $this->data['url_css'] = $this->http_host . '/catalog/view/default/CSS/';
        $this->data['url_upload'] = $this->http_host . 'pacient/home/upload/';
        $db = $this->load->model('pacient_consultamedica');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($this->post as $data) {
                print_r($data);
            }
            exit();
        }

        $this->data['dados'] = $db->getTempSaveFile($this->data);
        $this->load->display($this->load->view('pacient/pacient_documento-file-scan', $this->data));
    }

    /**
     * @see upload;
     */
    public function upload() {

        $db = $this->load->model('pacient_consultamedica');
        if (isset($_POST['get_Upload'])) {
            $this->data = $db->getTempSaveFile($this->post);
        } else {

            if (isset($_FILES['files']['size'])) {
                $file_path = $_FILES['files']['tmp_name'];

                $this->data['name'] = $_FILES['files']['name'];
                $this->data['type'] = $_FILES['files']['type'];
                $this->data['size'] = $_FILES['files']['size'];
                $this->data['id_paciente'] = $_POST['id_paciente'];
                $this->data['content_local'] = __root . '/files_upload/' . $_FILES['files']['name'];
                $this->data['content'] = './files_upload/' . $_FILES['files']['name'];

                $str = array('.doc', '.docx', '.pdf', '.xls');
                $check = false;
                foreach ($str as $value) {
                    if (preg_match("/" . $value . "/", $this->data['name'])) {
                        $check = true;
                    }
                }
                if ($check) {

                    move_uploaded_file($file_path, $this->data['content_local']);
                    $this->data['file_id'] = $db->save_temp_file($this->data);
                }
            } else {
                $this->data['name'] = 'Arquivo muito grande limite 2MB';
            }
        }
        print json_encode($this->data);
    }

    public function servico() {

        $db = $this->load->model('pacient_servico');

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $data = $db->out_financeiro($this->post);
            echo json_encode($data);
            exit();
        }
        $this->data['url'] = $this->http_host . 'pacient/home/servico/';
        $this->data['urlImprimir'] = $this->http_host . 'pacient/home/ServicoImprimir/&id_paciente=' . $this->data['id_paciente'];
        $this->data['urlCalculador'] = $this->http_host . 'pacient/home/servicoCalculadora/';
        $this->data['print'] = '';
        $this->data['print_all'] = '';
        $this->data['pg_status'][] = array('nome' => 'Pago', 'valor' => 1);
        $this->data['pg_status'][] = array('nome' => 'Ainda a Pagar', 'valor' => 0);
        $this->data['dados_fin'] = 0;

        $this->load->display($this->load->view('pacient/pacient_servicos', $this->data));
    }

    public function servicoCalculadora() {

        $db = $this->load->model('pacient_servico');
        $this->data['home'] = $this->http_host;
        $this->data['url'] = $this->http_host . 'pacient/home/servicoCalculadora/';
        $this->data['css'] = $this->http_host . './catalog/view/default/CSS/style.css';
        $this->data['url_pop_up'] = $this->http_host . 'pacient/home/servicoFormLista/';
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $json = array();
            if ($db->updateDadosFinanceiros($this->post)) {
                $json['success'] = true;
            }
            echo json_encode($json);
            exit();
        }


        $this->load->display($this->load->view('pacient/pacient_servicos-calcudora', $this->data));
    }

    /**
     * 
     */
    public function servicoFormLista() {
        $db = $this->load->model('stock_servico');

        $this->data['home'] = $this->http_host;
        $this->data['url'] = $this->http_host . 'pacient/home/servicoFormLista/';
        $this->data['lista'] = $db->selectServico();
        $this->data['css'] = $this->http_host . './catalog/view/default/CSS/style.css';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = array();
            $json['dados'] = $db->selectServico($this->post);
            echo json_encode($json);
            exit();
        }

        $this->load->display($this->load->view('pacient/pacient_servico-lista', $this->data));
    }

    public function ServicoImprimir() {
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $db_servico = $this->load->model('pacient_servico');
        $this->data['dados'] = $db_servico->out_financeiro($this->data);

        $db = $this->load->model('pacient_pacient');

        $this->data['pessoal'] = $db->getPacient($this->data);
        $this->data['js'] = $this->http_host . './catalog/view/default/JS/';
        $this->data['img'] = $this->http_host . './catalog/view/default/CSS/images/';
        $this->data['server'] = $this->http_host;

        $this->load->display($this->load->view('pacient/pacient_servicos-selecionar-impressao', $this->data));
    }

    public function medicamentos() {

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $db = $this->load->model('pacient_medicamento');

        $this->data['url'] = $this->http_host . 'pacient/home/medicamentos/';

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = $db->out_medicamento($this->post);
            echo json_encode($data);
            exit();
        }

        $this->load->display($this->load->view('pacient/pacient_medicamentos', $this->data));
    }

    public function medicamentosForm() {
        $db = $this->load->model('pacient_medicamento');

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $this->data['home'] = $this->http_host;
        $this->data['url'] = $this->http_host . 'pacient/home/medicamentosForm/';
        $this->data['css'] = $this->http_host . './catalog/view/default/CSS/style.css';
        $this->data['js'] = $this->http_host . './catalog/view/default/JS/';

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $json = array();
            if ($db->in_medicamento($this->post)) {
                $json['success'] = true;
            }
            echo json_encode($json);
            exit();
        }

        $this->load->display($this->load->view('pacient/pacient_medicamento-form', $this->data));
    }

    /**
     * 
     */
    public function medicamentoFormLista() {
        $db = $this->load->model('pacient_stock');

        $this->data['home'] = $this->http_host;
        $this->data['url'] = $this->http_host . 'pacient/home/medicamentoFormLista/';
        $this->data['lista'] = $db->selectStock();
        $this->data['css'] = $this->http_host . './catalog/view/default/CSS/style.css';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = array();
            $json['dados'] = $db->selectStock($this->post);
            echo json_encode($json);
            exit();
        }

        $this->load->display($this->load->view('pacient/pacient_medicamento-lista', $this->data));
    }

    /**
     * @see Calendar
     */
    public function calendar() {
        $this->data['agendamento'] = $this->load->controller('calendar_home_getCalendar');
        $this->load->display($this->load->view('pacient/pacient_agendamento-editar', $this->data));
    }

    /**
     * @see Agendamento
     */
    public function agendamento() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $db = $this->load->model("pacient_pacient");
        $this->data['dados'] = $db->getPacient($this->data);
        $this->data['agendamento'] = $this->load->controller('calendar_home_getCalendar');
        $this->load->display($this->load->view('pacient/pacient_agendamento', $this->data));
    }

    /**
     * Dados publicos
     */
    public function fichaMedica($data) {
        $db = $this->load->model('pacient_pacient');
        $dado = $db->getFichaMedica($data);

        $ficha = array();
        foreach ($dado as $dados) {
            $d = $this->functions->decodeString($dados['ficha']);
            array_push($ficha, array("data" => $dados['data'], "ficha" => $d));
        }
        $this->data['dado'] = $ficha;
        return $this->load->view('pacient/pacient_ficha-view', $this->data);
    }

    public function fichaMedicaNovaConsulta() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $dados = $this->functions->encondeString($this->post);
            $data['id_paciente'] = $this->post['id_paciente'];
            $data['dados'] = $dados;

            $db = $this->load->model("pacient_consulta");
            $db->AdicionarNovaConsulta($data);

            exit();
        }
        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $this->data['url'] = $this->http_host . 'calendar/home/fichaMedicaNovaConsulta/';
        return $this->load->view('pacient/pacient_ficha-nova-consulta', $this->data);
    }

    /**
     * parte financeira
     */
    public function printRecibo() {

        $this->data['server'] = $this->http_host;
        $db = $this->load->model('pacient_pacient');
        $query = $db->getPacients($this->get);
        $dados = $this->functions->decodeString($query[0]['dados']);
        $id_line = isset($this->get['id_line']) ? $this->get['id_line'] : -1;

        $this->data['nome'] = $dados['nome'];
        $valor = array();
        $total = 0;

        foreach ($dados['fin_service'] as $key => $value) {
            if ($id_line >= 0 && $key == $id_line) {
                $valor['fin']['titulo'] = $value;
            }
        }

        foreach ($dados['fin_value'] as $key => $value) {
            if ($id_line >= 0 && $key == $id_line) {
                $valor['fin']['valor'] = $value;
                $total += str_replace("£", "", $value);
            }
        }

        $this->data['valor'] = $valor;
        $this->data['total_value'] = "£" . number_format($total, 2, ",", ".");
        $this->load->display($this->load->view('pacient/pacient_imprimir-recibo', $this->data));
    }

    public function printReciboAll() {

        $this->data['server'] = $this->http_host;
        $db = $this->load->model('pacient_pacient');
        $query = $db->getPacients($this->get);
        $dados = $this->functions->decodeString($query[0]['dados']);
        $id_line = isset($this->get['id_line']) ? $this->get['id_line'] : -1;

        $this->data['nome'] = $dados['nome'];
        $valor = array();
        $total = 0;

        foreach ($dados['fin_service'] as $key => $value) {
            $valor['fin']['titulo'][] = $value;
        }

        foreach ($dados['fin_value'] as $key => $value) {
            $valor['fin']['valor'][] = $value;
            $total += str_replace("£", "", $value);
        }

        $this->data['valor'] = $valor;
        $this->data['total_value'] = "£" . number_format($total, 2, ",", ".");
        $this->load->display($this->load->view('pacient/pacient_imprimir-recibo-tudo', $this->data));
    }

    public function del($data = array()) {

        $id = (isset($_SESSION['id_paciente']) ? (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : $_SESSION['id_paciente'] ) : (isset($this->get['id_paciente']) ? $this->get['id_paciente'] : 0 ));
        $this->data['id_paciente'] = $id;

        $db = $this->load->model('pacient_pacient');

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $db->deletePacient($this->post);
            $json = array();
            $json['success'] = true;
            exit();
        }

        $this->load->display($this->load->view('pacient/pacient_delete', $this->data));
    }

    public function menuTab() {
        $array[] = array('url' => './pacient/home/dadosPaciente/', 'name' => 'Dados do Paciente Pessoais', 'nivel' => 0);
        $array[] = array('url' => './pacient/home/ppContato/', 'name' => 'Pessoa para Contato', 'nivel' => 0);
        $array[] = array('url' => './pacient/home/DadosMedicos/', 'name' => 'Dados Medicos', 'nivel' => 1);
        $array[] = array('url' => './pacient/home/DocumentoFileScan/', 'name' => 'Documentos(Scan)', 'nivel' => 1);
        $array[] = array('url' => './pacient/home/servico/', 'name' => 'Saldo{£}', 'nivel' => 1);
        $array[] = array('url' => './pacient/home/calendar/', 'name' => 'Agendamento', 'nivel' => 1);
        $array[] = array('url' => './pacient/home/medicamentos/', 'name' => 'Medicamentos', 'nivel' => 1);

        return $array;
    }

}

?>