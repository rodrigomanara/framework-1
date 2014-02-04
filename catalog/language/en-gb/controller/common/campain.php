<?php

class campain {
    
     public function index() {
        parent::__construct();

        
        $db = $this->load->loadModel('model/home');
        $db_ = $this->load->loadModel('model/campain');

        $data = array('campain_id' => $this->campain);
        $this->data['open'] = $db->getReportOpen($data);
        $this->data['not_open'] = $db->getReportNotOpen($data);
        $this->data['bouce'] = $this->reportBouceBackPerCampain($this->campain);
 

        // get all campaign
        
        $row = $db_->getCampaignName();
        $data = array('data' => $db->getUser()
            , 'graphic' => $this->graphic($this->campain)
            , "selection" => $row
            , "report" => $this->data
            , "campain" => $this->campain);

        /**         * ** Menu ** */
        $this->load->loadController('controller/common/header');

        /** home * */
        $file_name = 'view/default/common/home.tpl';
        $this->load->view($file_name, $data);

        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    public function graphic($campain) {
        parent::__construct();

        $db = $this->load->loadModel('model/home');
        $data = array('campain_id' => $campain);


        $dataA = null;
        $dataB = null;

        $row = $db->getReportOpen($data);
        $rowb = $db->getReportNotOpen($data);

        $counta = count($row);
        $counta2 = count($rowb);

        $count = ($counta > $counta2 ? $counta : $counta2);

        for ($i = 0; $i < $count; $i++) {

            $date = date('d-m-Y', strtotime($row[$i]['open']));
            $dataA[$date] = $row[$i]['total'];
        }


        $cfg['title'] = 'Campaign';
        $cfg['width'] = 500;
        $cfg['height'] = 250;

        ob_start();
        $this->graphic = new phpMyGraph();

        imagepng($this->graphic->parseHorizontalColumnGraph($dataA, $cfg));
        $image['graphic'] = ob_get_contents();
        ob_end_clean();




        return $image;
    }

    public function report_not_open($campain) {
        $db = $this->load->loadModel('model/home');
        $data = array('campain_id' => $campain);

        $this->data['total_not_open'] = $db->getReportNotOpen($data);
        /**         * ** Menu ** */
        $this->load->loadController('controller/common/header');
        /** home * */
        $file_name = 'view/default/common/not_open.tpl';
        $this->load->view($file_name, $data);
        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    public function report_open() {
        $db = $this->load->loadModel('model/home');

        $this->data['total_open'] = $db->getReportOpen($this->campain);
        $this->data['campain'] = $this->campain;

        $this->load->loadController('controller/common/header');
        /** home * */
        $file_name = 'view/default/common/open.tpl';
        $this->load->view($file_name, $this->data);
        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');


        return $this->data;
    }

    public function reportBouceBackPerCampain($data) {
        $db = $this->load->loadModel('model/email');

        $data = $db->requestCampainBouceBack($data);

        return $data;
    }

    public function report_email_open() {
        $db = $this->load->loadModel('model/home');



        $this->data['campain'] = $this->campain;
        $this->data['data'] = $_GET['data'];
        $data = array('campain_id' => $this->campain, "status" => $this->status, "data" => $_GET['data']);
        $this->data['total_email_open'] = $db->getEmailOpen_notOpen($data);

        $this->load->loadController('controller/common/header');
        /** home * */
        $file_name = 'view/default/common/email_open.tpl';
        $this->load->view($file_name, $this->data);
        /**         * ** bottom ** */
        $this->load->loadController('controller/common/bottom');
    }

    public function access() {
        parent::__construct();

        $file_name = 'view/default/main/admin.tpl';
        $this->load->view($file_name, $data);

        $this->load->loadController('controller/common/bottom');
    }

    public function acessExchange() {


        try {
            $soap_client_url = "https://server-direct/ews/Services.wsdl";
            $client = new SoapClient($soap_client_url, array(
                "login" => 'it',
                "password" => 'boulevard',
                "domain" => 'DIRECT'
                    )
            );
        } catch (SoapFault $soapFault) {
            echo $soapFault;
        }
    }
}

?>
