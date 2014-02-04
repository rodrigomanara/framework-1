<?php

/**
 * @internal functions
 * @access public
 */
class functions {

    /**
     * @see listClassPublicInArray
     * @return array Description
     */
    public function listClassPublicInArray($class_name, $link) {

        include_once $link;
        $list = get_class_methods(new $class_name);
        $data = array();
        foreach ($list as $item) {
            $data[] = $item;
        }
        return $data;
    }

    public function listUrlVar($data) {
        $str = null;
        foreach ($data as $key => $datas) {

            if (preg_match("/route/", $key)) {
                $str .= $datas;
            } else {
                $str .= "&" . $key . "=" . $datas;
            }
        }
        return $str . "/";
    }

    public function days_in_month($month, $year) {
        // calculate number of days in a month 
        return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
    }

    public function day_in_week($data = array()) {
        return date('D', strtotime($data['year'] . $data['month'] . $data['day']));
    }

    public function diffDate($data) {
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        /* convert */

        $date1 = mktime(0, 0, 0, $month, $day, $year);
        $date2 = mktime(0, 0, 0, $data['m'], $data['d'], $data['y']);
        $calc = $date1 - $date2;


        if ($calc > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * list_dir
     * @param fopen $path
     * @return array
     */
    public function list_dir($path) {
        // $root = str_replace('\\\\','\\',str_replace('/','\\',__root . $path . "\\"));//$path;

        $dir_handle = opendir($path) or die("Unable to open $path");

        $list_file = array();
        //running the while loop
        while (false !== ($file = readdir($dir_handle))) {
            $dir = $path . '/' . $file;
            if (is_dir($dir) && $file != '.' && $file != '..') {
                $handle = @opendir($dir) or die("undable to open file $file");
                $list_file[] = $file;
                $this->list_dir($handle, $dir);
            } elseif ($file != '.' && $file != '..') {
                $list_file[] = $file;
            }
        }

        return $list_file;
        //closing the directory
        closedir($dir_handle);
    }

    /**
     * redirect
     * @param string $data
     */
    public function redirect($data = array()) {

        $string = "location:./{$data}";
        header($string);
    }

    /**
     * 
     * @param array $string is from get from the url
     * @return array
     * 
     */
    public function breaklink($string) {
        $array = array();
        if (isset($string['route'])) {
            $link = explode("/", $string['route']);
            $i = 0;

            foreach ($link as $value) {
                switch ((int) $i) {
                    case 0 : $array['folder'] = $value;
                        break;
                    case 1 : $array['file'] = $value;
                        break;
                    case 2 : $array['function'] = $value;
                        break;
                    default : $array['link']['var'][$i] = $value;
                        break;
                }
                $i++;
            }
        }
        return $array;
    }

    function recurse_copy($src, $dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ( $file = readdir($dir))) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if (is_dir($src . '/' . $file)) {
                    recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function pagination($data = array()) {


        /* param */
        $limit = isset($data['limit']) ? $data['limit'] : 5;
        $page = isset($data['page']) ? $data['page'] : 0;
        $link = isset($data['link']) ? $data['link'] : null;
        $return_url = isset($data['return_url']) ? $data['return_url'] : null;
        $total = isset($data['total']) ? $data['total'] : 0;

        $menu = array();
        $loop = ceil($total / $limit);

        $a = ((ceil($page / $limit) - $limit) < 0 ? (ceil($page / $limit)) : 1 + ceil($page / $limit));
        $b = ((ceil($page / $limit) + $limit) > $total ? $total - 1 : (ceil($page / $limit) + $limit));

        $range = range($a, $b);


        $first = 0;
        $before = (ceil($page / $limit) - 1) < 0 ? 0 : ceil($page / $limit) - 1;
        $next = end($range) > $total ? $total : end($range);
        $last = $total - 1;

        $setEmpty = $loop;

        $menu = '<ul class="pagination">';
        $menu .= '<li><a href="' . $link . '/' . $first . '&a=' . $return_url . '"> <| </a></li>';
        $menu .= '<li><a href="' . $link . '/' . $before . '&a=' . $return_url . '"> << </a></li>';

        foreach ($range as $dados) {
            $p = $dados * $limit;
            $setEmpty = false;
            if ($p < $total)
                $menu .= '<li><a href="' . $link . '/' . $p . '&a=' . $return_url . '">' . ($dados + 1) . '</a></li>';
        }

        if (end($range) < $next)
            $menu .= '<li><a href="' . $link . '/' . $next . '&a=' . $return_url . '"> >> </a></li>';
        $menu .= '<li><a href="' . $link . '/' . $last . '&a=' . $return_url . '"> |> </a></li>';
        $menu .= '</ul>';
        return $menu;
    }

    public function cache() {
        
    }

    /**
     * setSection
     * @param array $data
     */
    public function setSection($data = array()) {

        (boolean) $boolean = false;
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;

            if (isset($_SESSION[$key]))
                $boolean = true;
        }
    }

    /**
     * unsetSession
     * @param array $data
     */
    public function unsetSession($data = array()) {
        foreach ($data as $key => $value) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * 
     * @param String $data
     * @return array
     */
    public function decodeString($data = null) {

        $a = base64_decode($data);
        $u = unserialize($a);

        return $u;
    }

    public function encondeString($data = null) {
        $a = serialize($data);
        $b = base64_encode($a);
        return $b;
    }

    public function setLevel() {
        $data = array();

        foreach ($_SESSION['level'] as $level) {

            switch ((int) $level) {
                case 0 : $data = array('id' => '#tab-3,#tab-4', 'label' => 'Accesso negado! </br/> por favor fale com Administrador do Sistema');
                    break;
                case 1 : $data = '';
                    break;
                default : $data = array('id' => '', 'label' => '');
            }
        }
        return $data;
    }

    /**
     * 
     * @param type $data vindo do banco de dados
     * @param type $parent sera o nome pai do array depois do processo
     * @param type $child e o array mind do bando de dados salvo no formulario
     * @return type array
     */
    public function ordanizadorArray($data, $parent, $child) {
        $combine = array();
        $key = array_keys($data[$child]);
        $mainArray = $data[$child];
        foreach ($key as $list) {
            if (count($mainArray[$list]) > 0) {
                foreach ($mainArray[$list] as $k => $dado) {
                    $combine[$parent][$k][$list] = $dado;
                }
            } else {
                foreach ($mainArray[$list] as $dado) {
                    $combine[$parent][][$list] = $dado;
                }
            }
        }
        return $combine;
    }

    public function formatNumber($data) {
        return number_format($data, 2, ",", ".");
    }

    public function cleanID($data) {
        return str_replace("/", "", $data);
    }

    public function checkcaptcha($post) {
        $publickey = PUBLIC_KEY_CAPTCHA;
        $privatekey = PRIVATE_KEY_CAPTCHA;

        # the response from reCAPTCHA
        $resp = null;
        # the error code from reCAPTCHA, if any
        $error = null;
        # was there a reCAPTCHA response?
        $resp = recaptcha_check_answer($privatekey
                , $_SERVER["REMOTE_ADDR"]
                , $post["recaptcha_challenge_field"]
                , $post["recaptcha_response_field"]);

        if ($resp->is_valid) {
           
        } else {
            # set the error code so that we can display it
            $error = $resp->error;
        }
        return $error;
    }

}

?>
