<?php

class AccountManagerController extends Controller {

    //put your code here
    public function __construct($data = array()) {
        parent::__construct();
        if (!isset($this->session['level']) or $this->session['level'] === 0) {
            $this->functions->redirect('./account/login/');
        }
    }

    public function index($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');

        $this->data['menu'] = $this->menu();
        $this->load->display($this->load->view('account_manageraccount', $this->data));
    }

    public function createaccount($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $db = $this->load->model('account_manager');
        $this->data['menu'] = $this->menu();

        $data = $db->selectaccoutrequestpendentes();
        $i = 0;
        
        foreach ($data as $datas) {

            $image_request = ((int) $datas['approved'] == 0 ? $this->image->icon('icon/001_10', '15px', '15px') : $this->image->icon('icon/001_09', '15px', '15px'));

            $image_account_setup = ((int) $datas['approved'] === 1 ? $this->image->icon('icon/001_06', '15px', '15px') : (int) $datas['approved'] === 0 ? $this->image->icon('icon/001_01', '15px', '15px') : $this->image->icon('icon/001_11', '15px', '15px'));

            $this->data['clients'][$i]['name'] = $datas['name'];
            $this->data['clients'][$i]['email'] = $datas['email'];
            $this->data['clients'][$i]['request'] = $image_request;
            $this->data['clients'][$i]['setuptaccount'] = $image_account_setup;
            $this->data['clients'][$i]['action'] = ((int) $datas['approved'] === 0 ? true : false);
            $this->data['clients'][$i]['user_id'] = $datas['user_id'];
            $i++;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($this->post['user_id'])) {
                $db->createaccount($this->post);

                $json['success'] = true;

                echo json_encode($json);
            }
            exit();
        }

        $this->data['form_url'] = $this->url;
        $this->load->display($this->load->view('account_createaccount', $this->data));
    }

    protected function createaccoutreturndata($data = array()) {
        $db = $this->load->model('account_manager');
    }

    public function deleteaccount($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->load->display($this->load->view('account_deleteaccount', $this->data));
    }

    public function settingaccount($data = array()) {

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $db = $this->load->model('account_manager');
        $this->data['menu'] = $this->menu();
        $array['db_not_set'] = 0;
        $this->data['form_url'] = $this->url;


        if ($this->server['REQUEST_METHOD'] === 'POST') {
            if (isset($this->post['user_id'])) {
                $row = $db->selectaccount($this->post);
                $json = array();
                foreach ($row as $key => $value) {
                    $json[$key] = $row[$key];
                }
                echo json_encode($json);
                exit();
            } else {

                $value['db-user'] = $this->post['__rm-dbuser'];
                $value['db-pass'] = $this->post['__rm-dbpass'];
                $value['db-dbname'] = $this->post['__rm-dbname'];

                $data['db_settings'] = serialize($value);
                $data['root'] = __cache . $this->post['__rm-domain'];
                $data['user_id'] = $this->post['__rm-user_id'];
                $data['account_id'] = $this->post['__rm-account_id'];

                $db->accoutsetupdbsetting($data);
            }
        }

        $data = $db->selectaccount($array);

        $i = 0;
        foreach ($data as $datas) {

            $this->data['clients'][$i]['name'] = $datas['name'];
            $this->data['clients'][$i]['subdomain'] = $datas['subdomain'];
            $this->data['clients'][$i]['open_account'] = date('d M Y', strtotime($datas['open_account']));
            $this->data['clients'][$i]['user_id'] = $datas['user_id'];
            $i++;
        }


        $this->load->display($this->load->view('account_settingaccount', $this->data));
    }

    public function ticketsclients($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();


        $this->load->display($this->load->view('account_ticketsclientsaccount', $this->data));
    }

    /**
    * menuSetting
    * @param __name $name Description setting a menu system
    */

    public function menuSetting() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['url'] = $this->http_host . "account/manager/menuSetting/";
        $this->data['token'] = $this->session['token'];
        $this->data['lista'] = $this->getMenu();
        $this->data['list_folder'] = '';
        

        $this->load->display($this->load->view('account/menu_setting', $this->data));
    }
    
    public function FileString(){
        if($_SERVER['REQUEST_METHOD']=== "POST"){
            
        }
    }

    /**
     * MenuAdd
     * 
     * @author Rodrigo Manara<me@rodrigomanara.co.uk>
     * @param Json-Post  echo return json encode
     * @class_Type private 
     * @comments : Only on the class not allow in others class
     */
    private function MenuAdd($post) {
        $db = $this->load->model('account_manager');

        $data['__name'] = $post['__name'];
        $data['__parent'] = $post['__parent'];
        $data['__url'] = $post['__url'];

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

    /**
     * MenuEdit
     * 
     * @author Rodrigo Manara<me@rodrigomanara.co.uk>
     * @param Json-Post  echo return json ecnode
     * @class_Type private 
     * @comments : Only on the class not allow in others class
     */
    private function MenuEdit($post) {
        $db = $this->load->model('account_manager');

        $data['__name'] = $post['__name'];
        $data['__parent'] = $post['__parent'];
        $data['__url'] = $post['__url'];
        $data['_id_menu'] = $post['_id_menu'];

        $json = array();

        if ($db->EditMenuModel($data)) {
            $json['success'] = true;
        } else {
            $json['success'] = false;
        }
        echo json_encode($json);
        exit();
    }
    
     

    /**
     * @param type $post
     * @return type
     */
    private function getMenu() {
        $db = $this->load->model('account_menu');
        $data = $db->GetMenu();
        return $data;
    }

    /**
     * MenuLevelAdd
     * 
     * @param type $post
     * @return type
     * 
     * 
     */
    private function MenuLevelAdd($post) {
        $db = $this->load->model('account_manager');

        $_post['__name'] = $post['__name'];
        $_post['__level'] = $post['__level'];

        $data = $db->getMenuLevel($_post);
        $json = array();
        if (isset($data['name'])) {
            $json['success'] = false;
        } else {
            $db->setMenuLevel($_post);
            $json['success'] = true;
        }
        echo json_encode($json);
        exit();
    }
    
     /**
     * 
     * @param type $data
     * @return string
     */
    private function MenuLevelEdit() {
        $db = $this->load->model('account_manager');
    }
    
     
    /**
     * ipaccess
     * @see ipaccess
     */
    public function ipaccess() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['url'] = $this->http_host . "account/manager/menuSetting/";
        $this->data['token'] = $this->session['token'];

        $this->load->display($this->load->view('account/settings_ipsettings', $this->data));
    }

   

    private function menu($data = array()) {

        $array = array();

        $array['menu'][] = array('name' => 'Setting Menu', 'href' => './account/manager/menuSetting/', 'icon' => '');
        $array['menu'][] = array('name' => 'Setting IP Access', 'href' => './account/manager/ipaccess/', 'icon' => '');
        $array['menu'][] = array('name' => 'Fix Errors', 'href' => './account/fixerrors/', 'icon' => '');
        $array['menu'][] = array('name' => 'Manager Tickets Clients', 'href' => './account/manager/ticketsclients/', 'icon' => '');

        return $array;
    }

}
?>