<?php

class ManagerTemplateController extends Controller {

    public function index() {
        parent::__construct();

        /**         * ** Menu ** */
        $this->load->loadController('controller/common/header');

        $data['title'] = 'Main :: Manager Control';

        $data['Menu'] = array(
            array('name' => 'Template {Create Only}', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . $this->url . '/displayTemplateList&edit=no'),
            array('name' => 'Template {Edit Only}', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . $this->url . '/displayTemplateList&edit=yes'),
            array('name' => 'campaign Agenda {only add New}', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . $this->url . '/AddNewCapaign'),
            array('name' => 'campaign Agenda {Check only}', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . $this->url . '/getCampain')
        );

        /** home * */
        $file_name = 'view/default/manager/template.tpl';
        $this->load->view($file_name, $data);

        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    /** Template managemanet */
    public function displayTemplateList() {
        parent::__construct();

        $this->load->loadController('controller/common/header');
        $file_name = './view/default/manager/displayTemplateList.tpl';

        if (isset($_GET['edit']) && $_GET['edit'] == "no") {
            $list = $this->function->list_dir(__view . "/manager/templates/");

            for ($i = 0; $i < count($list); $i++) {
                ob_start();
                require __view . "/manager/templates/" . $list[$i];
                $html = ob_get_contents();
                $this->data['html'][] = array("layout" => $html, "name" => $list[$i], "url" => '?F=manager/template/displayTemplateEdit&t_id=' . $i);
                ob_end_clean();

                $_SESSION['html'][$i] = $html;
                unset($html);
            }
        } else {
            $db = $this->load->loadModel('model/list');
            $this->data['select'] = $db->select_templateEdit();
        }

        $this->load->view($file_name, $this->data);
        $this->load->loadController('controller/common/bottom');
    }

    //
    public function displayTemplate($data) {
        parent::__construct();

        $this->load->loadController('controller/common/header');
        $file_name = 'view/default/manager/displayTemplate.tpl';
        $template = $_REQUEST['t'];

        $db = $this->load->loadModel('model/template');
        $data['template_html'] = $db->getTemplate($template);

        $this->load->view($file_name, $data);
        $this->load->loadController('controller/common/bottom');
    }

    //
    public function displayTemplateEdit() {
        parent::__construct();

        $_SESSION['temp_name'] = $_REQUEST['t_id'];
        $this->load->loadController('controller/common/header');
        $file_name = 'view/default/manager/template_edit.tpl';

        if (isset($_REQUEST['edit']) && $_REQUEST['edit'] == "yes") {
            $db = $this->load->loadModel('model/template');
            $row = $db->getTemplate($_REQUEST['t_id']);
            unset($_SESSION['html']);

            $_SESSION['name'][$_REQUEST['t_id']] = $row['tpl_name'];
            $_SESSION['html'][$_REQUEST['t_id']] = html_entity_decode($row['html']);

            $template = $_REQUEST['t_id'];
        } else {
            $template = $_REQUEST['t_id'];
        }

        $this->load->view($file_name, $template);
        $this->load->loadController('controller/common/bottom');
    }

    //
    public function displayFrameTemplateEdit() {
        parent::__construct();

        $file_name = 'view/default/manager/template_frame_edit.php';
        $this->load->view($file_name);
        $this->load->loadController('controller/common/bottom');
    }
    

    ##image trit

    public function encode_img($img) {
        $fd = fopen($img, 'rb');
        $size = filesize($img);
        $cont = fread($fd, $size);
        fclose($fd);
        $encimg = base64_encode($cont);
        return $encimg;
    }

    //
    public function base64_encode_image($imagefile) {

        $imgtype = array('jpg', 'gif', 'png');
        $filename = file_exists($imagefile) ? htmlentities($imagefile) : die('Image file name does not exist');
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array($filetype, $imgtype)) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        } else {
            die('Invalid image type, jpg, gif, and png is only allowed');
        }
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }

    //view the listing
    public function viewCampaign() {
        parent::__construct();
        $this->load->loadController('controller/common/header');

        $day = $_REQUEST['d'];
        $month = $_REQUEST['m'];
        $year = $_REQUEST['y'];

        $data['day'] = $this->function->day_in_week(array("year" => $year, "month" => $month, "day" => $day)) . " " . $day . " /" . $month . " /" . $year;


        $db = $this->load->loadModel('model/template');

        $hours = 24;

        for ($i = 0; $i < $hours; $i++) {
            $row = $db->getSchedulerListByDate(array('hora' => date('H:i:s', mktime($i, 0, 0)), 'day' => $day, 'month' => $month, 'year' => $year));
            $table[$i]['time'] = date('H:i  a', mktime($i, 0));
            $table[$i]['agenda'] = $row['total'];
        }


        $data['table'] = $table;

        $file_name = 'view/default/manager/viewCampaign.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    //set session for a template
    public function setImageSession() {
        parent::__construct();

        $_SESSION['template_name_session'] = $_POST['template_name'];
    }

    //
    public function getImage() {

        $data = $_POST['search'];

        $db = $this->load->loadModel('model/template');
        $image = $db->getLines($data);

        $agrup = '';
        foreach ($image as $images) {
            $agrup['image'] = $images['image'];
            $agrup['upc'] = $images['upc'];
        }
        $json = json_encode($agrup);
        printf($json);
    }

    //
    public function getCampain() {
        parent::__construct();
        $db = $this->load->loadModel('model/template');
        $this->load->loadController('controller/common/header');

        $data['Menu'] = array(
            array('name' => 'Template', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . "manager/template/viewCampaign/")
        );

        if (isset($_POST['m']) && $_POST['m'] != "") {
            $data['month'] = ($_POST['m'] >= 10 ? $_POST['m'] : (strlen($_POST['m']) >= 2 ? $_POST['m'] : "0" . $_POST['m']));
            $data['year'] = $_POST['y'];
            $data['vm'] = ($_POST['m'] >= 10 ? $_POST['m'] : (strlen($_POST['m']) >= 2 ? $_POST['m'] : "0" . $_POST['m']));
            $data['vy'] = $_POST['y'];
        } else {
            $data['vm'] = date('m');
            $data['vy'] = date('Y');
            $data['month'] = date('m');
            $data['year'] = date('Y');
        }

        $data['day'] = $this->function->days_in_month($data['month'], $data['year']);

        $total = '00';
        
        
        /* create date */
        $table = '';

        $break = 1;
        for ($i = 1; $i <= $data['day']; $i++) {

            $date = $this->function->day_in_week(array("year" => $data['year'], "month" => $data['month'], "day" => $i-1));

            $row = $db->getSchedulerList(array('day' => $i, 'month' => $data['month'], 'year' => $data['year']));
            $total = ($row['total'] > 0) ? "<img src='images/icon/001_15.png' width='10px' />" : "";


            /** check select date to add space on table */
            if ($i == 1) {
                $count = 0;
                if ($date == 'Mon') {
                    $count += 0;
                } elseif ($date == 'Tue') {
                    $count += 1;
                } elseif ($date == 'Wed') {
                    $count += 2;
                } elseif ($date == 'Thu') {
                    $count += 3;
                } elseif ($date == 'Fri') {
                    $count += 4;
                } elseif ($date == 'Sat') {
                    $count += 5;
                } elseif ($date == 'Sun') {
                    $count += 6;
                }


                /** add space */
                $break += $count;
                for ($a = 0; $a < $count; $a++) {
                    $table .= "<td style='border: 1px solid grey'> </td>";
                }

                $table .= "<td style='border: 1px solid grey'>  <a href='" . $data['Menu'][0]['href'] . "&d={$i}&m={$data['vm']}&y={$data['vy']}' >" . $i . " </a> {$total}</td>";
            } else {
                $table .= "<td style='border: 1px solid grey'>  <a href='" . $data['Menu'][0]['href'] . "&d={$i}&m={$data['vm']}&y={$data['vy']}' >" . $i . " </a> {$total}</td>";
            }

            if ($break == 7) {
                $table .= "</tr> <tr>";
                $break = 0;
            }

            $break++;
        }

        $data['table'] = $table;

        $file_name = 'view/default/manager/campain.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    // add new campain will redirect to open new campaing
    public function AddNewCapaign() {
        parent::__construct();
        $db = $this->load->loadModel('model/template');
        $this->load->loadController('controller/common/header');

        $data['Menu'] = array(
            array('name' => 'Template', 'img' => 'images/icon/001_01.png', 'href' => '?F=' . "manager/template/openCampaign/")
        );

        if (isset($_POST['m']) && $_POST['m'] != "") {
            $data['month'] = ($_POST['m'] >= 10 ? $_POST['m'] : (strlen($_POST['m']) >= 2 ? $_POST['m'] : "0" . $_POST['m']));
            $data['year'] = $_POST['y'];
            $data['vm'] = ($_POST['m'] >= 10 ? $_POST['m'] : (strlen($_POST['m']) >= 2 ? $_POST['m'] : "0" . $_POST['m']));
            $data['vy'] = $_POST['y'];
        } else {
            $data['vm'] = date('m');
            $data['vy'] = date('Y');
            $data['month'] = date('m');
            $data['year'] = date('Y');
        }


        $data['day'] = $this->function->days_in_month($data['month'], $data['year']);

        /* create date */
        $table = '';
        $total = '';
        $break = 1;
        $count = 0; 

        for ($i = 1; $i <= $data['day']; $i++) {

            $date = $this->function->day_in_week(array("year" => $data['year'], "month" => $data['month'], "day" => $i - 1));

            $row = $db->getSchedulerList(array('day' => $i , 'month' => $data['month'], 'year' => $data['year']));
            $total = ($row['total'] > 0) ? "<img src='images/icon/001_15.png' width='10px' />" : "";

            if ($i === 1) {
                 
                    if ($date == 'Mon') {
                        $count += 0;
                    } elseif ($date == 'Tue') {
                        $count += 1;
                    } elseif ($date == 'Wed') {
                        $count += 2;
                    } elseif ($date == 'Thu') {
                        $count += 3;
                    } elseif ($date == 'Fri') {
                        $count += 4;
                    } elseif ($date == 'Sat') {
                        $count += 5;
                    } elseif ($date == 'Sun') {
                        $count += 6;
                    }
                    /** add space */
                    $break += $count;
                    for ($a = 0; $a < $count; $a++) {
                        $table .= "<td style='border: 1px solid grey'> </td>";
                    }
                  

 
                    if ($this->function->diffDate(array("d" => $i, "m" => (int) $data['vm'], "y" => (int) $data['vy']))) {
                        $table .= "<td style='border: 1px solid grey'><a href='" . $data['Menu'][0]['href'] . "&d={$i}&m={$data['vm']}&y={$data['vy']}' >" . $i . " </a> {$total}</td>";
                    } else {
                        $table .= "<td style='border: 1px solid grey'>" . $i . " {$total} </td>";
                    }
               
            } else {
                if ($this->function->diffDate(array("d" => $i, "m" => (int) $data['vm'], "y" => (int) $data['vy']))) {
                    $table .= "<td style='border: 1px solid grey'><a href='" . $data['Menu'][0]['href'] . "&d={$i}&m={$data['vm']}&y={$data['vy']}' >" . $i . " </a> {$total}</td>";
                } else {
                    $table .= "<td style='border: 1px solid grey'>" . $i . " {$total} </td>";
                }
            }
            if ($break == 7) {
                $table .= "</tr> <tr>";
                $break = 0;
            }
            $break++;
        }

        $data['table'] = $table;

        $file_name = './view/default/manager/campain.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    //will display a list with date and hour during all day
    public function openCampaign() {
        parent::__construct();

        $this->load->loadController('controller/common/header');

        $day = $_REQUEST['d'];
        $month = $_REQUEST['m'];
        $year = $_REQUEST['y'];

        $data['day'] = $this->function->day_in_week(array("year" => $year, "month" => $month, "day" => $day)) . " " . $day . " /" . $month . " /" . $year;
        $data['url'] = "./?F=manager/template/addCampaign/";
        $data['date'] = "&year={$year}&month={$month}&day={$day}";

        $hours = 24;
        $table = array();

        for ($i = 0; $i < $hours; $i++) {
            $table[$i]['time'] = date('H:i  a', mktime($i, 0));
            $table[$i]['agenda'] = 'nothing';
        }


        $data['table'] = $table;

        $file_name = 'view/default/manager/openCampaign.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    //display data for scheduler + template name
    public function addCampaign() {
        parent::__construct();
        $this->load->loadController('controller/common/header');

        $data['date']['time'] = $_REQUEST['time'];
        $data['date']['month'] = $_REQUEST['month'];
        $data['date']['day'] = $_REQUEST['day'];
        $data['date']['year'] = $_REQUEST['year'];

        ## get template list
        $db = $this->load->loadModel('model/template');
        $data['template'] = $db->getTemplateList_return();

        $dba = $this->load->loadModel('model/list');
        $data['select'] = $dba->select_group_email();

        $file_name = 'view/default/manager/addCampaign.tpl';
        $this->load->view($file_name, $data);
        $this->load->loadController('controller/common/bottom');
    }

    //view
    public function getTemplateScheduler() {
        parent::__construct();

        $this->load->loadController('controller/common/header');

        foreach ($_REQUEST as $key => $value) {
            @$this->data[$key] = $_GET[$key];
        }

        $db = $this->load->loadModel('model/template');
        $template = $db->getTemplate($this->data['template_id']);
        $this->data['template'] = html_entity_decode($template['html']);
        $file_name = 'view/default/manager/schedular_template.tpl';
        $this->load->view($file_name, $this->data);

        $this->load->loadController('controller/common/bottom');
    }

    //get name from template before
    public function checkTemplateName() {
        parent::__construct();

        $db = $this->load->loadModel('model/template');
        $row = $db->checkTemplateName($_POST);

        if ($row['total'] > 0) {
            print_r(false);
        } else {
            print_r(true);
        }
    }

    ## this part is for creating abd insert data into the data base;
    // prepare data to go to template data base

    function createTemplate() {
        parent::__construct();

        $json = array();

        if (isset($_POST) && (!empty($_POST['template_name']) && !empty($_POST['post_save']))) {

            $this->data['name'] = $_POST['template_name'];
            $this->data['html'] = $_POST['post_save'];
            $this->data['edit'] = isset($_POST['edit']) ? true : false;

            $db = $this->load->loadModel('model/template');
            if ($db->recordeHTML($this->data) == true) {
                $json['success'] = true;
                $json['url'] = "./?F=manager/template/AddNewCapaign";
            } else {
                $json['error'] = false;
                $json['msn'] = "The template name alredy exist.";
            }
        } else {

            $json['error'] = false;
            $json['msn'] = $var;
        }


        print_r(json_encode($json));
    }

    // prepare data to go to scheduler data base
    function createScheduler() {

        $json = array();

        $this->data['time'] = $_POST['time'];
        $this->data['month'] = $_POST['month'];
        $this->data['day'] = $_POST['day'];
        $this->data['year'] = $_POST['year'];
        $this->data['template_id'] = $_POST['template_id'];
        $this->data['group_id'] = $_POST['email_group'];

        $db = $this->load->loadModel('model/template');

        if ($db->recodeScheduler($this->data) == true) {

            $url = "&";
            foreach ($this->data as $key => $value) {
                $url .= $key . "=" . $value;
                $url .= "&";
            }

            $json['success'] = true;
            $json['url'] = './?F=manager/template/getTemplateScheduler&' . $url;
        } else {
            $json['sucess'] = false;
        }

        print_r(json_encode($json));
    }

    //move file and save image into file
    public function uploadImage() {
        parent::__construct();

        $json = array();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = $_POST['location_place'];
            $image = $_FILES["file"]["name"];
            $uploadedfile = $_FILES['file']['tmp_name'];
            $_width = $_POST['width'];

            if ($image) {

                $type = explode("/", $_FILES['file']['type']);

                $extension = strtolower($type[1]);
                if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
                    $errors = 1;
                } else {
                    $size = filesize($_FILES['file']['tmp_name']);

                    if ($size > 600 * 1024) {
                        $errors = 1;
                    }

                    if ($extension == "jpg" || $extension == "jpeg") {
                        $uploadedfile = $_FILES['file']['tmp_name'];
                        $src = imagecreatefromjpeg($uploadedfile);
                    } else if ($extension == "png") {
                        $uploadedfile = $_FILES['file']['tmp_name'];
                        $src = @imagecreatefrompng($uploadedfile);

                        if ($src == false) {
                            $src = imagecreatefromjpeg($uploadedfile);

                            if ($src == false) {
                                $src = imagecreatefromgif($uploadedfile);
                            }
                        }
                    } else {
                        $src = imagecreatefromgif($uploadedfile);
                    }

                    list($width, $height) = getimagesize($uploadedfile);

                    $newwidth = $_width;
                    $newheight = ($height / $width) * $newwidth;
                    $tmp = imagecreatetruecolor($newwidth, $newheight);

                    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    $pic_name = str_replace(" ", "", trim(strtolower($_SESSION['template_name_session']))) . "_" . $name . "." . $extension;

                    imagejpeg($tmp, __image__template . $pic_name, 100);
                    imagedestroy($src);
                    imagedestroy($tmp);

                    $json['image'] = "./images/template/" . $pic_name;
                    print_r(json_encode($json));
                }
            }
        } else {
            $json['image'] = 0;
            print_r(json_encode($json));
        }
    }

}

?>
