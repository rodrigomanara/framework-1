<?php

final class register {
    //put your code here
    
    var $register = array();
    
    public function __set($name, $value) {
        $this->register[$name] = $value; 
    }
    Public function __get($name) {
        $this->register[$name];
    }
}

?>
