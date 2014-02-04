<?php

class CommonBottomController extends Controller{
    
    public function index($data = array()) {
        
        
        $file_name = 'common_bottom';
        return $this->load->view($file_name);
        
        
    }
}
?>
