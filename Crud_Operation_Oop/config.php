<?php

class Database {
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "phpdb";

    private $mysqli;
    private $result = array();

    public function __construct() {
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function insert($table, $params = array()) {
        if ($this->tableExists($table)) {
            $table_columns = implode(', ', array_keys($params));
            $table_values = "'" . implode("', '", $params) . "'";

            $sql = "INSERT INTO $table ($table_columns) VALUES($table_values)";

            if ($this->mysqli->query($sql)) {
                $this->result = $this->mysqli->insert_id;
                return true;
            } else {
                $this->result = $this->mysqli->error;
                return false;
            }
        } else {
            $this->result = "$table does not exist in this database";
            return false;
        }
    }

    public function update($table, $params = array(), $where = null) {
        if ($this->tableExists($table)) {
            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }

            $sql = "UPDATE $table SET " . implode(', ', $args);
            if ($where !== null) {
                $sql .= " WHERE $where";
            }

            if ($this->mysqli->query($sql)) {
                $this->result = $this->mysqli->affected_rows;
                return true;
            } else {
                $this->result = $this->mysqli->error;
                return false;
            }
        } else {
            $this->result = "$table does not exist in this database";
            return false;
        }
    }


    public function getConnection() {
        return $this->mysqli;
    }

    private function tableExists($table) {
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        return $tableInDb && $tableInDb->num_rows == 1;
    }

    public function getResult() {
        return $this->result;
    }

    public function __destruct() {
        $this->mysqli->close();
    }
}

?>
