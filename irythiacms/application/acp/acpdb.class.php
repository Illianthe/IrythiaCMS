<?php
/**
 * Purpose: Database logic for the Admin Control Panel
 **/

class ACPDB extends Database {
    function __construct() {
        parent::__construct();
        
        if ($this->check_connect_error()) {
            return false;
        }
    }
    
    function list_users($table) {
        $user_array = array();
        
        $result = $this->select_all($table);
        while ($row = $result->fetch_array()) {
            $user_array[] = $row;
        }
        
        return $user_array;
    }
    
    function retrieve_user_data($table, $id) {
        $result = $this->select($table, $id);
        
        if ($result->num_rows == 1) {
            return $result->fetch_array();
        }
        
        return array();
    }
    
    function validate_user($table, $id) {
        if ($result = $this->select($table, $id)) {
            if ($result->num_rows == 1) {
                return true;
            }
        }
        
        return false;
    }
    
    function add_user($table, $user, $pass, $level) {
        $encryptedpass = hash(DB_HASHTYPE, DB_SALT . $pass);
        
        $cols = array("username", "passwd", "level");
        $values = array($user, $encryptedpass, $level);
        $this->insert_cols($table, $cols, $values);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    function edit_user($table, $id, $user, $level) {
        $sql = sprintf(
            "UPDATE %s SET username='%s',level='%s' WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($user),
            $this->escape($level),
            $this->escape($id)
        );
        
        $this->query($sql);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    function delete_user($table, $id) {
        $this->delete($table, $id);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    function reset_password($table, $id, $pass) {
        $sql = sprintf(
            "UPDATE %s SET passwd='%s' WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            hash(DB_HASHTYPE, DB_SALT . $pass),
            $this->escape($id)
        );
        
        $this->query($sql);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
}