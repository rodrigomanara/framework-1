<?php

/**
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Controller Stock
 * 
 */
class StaffHomeController extends Controller {

    public function index() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->http_host . 'staff/home/';
        $this->data['add_funcionario'] = $this->http_host . 'staff/home/add/';
        $db = $this->load->model('staff_staff');

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $this->data['edit'] = $this->http_host . 'staff/home/edit/';
            $this->data['delete'] = $this->http_host . 'staff/home/delete/';
            $this->data['query'] = $db->getListaFuncionarios($this->post);
            $json['html'] = $this->load->view('staff_procura', $this->data);
            echo json_encode($json);
            exit();
        }


        $this->load->display($this->load->view('staff_home', $this->data));
    }

    public function add() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->url;
        $db = $this->load->model('staff_staff');
        $data = $db->getRolesList();
        $this->data['list_roles'] = json_encode($data);

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
            if (!$isAjax) {
                $user_error = 'Access denied - not an AJAX request...';
                trigger_error($user_error, E_USER_ERROR);
            } else {
                $return = $db->addNewStaff($this->post);
            }
            $json = array('success' => $return);

            $this->load->display(json_encode($json));
            exit();
        }

        $this->load->display($this->load->view('staff_add', $this->data));
    }

    public function delete() {
        $db = $this->load->model('staff_staff');

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
            if (!$isAjax) {
                $user_error = 'Access denied - not an AJAX request...';
                trigger_error($user_error, E_USER_ERROR);
            } else {

                $array = array();
                foreach ($this->post as $key => $dados) {
                    $array[$key] = $dados;
                }

                $return = $db->disableStaff($array);
            }
            $json = array('success' => $return);

            $this->load->display(json_encode($json));
            exit();
        }
    }

    public function edit() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->load->controller('common_menu');
        $this->data['url'] = $this->url;
        $db = $this->load->model('staff_staff');
        $lista = $db->getRolesList();
        $this->data['list_roles'] = json_encode($lista);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db->updateFuncionario($this->post);
            $json = array('success' => true);
            $this->load->display(json_encode($json));

            exit();
        }

        $this->data['data'] = $db->getFuncionario($this->get);
        $this->load->display($this->load->view('staff_edit', $this->data));
    }

    public function listRoles() {

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
            if (!$isAjax) {
                $user_error = 'Access denied - not an AJAX request...';
                trigger_error($user_error, E_USER_ERROR);
                exit();
            }
            $db = $this->load->model('staff_staff');
            $data = $db->getRoles($this->post);
            $this->load->display(json_encode($data));
        }
    }

    public function menuTab() {
        $array[] = array('url' => './staff/home/add/', 'name' => 'Adicionar Dados de Funcionarios');
        $array[] = array('url' => './staff/home/edit/', 'name' => 'Editar Dados de Funcionarios');

        return $array;
    }

}

?>
