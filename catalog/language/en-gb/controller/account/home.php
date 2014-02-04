<?php

class AccountHomeController extends Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        if (!isset($this->session['level']) or $this->session['level'] === 0) {
            $this->function->redirect('./account/login/');
        }
    }

    public function index() {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        //$this->data['menulateral'] = $this->load->controller('model_menulateral');

        $this->data['menu'] = $this->menu();


        $this->load->display($this->load->view('accounthome_home', $this->data));
    }

    public function accountrequest() {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['form_url'] = $this->url;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $return = $this->validation->val($this->post);


            if ($return['error'])
                $return['validation']['url'] = $this->url;
            echo json_encode($return['validation']);

            exit();
        }


        $this->load->display($this->load->view('accounthome_accountrequest', $this->data));
    }

    public function accountdetails() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['form_url'] = $this->url;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $return = $this->validation->val($this->post);


            if ($return['error'])
                $return['validation']['url'] = $this->url;
            echo json_encode($return['validation']);

            exit();
        }

        $this->load->display($this->load->view('accounthome_accountdetails', $this->data));
    }

    public function accountsecurity() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['form_url'] = $this->url;

        if ($this->server['REQUEST_METHOD'] === 'POST') {
            $return = $this->validation->val($this->post);


            if ($return['error'])
                $return['validation']['url'] = $this->url;

            if ($return['error'] === true) {
                $data = $this->validation->valpass($this->post);
                if($data['checkpass'] === false) {
                    $return['validation']['error'] = true;
                    $return['validation']['info'] = $data['info'];
                    unset($return['validation']['url']);
                }
            }
            echo json_encode($return['validation']);


            exit();
        }

        $this->load->display($this->load->view('accounthome_accountsecurity', $this->data));
    }

    public function menu() {
        $array = array();

        $array['menu'][] = array('name' => 'Request account', 'href' => './account/home/accountrequest', 'icon' => null);
        $array['menu'][] = array('name' => 'Account details', 'href' => './account/home/accountdetails', 'icon' => null);
        $array['menu'][] = array('name' => 'Security', 'href' => './account/home/accountsecurity', 'icon' => null);


        return $array;
    }

}

?>
