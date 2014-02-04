<?php

class AccountMenuController extends Controller {

    /**
     * menuSetting
     * @param __name $name Description setting a menu system 
     */
    public function index() {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();

        $this->load->display($this->load->view('account/menu_setting', $this->data));
    }

    public function add() {
        $db = $this->load->model('account_menu');
        $this->data['url'] = $this->http_host . "";
        $this->data['level_list'] = $db->getRoleLevel();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $data['__name'] = $this->post['__name'];
            $data['__parent'] = $this->post['__parent'];
            $data['__url'] = $this->post['__url'];
            $data['__level'] = $this->post['__level'];
            $json = array();
            if ($db->checkMenuExistModel($data)) {
                if ($db->AddMenuModel($data)) {
                    $json['success'] = true;
                } else {
                    $json['success'] = false;
                }
                echo json_encode($json);
                exit();
            }
        }

        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/add/";
        $this->load->display($this->load->view('account/menu_add', $this->data));
    }

    public function edit() {

        $db = $this->load->model('account_menu');
        $this->data['level_list'] = $db->getRoleLevel();
        $this->data['menu_list'] = $db->GetMenu();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
            if (isset($this->post['action']) && $this->post['action'] === 'update') {
                $db->menuUpdate($this->post);
                exit();
            } elseif (isset($this->post['action']) && 'select' === $this->post['action']) {
                $json = $db->getMenuSingleReturn($this->post);
                echo json_encode($json);
                exit();
            } elseif (isset($this->post['action']) && preg_match('/delete/', $this->post['action'])) {
                
            }
        }

        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/edit/";
        $this->load->display($this->load->view('account/menu_edit', $this->data));
    }

    public function addlevel() {
        $db = $this->load->model('account_menu');

        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/addlevel/";
        $this->load->display($this->load->view('account/menu_level-add', $this->data));
    }

    public function editlevel() {
        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/editlevel/";
        $this->load->display($this->load->view('account/menu_level-edit', $this->data));
    }

    /**
     * 
     */
    public function addProfissao() {
        $db = $this->load->model('account_menu');
        if ($_SERVER['REQUEST_METHOD'] === "POST" && $this->session['token'] === $_POST['input_token']) {

            $db->Profissao($_POST);
            $json = array();
            $json['success'] = true;
            echo json_encode($json);
            exit();
        }
        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/addProfissao/";
        $this->load->display($this->load->view('account/menu_profissao-add', $this->data));
    }

    public function editProfissao() {
        
        $db = $this->load->model('account_menu');
        $this->data['profissao'] = $db->SelectTodosProfissao();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (isset($_POST['del']) && $_POST['del'] === 'yes') :
                $db->deleteProfissao($_POST);
            else :
                $db->Profissao($_POST);
            endif;

            $json = array();
            $json['success'] = true;
            echo json_encode($json);
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['id'])) :
                $query = $db->SelectProfissao($_GET);
                echo json_encode($query);
                exit();
            endif;
        }

        $this->data['token'] = $this->session['token'];
        $this->data['url'] = $this->http_host . "account/menu/editProfissao/";
        $this->load->display($this->load->view('account/menu_profissao-edit', $this->data));
    }

    private function getMenu() {
        $db = $this->load->model('account_menu');
        $data = $db->GetMenu();
        return $data;
    }

    private function menu($data = array()) {

        $array = array();
        $array['menu'][] = array('name' => 'Setting Menu', 'href' => './account/menu/', 'icon' => '');
        $array['menu'][] = array('name' => 'Setting IP Access', 'href' => './account/manager/ipaccess/', 'icon' => '');
        $array['menu'][] = array('name' => 'Fix Errors', 'href' => './account/fixerrors/', 'icon' => '');
        $array['menu'][] = array('name' => 'Manager Tickets Clients', 'href' => './account/manager/ticketsclients/', 'icon' => '');

        return $array;
    }

}

?>
