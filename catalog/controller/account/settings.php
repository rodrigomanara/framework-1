<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AccountSettingsController extends Controller {

    public function index() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->load->display($this->load->view('account_settings/home', $this->data));
    }

    public function alteraSenha() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['user_id'] = $this->session['user_id'];
        $this->data['form_url'] = $this->http_host . '/account/settings/alteraSenha';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $json = array();
            if ($this->post['__rm-password'] === $this->post['__rm-password2']) {
                $db = $this->load->model('account_login');
                $db->resetPass($this->post);
                
                $json['success'] = true;
                $json['url'] = $this->http_host . '/account/settings/alteraSenha';
            }else{
                $json['success'] = false;
                $json['pass'] = false;
            }
            
            $this->load->display(json_encode($json));
            exit();
        }

        $this->load->display($this->load->view('account_settings/alterarsenha', $this->data));
    }

    private function menu($data = array()) {

        $array = array();
        $array['menu'][] = array('name' => 'Alterar Senha', 'href' => $this->http_host . '/account/settings/alteraSenha', 'icon' => '');

        return $array;
    }

}

?>
