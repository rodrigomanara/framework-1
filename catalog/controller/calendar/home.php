<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CalendarHomeController extends Controller {

    public function index() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['calendar'] = $this->getCalendar();
        $this->load->display($this->load->view('calendar_home', $this->data));
    }

    /**
     * @see pacienteCalendar
     */
    public function pacienteCalendar() {
        $this->load->display($this->getCalendar());
    }

    /**
     * 
     * @return type
     */
    public function getCalendar() {


        $db = $this->load->model('calendar_calendar');
        $this->data['id_paciente'] = (isset($this->get['id_paciente'])) ? str_replace("/", "", $this->get['id_paciente']) : 0;
        $this->data['cal_staff'] = $db->getStaffCalendar($this->data);
        $this->data['url'] = $this->http_host;
        $this->data['url_add_paciente'] = $this->http_host . 'pacient/home/add/' ;
        $this->data['level'] = $this->session['level'];

        return $this->load->view('calendar_calendar', $this->data);
    }

    /**
     * @see addAgendamento
     */
    public function getPaciente() {
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if ($isAjax) {
            $db = $this->load->model('calendar_calendar');
            $data = $db->getPacientes($this->post);
            $this->load->display(json_encode($data));
        }
    }

    public function getStaff() {
        $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
        if ($isAjax) {
            $db = $this->load->model('calendar_calendar');
            $data = $db->getStaffs($this->post);
            $this->load->display(json_encode($data));
        }
    }

    /**
     * @see Agendamento 
     */
    public function Agendamento() {

       
        
        
        $this->data['header_url'] = $this->http_host;
        $this->data['ficha_add_agendamentp'] = $this->adicionarAgentamento($this->get);
        $this->data['ficha_view'] = 0;//$this->fichaMedica($this->get);
        $this->data['ficha_template'] = 0;//$this->fichaMedicaNovaConsulta();
        $this->data['url_link'] = 0;//$this->functions->listUrlVar($this->get);
        $this->data['ficha_dados_pessoais'] = 0;//$this->getDadosPessoasPaciente($this->get);
        $this->data['paciente_id'] = isset($this->get['id_paciente']) ? $this->get['id_paciente'] : "";

        $this->load->display($this->load->view('calendar_appointment', $this->data));
    }

    public function adicionarAgentamento($data = array()) {
        $db = $this->load->model('calendar_calendar');

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array(
                'title' => $this->post['title'],
                'start' => date('Y', strtotime($this->post['data_start']))
                . "-" . date('m', strtotime($this->post['data_start']))
                . "-" . date('d', strtotime($this->post['data_start']))
                . " " . date('H:i:s', strtotime($this->post['data_time_start'])),
                'end' => date('Y', strtotime($this->post['data_start']))
                . "-" . date('m', strtotime($this->post['data_start']))
                . "-" . date('d', strtotime($this->post['data_start']))
                . " " . date('H:i:s', strtotime($this->post['data_time_end'])),
                'allDay' => false,
                'id_paciente' => $this->post['id_paciente'],
                'id_calendar' => (isset($this->get['id_calendar']) ? $this->get['id_calendar'] : 0),
                'id_staff' => $this->post['id_staff']
            );

            $json = array();
            try {
                if ($this->get['type'] === 'gravar') {
                    $db->addToCalendar($data);
                    $json['success'] = true;
                }
                if ($this->get['type'] === 'excluir') {
                    $db->excluirFromCalendar($data);
                    $json['success'] = true;
                }
            } catch (Exception $e) {
                $json['success'] = $e->getMessage();
            }
            $this->load->display(json_encode($json));
            exit();
        }

        /**
         * Start the get
         */
        $this->data['start'] = date('d-m-Y', strtotime(isset($this->post['data_start']) ? $this->post['data_start'] : $this->get['start']));
        $this->data['end'] = date('d-m-Y', strtotime(isset($this->post['data_start']) ? $this->post['data_start'] : $this->get['start']));
        $this->data['start_time'] = date('H:i', strtotime(isset($this->post['data_time_start']) ? $this->post['data_time_start'] : $this->get['start']));
        $this->data['end_time'] = date('H:i', strtotime(isset($this->post['data_time_end']) ? $this->post['data_time_end'] : $this->get['end']));
        $this->data['header_url'] = $this->http_host;
        $this->data['dados'] = null;

        /**
         *  set var from url
         */
        $id_paciente = isset($this->get['id_paciente']) ? $this->get['id_paciente'] : "";
        $id_staff = isset($this->get['id_staff']) ? $this->get['id_staff'] : "";

        /**
         * auto complete url
         */
        $this->data['autocompleteP'] = $this->http_host . 'calendar/home/getPaciente/&id_paciente=' . $id_paciente;
        $this->data['autocompleteS'] = $this->http_host . 'calendar/home/getStaff/&id_paciente=' . $id_paciente;

        /**
         * 
         */
        $url = array();
        foreach ($this->get as $key => $dados) {
            if ($key !== 'route')
                $url[] = $key . "=" . $dados;
        }
        $this->data['url'] = "./calendar/home/addAgendamento/" . implode("&", $url);

        /**
         * get paciente if id  > 0
         */
        $tb = '';
        $get_paciente = $db->getPaciente($this->get);
        $get_staff = $db->getStaff($this->get);


        if ((int) $id_paciente > 0 && isset($get_paciente['nome'])) {
            $tb .= "<input name='' disabled value='" . $get_paciente['nome'] . "' type='text'/>";
            $tb .= "<input name='id_paciente' value='" . $id_paciente . "' type='hidden'/>";
        } else {
            $tb .= "<input name='id_paciente' value='' type='text' rel='req'/>";
        }
        $this->data['paciente'] = $tb;
        $this->data['paciente_id'] = $id_paciente;

        /**
         * get staff id > 0
         */
        $tb = '';
        if ($id_staff > 0) {
            $tb .= "<input name='' disabled value='" . $get_staff['name'] . " " . $get_staff['surname'] . "' type='text'/>";
            $tb .= "<input name='id_staff' value='" . $id_staff . "' type='hidden'/>";
        } else {
            $tb .= "<input name='id_staff' value='' type='text' rel='req'/>";
        }
        $this->data['staff'] = $tb;


        $boolean = isset($this->get['id_calendar']) ? true : false;
        if ((boolean) $boolean !== false) {
            $this->data['id_calendar'] = "<input name='id_calendar' value='" . (int) $this->get['id_calendar'] . "' type='hidden'/>";
        }


        /**
         * set the description 
         */
        $title = $db->getCalendar($this->get);
        if (isset($this->get['id_calendar']) and (int) $this->get['id_calendar'] > 0 && isset($title['title'])) {
            $clean = explode("=", $title[0]['title']);
            $this->data['title'] = $clean[1];
        } else {
            $this->data['title'] = $this->get['title'];
        }


        return $this->load->view('calendar_appointment-add', $this->data);
    }

    public function fichaMedica($data) {
        $db = $this->load->model('pacient_pacient');
        $dado = $db->getFichaMedica($data);

        $ficha = array();
        foreach ($dado as $dados) {
            $d = $this->functions->decodeString($dados['ficha']);
            array_push($ficha, array("data" => $dados['data'], "ficha" => $d));
        }
        $this->data['dado'] = $ficha;
        return $this->load->view('calendar_ficha-view', $this->data);
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
        $this->data['id_paciente'] = $this->get['id_paciente'];
        $this->data['url'] = $this->http_host . 'calendar/home/fichaMedicaNovaConsulta/';
        return $this->load->view('calendar_ficha-nova-consulta', $this->data);
    }

    /**
     * 
     */
    public function getDadosPessoasPaciente($data = array()) {
        $db = $this->load->model('calendar_calendar');

        $get_paciente = $db->getPaciente($data);
        $this->data['dados'] = isset($get_paciente['dados']) ? $this->functions->decodeString($get_paciente['dados']) : "";
        return $this->load->view('calendar_dados-pessoais-paciente', $this->data);
    }

    /**
     * Json return only
     */
    public function returnJsonCalendar() {

        $db = $this->load->model('calendar_calendar');
        $json = $db->getCalendar($this->get);

        $data = array();

        foreach ($json as $jsons) {
            array_push($data, array('start' => date('Y', strtotime($jsons['start']))
                . "-" . date('m', strtotime($jsons['start']))
                . "-" . date('d', strtotime($jsons['start']))
                . " " . date('H:i:s', strtotime($jsons['start'])),
                'end' => date('Y', strtotime($jsons['end']))
                . "-" . date('m', strtotime($jsons['end']))
                . "-" . date('d', strtotime($jsons['end']))
                . " " . date('H:i:s', strtotime($jsons['end'])),
                'title' => $jsons['title'],
                'id' => isset($jsons['id_calendar']) ? $jsons['id_calendar'] : 0,
                'id_staff' => isset($jsons['id_staff']) ? $jsons['id_staff'] : 0,
                'id_paciente' => isset($jsons['id_paciente']) ? $jsons['id_paciente'] : 0,
                'color' => isset($jsons['cor']) ? $jsons['cor'] : '',
                'allDay' => false
            ));
        }
        $this->load->display(json_encode($data));
    }

}

?>
