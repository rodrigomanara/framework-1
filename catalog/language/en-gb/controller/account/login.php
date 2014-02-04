<?php

class AccountLoginController extends Controller {

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

        $this->data['randon_image'] = '<img src="' . $this->salt_login->image($this->numeros) . '" />';
        $this->data['form_url'] = $this->url;

        if($this->server['REQUEST_METHOD'] === "POST"){
            $this->login($this->post);
            exit();
        }
        

        $this->load->display($this->load->view('account_login', $this->data));
    }

    private function login($data = array()) {

        $db = $this->load->model('account_login');

        $this->data['email'] = $data['__rm-login'];
        $this->data['pass'] = $data['__rm-pass'];
        $this->data['anti-span'] = $_SESSION['randon'];

        $error['data'] = $this->data;
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
                    if ((int) $_SESSION['randon'] === (int) $data['__rm-span']) {
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

        if ((int) count($data) === (int) $i) {

            $check = $db->login($this->data);
            if ((int) $check == 1) {
                $user_id = $db->user_id($this->data);
                $json = array();
                if (!is_null($user_id) or !empty($user_id)) {

                    $_SESSION['login'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['level'] = $db->userlevel($this->data);
                    $session_id = $this->randon . session_id();

                    $json['url'] = './account/home/?token=' . $session_id;
                     $_SESSION['randon'] = null;

                    echo json_encode($json);
                }
            } else {

                isset($_SESSION['try']) ? $_SESSION['try']++ : $_SESSION['try'] = 1;
                if ($_SESSION['try'] >= 3) {
                    unset($_SESSION['randon']);
                    unset($_SESSION['try']);
                    $json['url'] = './account/login/forgotpass/';

                    echo json_encode($json);
                } else {
                    $json['error'] = true;
                    $json['info'] = "please check your user or password" . " <br/> times error : " . $_SESSION['try'];
                    echo json_encode($json);
                }
            }
        } else {
            echo json_encode($error);
        }
    }

    public function logout() {
        if (isset($this->session['user_id'])) {
            if (session_destroy())
                echo "<script> window.location = './' </script>";
        }
    }

    public function forgotpass() {

        if ($this->server['REQUEST_METHOD'] == "POST") {
            $data = $this->post['__rm-email'];
            $json = array();
            if($this->sendnotificationforgotemail($data)){
                $json['error']  =  true;
                $json['info'] = 'email send! <br/> please check you mailbox.';
            }else{
                 $json['error']  =  true;
                  $json['info'] = 'email not send! <br/> please check again in 3 minutes.';
                 
            }
            
        } else {
            $db = $this->load->model('account_login');

            $this->data['header'] = $this->load->controller('common_header');
            $this->data['bottom'] = $this->load->controller('common_bottom');

            $this->data['randon_image'] = '<img src="' . $this->salt_login->image($this->numeros) . '" />';
            $this->data['form_url'] = "./account/login/forgotpass/";
            $this->load->display($this->load->view('account_forgotpass', $this->data));
        }
    }

    private function sendnotificationforgotemail($data) {
        $subject = "&utdot;&utdot; RodyMailer :: your email request ";

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: RodyMailer-noreply<noreply@domain.com>";
        //$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
        $headers[] = "Reply-To: {$data['name']} <{$data['email']}>";
        $headers[] = "Subject: {$subject}";
        $headers[] = "X-Mailer: PHP/" . phpversion();
        
        $this->data['text'] = null;
        $this->data['link'] = null;
        $this->data['base'] = null;
        $this->data['menu'] = null;
        
        $message = $this->load->view('account_forgotemailsendtemplate', $this->data);
        
        $additional_headers = implode(",", $headers);


        if(mail($data['email'], $subject, $message, $additional_headers)){
            return true;
        }
    }

}
?>
