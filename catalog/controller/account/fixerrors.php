<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AccountFixerrorsController extends Controller {

    public function index($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();


        $this->load->display($this->load->view('account_fixerrors/main', $this->data));
    }

    public function imagesstaff($data = array()) {
        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();

        $db = $this->load->model('account_fixerrors');
        $list_images = $db->staffimage();
        $folder = __root . "/images/staff/";

        $list_db = array();
        foreach ($list_images as $list_db_) {
            $list_db[] = $list_db_['image'];
        }

        $list = array();
        if (is_dir($folder)) {
            $dir = opendir($folder);
            while (false !== ($entry = readdir($dir))) {
                if (strlen($entry) > 2) {
                    $list[] = $entry;
                }
            }
        }

        $lista = array_diff($list, $list_db);
        foreach ($lista as $listas) {
            unlink($folder . $listas);
        }

        $this->data['files'] = count($lista);

        $this->load->display($this->load->view('account_fixerrors/imagesstaff', $this->data));
    }

    public function fixpass() {

        $db = $this->load->model('account_fixerrors');

        if ($this->server['REQUEST_METHOD'] === "POST") {
            $array = array();
            $array['__rm-password'] = $this->salt_login->randon();
            $array['__rm-u'] = $this->post['__rm-u'];

            $db->resetPass($array);
            $send = array();
            $send['password'] = $array['__rm-password'];

            foreach ($db->getStaff() as $datas) {
                if ((int) $array['__rm-u'] === (int) $datas['user_id'])
                    $send['email'] = $datas['email'];
            }
            $this->sendEmail($send);

            $success['success'] = true;
            echo json_encode($success);
            exit();
        }

        $this->data['header'] = $this->load->controller('common_header');
        $this->data['bottom'] = $this->load->controller('common_bottom');
        $this->data['menu'] = $this->menu();
        $this->data['url'] = "./account/fixerrors/fixpass/";

        $data = array();
        foreach ($db->getStaff() as $datas) {
            array_push($data, array('id' => $datas['user_id'], "name" => $datas['name']));
        }
        $this->data['staff'] = $data;
        unset($data);

        $this->load->display($this->load->view('account_fixerrors/fixpass', $this->data));
    }

    private function sendEmail($data = array()) {

        $subject = " RodyMailer :: your email request ";

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: RodyMailer-noreply <noreply@rodymailer.com>";
        $headers[] = "Bcc: System Admin <me@rodrigomanara.co.uk>";
        //$headers[] = "Reply-To: {$data['name']} <{$data['email']}>";
        $headers[] = "Subject: {$subject}";
        $headers[] = "X-Mailer: PHP/" . phpversion();


        $message = "nova senha : " . $data['password'];

        $additional_headers = implode(",", $headers);


        if (mail($data['email'], $subject, $message, $additional_headers)) {
            return true;
        } else {
            return false;
        }
    }

    private function menu($data = array()) {

        $array = array();

        $array['menu'][] = array('name' => 'Images sem links Staff', 'href' => './account/fixerrors/imagesstaff/', 'icon' => '');
        $array['menu'][] = array('name' => 'Fix user PassWord', 'href' => './account/fixerrors/fixpass/', 'icon' => '');

        return $array;
    }

}

?>
