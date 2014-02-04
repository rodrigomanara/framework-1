<?php

class CommonBottomController extends Controller{
    
    public function index() {
        parent::__construct();
        
        $file_name = 'common_bottom';
        $this->load->view($file_name);
    }
}
?>
