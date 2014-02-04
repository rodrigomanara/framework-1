<?php

class AccountHomeController extends Controller {

    static public $numeros;

    //put your code here
    public function __construct($data = array()) { 
        parent::__construct();

        if (!isset($this->session['level']) or (int)$this->session['level'] === 0) {
           $this->functions->redirect('./account/login/');
        }
        if (!isset($_SESSION['randon']) or is_null($_SESSION['randon'])) {
            $_SESSION['randon'] = $this->randon;
        }
        $this->numeros = $_SESSION['randon'];
    }

    public function index($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        
        $this->load->display($this->load->view('account/accounthome_home', $this->data));
    }

    public function request($data = array()) {


        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        
        $this->data['form_url'] = $this->http_host . "/account/home/request/";
        $this->data['randon_image'] = '<img src="' . $this->salt_login->image($this->numeros) . '" />';

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $this->data['name'] = $this->post['__rm-name'];
            $this->data['email'] = $this->post['__rm-email'];
            $this->data['span'] = $this->post['__rm-span'];
            $this->data['pass'] = $this->post['__rm-pass'];

            $error = array();

            $i = 0;
            foreach ($this->post as $key => $check) {
                if (is_null($check) or empty($check)) {
                    $error[$key] = "Please review this filed";
                } else {

                    if (strstr($key, "email")) {
                        if ((strstr($key, "email") && !strstr($check, "@"))) {
                            $error[$key] = "email is not valid";
                        } else {

                            $error[$key] = true;
                        }
                    } elseif (strstr($key, "span")) {
                        if ((int) $this->session['randon'] === (int) $this->post['__rm-span']) {
                            $error[$key] = true;
                        } else {
                            $error[$key] = "invalid code!";
                        }
                    } else {
                        $error[$key] = true;
                    }
                }

                if ($error[$key] === true) {
                    $i++;
                }
            }

            if ((int) count($this->post) === (int) $i) {

                $db = $this->load->model('account_addaccount');
                if ($db->addaccount($this->data)) {
                    $error['url'] = "./account/home/request";
                    $_SESSION['randon'] = null;
                    $_SESSION['newlogin'] = true;
                    echo json_encode($error);
                    exit();
                } else {
                    $error['error'] = true;
                    $error['info'] = 'Accout already registered!</br> please click here <a href="./account/login/">login</a>';
                    echo json_encode($error);
                    exit();
                }
            }
            echo json_encode($error);
            exit();
        }

        $this->load->display($this->load->view('account/accounthome_request', $this->data));
    }

    public function alterarsenha($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu(); 
        $this->data['form_url'] = $this->url;
        $this->data['user_id'] = $this->session['user_id'];
        $db = $this->load->model('account_home');

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $return = $this->validation->val($this->post);

            if ($return['error'])
                $return['validation']['url'] = $this->url;

            if ($return['error'] === true) {
                $data = $this->validation->valpass($this->post);
                if ($data['checkpass'] === false) {
                    $return['validation']['error'] = true;
                    $return['validation']['info'] = $data['info'];
                    unset($return['validation']['url']);
                } else {
                    $db->accountaccountsecurityupdate($this->post);
                }
            }
            echo json_encode($return['validation']);
            exit();
        }
        $this->load->display($this->load->view('account/accounthome_alterarsenha', $this->data));
    }

    public function menu($data = array()) {
        $array = array();
        $array['user_id'] = $this->session['user_id'];
        $array['db_client_setup'] = 1;

        $array['menu'][] = array('name' => 'Usu&aacute;rio', 'href' => 'staff/home/', 'icon' => null, "level" => 0);
        $array['menu'][] = array('name' => 'Paciente', 'href' => 'pacient/home/', 'icon' => null, "level" => 0);
        $array['menu'][] = array('name' => 'Agendamentos', 'href' => 'calendar/home/', 'icon' => null, "level" => 0);
        $array['menu'][] = array('name' => 'Medicamentos', 'href' => 'stock/home/', 'icon' => null, "level" => 0);
        $array['menu'][] = array('name' => 'Financeiro', 'href' => 'finance/home/', 'icon' => null, "level" => 0);
        $array['menu'][] = array('name' => 'Alterar Senha', 'href' => './account/home/alterarsenha', 'icon' => null, "level" => 0);
        return $array;
    }

}

?>