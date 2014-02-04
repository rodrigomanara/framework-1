<?php

class ManagerEmailController extends Controller {

    public $header;
    public $bottom;
    public $user;
    public $pass;
    public $localHost;
    

    public function __construct() {
        parent::__construct();

        //$this->header =  $this->load->loadController('controller/common/header');
        //$this->bottom = $this->load->loadController('controller/common/bottom');
        
         
        $this->hostname = "mail.directoffersuk.co.uk"; 
        $this->user = "no-reply@directoffersuk.co.uk"; 
        $this->pass = "no_reply99"; 
        
    }

    public function emailoutfromlist() {
        $list = $this->BouceBack();

        $db = $this->load->loadModel('model/email');
        $data = array();
        if (count($list) > 0) {
            foreach ($list['email'] as $lists) {
                //echo $lists ."</br>";
                if ($db->checkEmailList($lists) == 0)
                    $data[] = $lists;
            }

            $db->addEmailtoBouceBackList($data);
        }
    }

    public function BouceBack() {
        stream_wrapper_register('pop3', 'pop3_stream');  /* Register the pop3 stream handler class */

        $pop3 = new pop3_class;
        $pop3->hostname = "mail.directoffersuk.co.uk";
        /* POP 3 server host name */
        $pop3->port = 110;
        /* POP 3 server host port, usually 110 but some servers use other ports Gmail uses 995 */
        $pop3->tls = 0;
        /* Establish secure connections using TLS */
        $user = $this->user;
        /* Authentication user name */
        $password =$this->pass;
        /* Authentication password  */
        $pop3->realm = "";
        /* Authentication realm or domain  */
        $pop3->workstation = "";
        /* Workstation for NTLM authentication */
        $apop = 0;
        /* Use APOP authentication */
        $pop3->authentication_mechanism = $user;
        /* SASL authentication mechanism */
        $pop3->debug = 0;
        /* Output debug information  */
        $pop3->html_debug = 0;
        /* Debug information is in HTML */
        $pop3->join_continuation_header_lines = 0;
        /* Concatenate headers split in multiple lines */


        $email = array();
        if (($error = $pop3->Open()) == "") {
            if (($error = $pop3->Login($user, $password, $apop)) == "") {
                $result = $pop3->ListMessages("", 0);
                if (is_array($result)) {
                    for (Reset($result), $message = 0; $message < count($result); Next($result), $message++) {
                       $pop3->RetrieveMessage(Key($result), $headers, $body, 2);
                        $b = $this->readMessage(Key($result));
                        echo "<PRE>Message " . Key($result) . "  :\n---Message headers starts below---</PRE>\n";
                        echo "<pre>" ;
                        var_dump($headers);
                        var_dump($b);
                        echo "</pre>";
                       
                        for ($line = 0; $line < count($headers); $line++) {
                            if (strstr(HtmlSpecialChars($headers[$line]), "X-Failed-Recipients:")) {
                                $list = explode("X-Failed-Recipients:", HtmlSpecialChars($headers[$line]));
                                if (count($list) > 0) {
                                    $email['email'][] = trim($list[1]);
                                    $email['msn'][] = Key($result);
                                    $email['msn_id'][] = 0;

                                    //echo $pop3->DeleteMessage(Key($result));
                                }
                            }
                        }
                        echo "<br/>====================================== end =================================================================================<br/>";
                    }
                }
            }
            if ($error == "" && ($error = $pop3->Close()) == "")
                ;
        }
        return $email;
    }

    public function readMessage($id) {
  

       // stream_wrapper_register('pop3', 'pop3_stream');  
       /* Register the pop3 stream handler class */
 
        $realm = UrlEncode("");                         /* Authentication realm or domain            */
        $workstation = UrlEncode("");                   /* Workstation for NTLM authentication       */
        $apop = 0;                                      /* Use APOP authentication                   */
        $authentication_mechanism = UrlEncode("USER");  /* SASL authentication mechanism             */
        $debug = 0;                                     /* Output debug information                  */
        $html_debug = 1;                                /* Debug information is in HTML              */
        $message = 0;
        $message_file = 'pop3://' . $this->user . ':' . $this->pass . '@'.$this->hostname.'/'. $id .
                '?debug=' . $debug . '&html_debug=' . $html_debug . '&realm=' . $realm . '&workstation=' . $workstation .
                '&apop=' . $apop . '&authentication_mechanism=' . $authentication_mechanism;
         

        $mime = new mime_parser_class;
        $mime->decode_bodies = 0;
        $parameters = array(
            'File' => $message_file,
            'SkipBody' => 0,
        );
        $success = $mime->Decode($parameters, $decoded);

        if ($success){
           
            if ($mime->Analyze($decoded[0], $results)) {
               
                $array = array();
                $a = explode("Message-ID:",$results['Data']);
                $b = explode("Subject:", $a[1]);
                $array['Data'] = $b[0];
                $array['email'] = $results['From'][0]['address'];
                return $array;
                 
            }
            else{}
               // echo 'MIME message analyse error: ' . $mime->error . "\n";
        }
    }

    public function reportBouceBackPerCampain() {
        $db = $this->load->loadModel('model/email');


        $this->header;
        $data['title'] = 'Main :: Manager Control :: Upload Email List';

        $this->data['report'] = $db->requestCampainBouceBack();

        /** home * */
        $file_name = 'view/default/report/email_bouce_back_by_campaign.tpl';
        $this->load->view($file_name, $this->data);

        /**         * ** bottom ** */
        $this->bottom;
    }

}

?>
