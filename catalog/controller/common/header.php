<?php

class CommonHeaderController extends Controller {

    public function index($data = array()) {

        if (isset($this->session['login'])) {
            $this->data['bem_vindo'] = $this->getUserDetails();
            $this->data['menu'][] = array('name' => 'Principal', 'href' => $this->http_host .'calendar/home/', "level" => 0);
            $this->data['menu'][] = array('name' => 'Gerenciamento', 'href' => $this->http_host .'account/manager', "level" => 99);
            $this->data['menu'][] = array('name' => 'Criar Usuario', 'href' => $this->http_host .'account/home/request', 'icon' => null, "level" => 99);
            $this->data['menu'][] = array('name' => 'Configurações', 'href' => $this->http_host .'account/settings/', 'icon' => null, "level" => 0);
            $this->data['menu'][] = array('name' => 'Sair', 'href' =>$this->http_host . 'account/login/logout', "level" => 0);
            
        } else { 
            $this->data['bem_vindo'] = "Seu Ip : " .$_SERVER['REMOTE_ADDR'];
            $this->data['menu'][] = array('name' => 'Home', 'href' => $this->http_host .'account/login', "level" => 0);
        }
        
       
        
        $this->data['level'] = isset($this->session['level']) ? $this->session['level'] : 0;
        $this->data['server'] = $_SERVER['HTTP_HOST'] . "/" . __system;
       

        $file_name = 'common_header';
        return $this->load->view($file_name, $this->data);
    }
    public function getUserDetails(){
        $db = $this->load->model("staff_staff");
        $dados = $db->getName($this->session);
        
        $return = "Seja Bem Vindo ".$dados['name'] . "  , Dia ".date('d-m-Y').".";
        
        return $return;
    }

}

?>
