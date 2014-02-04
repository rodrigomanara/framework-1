<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menu
 *
 * @author rodrigo
 */
class ModelMenulateralController extends Controller {
    //put your code here
    public function index(){
        $db = $this->load->model('model_menulateral');
        
        $user_level = $db->userlevel($this->session);
        
        
        $this->data['menu'] = $db->menulateral($user_level);
        $this->load->view('model_menulateral' , $this->data);
        
    }
}

?>
