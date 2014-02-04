<?php

class AccountRequestController extends Controller {

    static public $numeros;

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['randon']) or is_null($_SESSION['randon'])) {
            $_SESSION['randon'] = $this->randon;
        }
        $this->numeros = $_SESSION['randon'];
    }

    public function index() {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['form_url'] = "./account/request/receive";
        $this->data['randon_image'] = '<img src="' . $this->salt_login->image($this->numeros) . '" />';
        $this->load->display($this->load->view('account_request', $this->data));
    }

    public function receive() {

        $this->data['name'] = $this->post['__rm-name'];
        $this->data['email'] = $this->post['__rm-email'];
        $this->data['span'] = $this->post['__rm-span'];
        $this->data['pass'] = $this->post['__rm-pass'];

        $error = array();

        $i = 0;
        foreach ($this->post as $key => $check) {
            if (is_null($check) or empty($check)) {
                $error[$key] = "Please review this filed";
            } else {

                if (strstr($key, "email")) {
                    if ((strstr($key, "email") && !strstr($check, "@"))) {
                        $error[$key] = "email is not valid";
                    } else {

                        $error[$key] = true;
                    }
                } elseif (strstr($key, "span")) {
                    if ((int) $this->session['randon'] === (int) $this->post['__rm-span']) {
                        $error[$key] = true;
                    } else {
                        $error[$key] = "invalid code!";
                    }
                } else {
                    $error[$key] = true;
                }
            }

            if ($error[$key] === true) {
                $i++;
            }
        }

        if ((int) count($this->post) === (int) $i) {

            $db = $this->load->model('account_addaccount');
            if ($db->addaccount($this->data)) {
                $error['url'] = "./account/login/";
                $_SESSION['randon'] = null;
                $_SESSION['newlogin'] = true;
                echo json_encode($error);
                exit();
            } else {
                $error['error'] = true; 
                $error['info'] = 'Accout already registered!</br> please click here <a href="./account/login/">login</a>';
                echo json_encode($error);
                exit();
            }
        }
        echo json_encode($error);
    }

}

?>
