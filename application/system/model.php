<?php

/**
 * Model
 * @see Model
 * @abstract
 */
abstract class Model {
    /**
     *
     * @var object
     */
     var $db;

    public function __construct() {

        $this->db = new MySQLi_db(localhost, user, pass, db_name);
        return $this->db;
    }

}

?>
