<?php

class start {

    public $class;

    public function __construct() {

        $_route = isset($_GET['route']) && !empty($_GET['route']) ? $_GET['route'] : null;

        if (is_null($_route)) {


            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                 
                 $class_name = "AccountHomeController";
                $function_name = "index";

                include_once __root . '/catalog/controller/account/home.php';
            } else {
                $class_name = "AccountLoginController";
                $function_name = "index";

                include_once __root . '/catalog/controller/account/login.php';
            }

            $class_exist = class_exists($class_name) ? true : false;

            if ($class_exist) {

                $this->class = new $class_name;
                if (method_exists($this->class, $function_name)) {
                    $this->class->{$function_name}();
                }
            }
        } else {
            $string_1 = stristr($_SERVER['QUERY_STRING'], 'route=account/login', true);
            $string_2 = isset($_GET['route']) ? true : false;
            $string_3 = isset($_SESSION['login']);


            if ($string_1 === false && $string_2 === true && $string_3 === false) {
                $this->error404();
            } else {

                $list = $this->returnarray($_route);

                $class_name = $list['folder'] . $list['class'] . "Controller";
                $function_name = $list['function'];
                $_path = __root . '/catalog/controller/' . $list['folder'] . '/' . $list['class'] . '.php';


                if (is_file($_path)) {

                    include_once $_path;
                    $class_exist = class_exists($class_name) ? true : false;

                    if ($class_exist) {
                        $this->class = new $class_name;
                        if (method_exists($this->class, $function_name)) {
                            $this->class->{$function_name}($list['var']);
                        } else {
                            $this->error404();
                        }
                    } else {
                        $this->error404();
                    }
                } else {
                    $this->error404();
                }
            }
        }
    }

    public static function returnarray($data) {

        $var_list = explode("/", $data);
        $array_list = array();



        $var_list[0] = isset($var_list[0]) && !empty($var_list[0]) ? $var_list[0] : "null";
        $var_list[1] = isset($var_list[1]) && !empty($var_list[1]) ? $var_list[1] : "null";
        $var_list[2] = isset($var_list[2]) && !empty($var_list[2]) ? $var_list[2] : "index";
        $var_list[3] = (count($var_list) > 3 ) ? isset($var_list[3]) && !empty($var_list[3]) ? $var_list[3] : "null"  : null;
        list($folder, $class, $function, $var) = $var_list;

        $array = Array();
        $array['class'] = $class;
        $array['folder'] = $folder;
        $array['function'] = $function;
        $array['var'] = $var;

        return $array;
    }

    public static function error404() {


        $class_name = "CommonErrorController";
        $function_name = "index";

        include_once __root . '/catalog/controller/common/error.php';

        $class_exist = class_exists($class_name) ? true : false;

        if ($class_exist) {
            $class = new $class_name;
            if (method_exists($class, $function_name)) {
                $class->{$function_name}();
            }
        }
    }

}

?>
