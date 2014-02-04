<?php

/**
 * MYSLi_db
 *  
 * @see MySQLi_db
 * 
 */
final class MySQLi_db {

    private $mysqli;

    public function __construct($hostname, $username, $password, $database) {
        $this->mysqli = new mysqli($hostname, $username, $password, $database);

        if ($this->mysqli->connect_error) {
            trigger_error('Error: Could not make a database link (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }

        defined("MYSQL_CONN_ERROR") ? "" : define("MYSQL_CONN_ERROR", "Unable to connect to database.");

        $this->mysqli->query("SET NAMES 'utf8'");
        $this->mysqli->query("SET CHARACTER SET utf8");
        $this->mysqli->query("SET CHARACTER_SET_CONNECTION=utf8");
        $this->mysqli->query("SET SQL_MODE = ''");
    }

    public function query($sql) {

        $result = $this->mysqli->query($sql);
        if ($result) {
            try {
                $i = 0;

                $data = array();

                while ($row = $result->fetch_object()) {
                    /* convert abject into array */
                    $data[$i] = (array) $row;
                    $i++;
                }
                $result->close();

                $query = new stdClass();
                $query->row = isset($data[0]) ? $data[0] : array();
                $query->rows = $data;
                $query->num_rows = $i;

                unset($data);
                return $query;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }else{
            return false;
        }
    }

    /**
     * ExecuteUpdate
     * @see
     * @comment funcao somente para update . inset or delete
     */
    public function ExecuteUpdate($sql) {
        try {
            $this->mysqli->query($sql);
            return true;
        } catch (Exception $e) {
            return "code:" . $e->getCode() . " <br>" . $e->getMessage();
        }
    }

    public function escape($value) {
        return $this->mysqli->real_escape_string($value);
    }

    public function countAffected() {
        return $this->mysqli->affected_rows;
    }

    public function getLastId() {
        return $this->mysqli->insert_id;
    }

    public function __destruct() {
        $this->mysqli->close();
    }

}

?>