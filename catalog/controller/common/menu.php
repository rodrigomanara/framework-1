<?php

 class CommonMenuController extends Controller {

    public function index(){
        return $this->menu();
    }
     /**
     * menu
     * @access private
     * 
     */
    private function menu() {
        /* create a cache */

        $db = $this->load->model("common_menu");
        $join['__parent'] = $this->breaklink['folder'] . "/" . $this->breaklink['file'] . "/";
        $this->data['menu'] = $db->getMenu($join);

        return $this->load->view('common_menu', $this->data);
    }

}
?>
