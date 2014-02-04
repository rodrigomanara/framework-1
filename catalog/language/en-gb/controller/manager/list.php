<?php

class ManagerListController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
       

        /**         * ** Menu ** */
        $this->load->loadController('controller/common/header');

        $data['title'] = 'Main :: Control List';
        $data['Menu'] = array(
            array('name' => 'List of Subscribes', 'img' => 'images/icon/001_01.png', 'href' => './?F=' . $this->url . '/viewSubscriber'),
            array('name' => 'List of UnSubscribes', 'img' => 'images/icon/001_01.png', 'href' => './?F=' . $this->url . '/viewUnSubscriber'),
            array('name' => 'List Group', 'img' => 'images/icon/001_01.png', 'href' => './?F=' . $this->url . '/Addtogroup'),
            array('name' => 'Upload Email List', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . $this->url . '/Display_uploadEmail')
        );

        /** home * */
        $file_name = 'view/default/manager/list.tpl';
        $this->load->view($file_name, $data);


        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    public function viewSubscriber() {
         

        $this->load->loadController('controller/common/header');


        /*         * * Load data from db ** */
        $db = $this->load->loadModel('model/list');

        $data['title'] = 'Controller :: View List Of Subscribers';
        $data['list'] = $db->getSubscriberDO();


        $file_name = 'view/default/manager/viewSubscribers.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    public function viewUnSubscriber() { 

        $this->load->loadController('controller/common/header');


        $data['title'] = 'Controller ::  View List Of UnSubscribers';

        /*         * * Load data from db ** */
        $db = $this->load->loadModel('model/list');
        $data['list'] = $db->getUnSubscriberDO();


        $file_name = 'view/default/manager/viewUnSubscribers.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    function transferData() { 
        
        $db = $this->load->loadModel('model/list');

        $row = $db->TransferSubscriberDO();

        foreach ($row as $data) {
            $db->insertIntoMKTDB(array("firstname" => $data['firstname']
                , "lastname" => $data['lastname']
                , "email" => $data['email']
                , "newsletter" => $data['newsletter']
                , "date_added" => $data['date_added']));
        }
    }

    function Addtogroup() {
        $this->load->loadController('controller/common/header');

        $data['title'] = 'Main :: Control List / Add to Group';
        /*         * * Load data from db ** */
        $db = $this->load->loadModel('model/list');

        $data['select'] = $db->select_group_email();

        if (isset($_GET['group_id'])) {
            $data['list'] = $db->get_email_group($_GET['group_id']);
        }

        $file_name = 'view/default/manager/Addtogroup.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    function returnAddGround() {
        $db = $this->load->loadModel('model/list');

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $request = $_GET;
        } else {
            $request = $_POST;
        }
        $data = $db->get_email_group($request);
        if (is_array($data)) {
            echo json_encode($data);
        } else {
            echo json_encode(array("error" => 0));
        }

        // 
    }

    function prep_Group() { 

        $json = array();


        $this->data['name'] = $_POST['group_name'];

        if (empty($this->data['name']) or $this->data['name'] == "") {
            $json['error'] = true;
            $json['msn'] = "Field is empty";
            print_r(json_encode($json));
            exit;
        }

        if (!empty($this->data['name']) or $this->data['name'] != "") {
            $db = $this->load->loadModel('model/list');
            $db->create_group($this->data);
        }
    }

    public function add_or_delete_user_group() { 

        $this->data['add_to_group'] = $_POST;

        $db = $this->load->loadModel('model/list');
        $db->add_or_delete_user_group($this->data['add_to_group']);
    }

    public function Display_uploadEmail() { 

        $this->load->loadController('controller/common/header');

        $data['title'] = 'Main :: Manager Control :: Upload Email List';

        /** home * */
        $file_name = 'view/default/manager/upload_email_list.tpl';
        $this->load->view($file_name, $data);

        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    public function uploadEmail() { 

        $storagename = $_FILES['file']['tmp_name'];
        $row = 1;

        $json = array();

        
            if (($handle = fopen($storagename, "r")) !== FALSE) {
                $json['success'] = true;
                $count_array = 0;
                while (($data = fgetcsv($handle, filesize($storagename), ",")) !== FALSE) {
                    if ($row > 1) {

                        $this->data['import'][$count_array] = array('email' => $data[0], 'firstname' => $data[1], 'lastname' => $data[2], 'date_added' => null, 'newsletter' => 1, 'email-group' => (isset($data[3]) ? $data[3] : 0));
                        $json["total"] = $row;
                        
                        
                        if((int)$count_array == 10){
                            $this->add_email($this->data['import']);
                            $count_array =0;
                        }
                    }
                    $count_array++;
                    $row++;
                }
                fclose($handle);
            }

            
            //$db->add_to_user_list_group($this->data['import'][0]['email-group']);
            print json_encode($json);
         
    }
    function add_email($array = array()){
        $db = $this->load->loadModel('model/list');
        $db->insertIntoMKTDB($array);
    }

}
?>
