<?php


class CommonHomeController extends Controller {

    public $campain;
    public $status;
  

    public function index($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');

        $this->data['randon_image'] = '<img src="' . $this->salt_login->image($this->randon) . '" />';
        $this->data['form_url'] = "./account/login/login/";
        $this->data['session'] = count($this->session['randon']);
        
        
        $this->load->display($this->load->view('common_welcome', $this->data));
    }

    static public function Error404($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');

        $file_name = 'common_welcome';
        $this->load->display($this->load->view($file_name, $this->data));
    }

}

?>
