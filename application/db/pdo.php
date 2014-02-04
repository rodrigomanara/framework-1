<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

final class PDO extends PDO {

    public function __construct($dsn, $username, $passwd, $options) {
        parent::__construct($dsn, $username, $passwd, $options);
    }

    public function query($statement) {
        parent::query($statement);
        
        $this->query($statement);
    }

    public function escape() {
        
    }

    public function getLastid() {
        $this->lastInsertId();
    }

    public function __destruct() {
        
    }

}

?>
