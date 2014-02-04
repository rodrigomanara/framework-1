<?php

final class mysql {
    
    public $host , $user , $pass , $dbName;
    public $con;
    
    public function __construct($host, $user, $pass, $dbName) {

        $this->host = $host;
        $this->user = $user;
        $this->password = $pass;
        $this->database = $dbName;

        $this->con = mysql_connect($this->host, $this->user, $this->password);

        if (!$this->con) {
            exit("error db dowm");
        }

        if (!mysql_select_db($this->database, $this->con)) {
            exit("error db dowm");
        }

        mysql_query("SET NAMES 'utf8'", $this->con);
        mysql_query("SET CHARACTER SET utf8", $this->con);
        mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->con);
        mysql_query("SET SQL_MODE = ''", $this->con);
    }

    /**
     * 
     * @param type $data
     * @return \stdClass|boolean
     */
    public function query($data) {

        $resource = mysql_query($data, $this->con);

        if ($resource) {
            if (is_resource($resource)) {
                $i = 0;

                $data = array();

                while ($result = mysql_fetch_assoc($resource)) {
                    $data[$i] = $result;

                    $i++;
                }

                mysql_free_result($resource);

                $query = new stdClass();
                $query->row = isset($data[0]) ? $data[0] : array();
                $query->rows = $data;
                $query->num_rows = $i;

                unset($data);

                return $query;
            } else {
                return TRUE;
            }
        } else {
            exit('Error: ' . mysql_error($this->con) . '<br />Error No: ' . mysql_errno($this->con) . '<br />' . $data);
        }
    }

    public function escape($value) {
        return mysql_real_escape_string($value, $this->con);
    }

    public function countAffected() {
        return mysql_affected_rows($this->con);
    }

    public function getLastId() {
        return mysql_insert_id($this->con);
    }

    public function __destruct() {
        mysql_close($this->con);
    }

}

?>
