<?php

class AccountManagerController extends Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        
        if(!isset($this->session['level']) or $this->session['level'] === 0){
            $this->function->redirect('./account/login/');
        }
        
    }
    public function index(){
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom'); 
        
        $this->data['menu'] = $this->menu();
        
        
        $this->load->display($this->load->view('account_manageraccount', $this->data));
    }
    public function createaccount(){
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom'); 
        $db = $this->load->model('account_manager');
        
        $this->data['clients'] = $db->clientes();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            
            
            exit();
        }
        
        $this->data['form_url'] = './account/manager/createaccount/';
        $this->load->display($this->load->view('account_createaccount', $this->data));
        
    }
    public function deleteaccount(){
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom'); 
    
        $this->load->display($this->load->view('account_deleteaccount', $this->data));
        
    }
    public function settingaccount(){
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom'); 
    
        $this->load->display($this->load->view('account_settingaccount', $this->data));
        
    }
    public function ticketsclients(){
         $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom'); 
    
        $this->load->display($this->load->view('account_ticketsclientsaccount', $this->data));
    }
    private function menu(){
        
        $array = array();
        
        $array['menu'][] = array('name' => 'Creating Account' , 'href' => './account/manager/createaccount/' , 'icon' => '');
        $array['menu'][] = array('name' => 'Delete Account' , 'href' => './account/manager/deleteaccount/' , 'icon' => '');
        $array['menu'][] = array('name' => 'Setting Account' , 'href' => './account/manager/settingaccount/' , 'icon' => '');
       $array['menu'][] = array('name' => 'Manager Tickets Clients' , 'href' => './account/manager/ticketsclients/' , 'icon' => '');
        return $array;
        
    }
    
    
}

?>
