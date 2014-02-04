<?php


class CommonErrorController extends Controller {

    public function index($data = array()) {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');

        $this->load->display($this->load->view('common_error404', $this->data));
    }

}

?>