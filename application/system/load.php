<?php

final class load {

    /**
     * 
     * @param string $file_name
     * @param array $data
     * @return string
     */
    public function view($file_name, $data = null) {

        $root = __root . '/catalog/view/default/';
        if (is_array($data)) {
            extract($data);
        }

        $list = $this->returnarray($file_name);


        ob_start();
        require_once $root . $list['folder'] . '/' . $list['class'] . '.tpl';
        $return = ob_get_contents();
        ob_clean();
        return $return;
    }

    /**
     * 
     * @param array $data
     * @return Model
     * @example 
     * @see model
     * @comment : folder_file
     * @example catalog/example/function_model.html description
     */    
    public function model($data) {

        $root = '/catalog/model/';
        $_list = $this->returnarray($data);
        $Controller = $this->returclass($root, $_list['folder'], $_list['class'], $_list['function'], "model");

        return $Controller;
    }

    /**
     * @param array $data
     * @return class
     */
    public function controller($data) {

        $root = '/catalog/controller/';
        $_list = $this->returnarray($data);
        $Controller = $this->returclass($root, $_list['folder'], $_list['class'], $_list['function'], "controller");

        return $Controller;
    }

    public static function returnarray($data) {

        $var_list = explode("_", $data);
        $array_list = array();

        $var_list[0] = isset($var_list[0]) && !empty($var_list[0]) ? $var_list[0] : "null";
        $var_list[1] = isset($var_list[1]) && !empty($var_list[1]) ? $var_list[1] : "null";
        $var_list[2] = isset($var_list[2]) && !empty($var_list[2]) ? $var_list[2] : "index";

        list($folder, $class, $function) = $var_list;

        $array = Array();
        $array['class'] = $class;
        $array['folder'] = $folder;
        $array['function'] = $function;

        return $array;
    }

    public static function returclass($root, $folder, $class_name, $function_name, $type) {

        $_path = __root . $root . $folder . '/' . $class_name . '.php';

        if (is_file($_path)) {

            require_once $_path;

            $class_name = ucfirst($folder) . ucfirst($class_name) . ucfirst($type);
            $class_exist = class_exists(ucfirst($class_name)) ? true : false;

            if ($class_exist) {

                $class = new $class_name;
                if (method_exists($class, $function_name)) {
                    return $class->{$function_name}();
                } else {
                    return $class;
                }
            }
        }
    }

    /**
     * display
     * @param type echo
     * @comments : display variaveis
     */
    static public function display($data) {
        echo trim($data);
    }

}

?>
