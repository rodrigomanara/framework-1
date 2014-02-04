<?php

class CommonHeaderController extends Controller {

    public $menu;

    public function index() {



        if (isset($this->session['login'])) {
            $this->menu['menu'][] = array('name' => 'Home', 'href' => 'account/home', "level" => 0);
            $this->menu['menu'][] = array('name' => 'Manager', 'href' => 'account/manager', "level" => 1);
            $this->menu['menu'][] = array('name' => 'List of Subscribes', 'href' => './?F=manager/list', "level" => 1);
            $this->menu['menu'][] = array('name' => 'Log Out', 'href' => 'account/login/logout', "level" => 0);
        } else {
            $this->menu['menu'][] = array('name' => 'Home', 'href' => 'account/login', "level" => 0);
            $this->menu['menu'][] = array('name' => 'Create new account', 'href' => 'account/request', "level" => 0);
        }
        
        $this->menu['level'] = isset($this->session['level']) ? $this->session['level'] : 0 ; ;
        $this->menu['server'] = $_SERVER['HTTP_HOST'];

        
        
        $file_name = 'common_header';
        return $this->load->view($file_name, $this->menu);
    }

}

?>
