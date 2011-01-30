<?php
/**
 * Purpose: Database queries for the authentication module.
 **/

class AuthDB extends Database {
    // Verifies whether user is in database entry.
    function verify($table, $user, $pass) {
        $sql = sprintf(
            "SELECT * FROM %s WHERE username='%s' and passwd='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($user),
            hash(DB_HASHTYPE, DB_SALT . $pass)
        );
        
        if ($result = $this->query($sql)) {
            if ($result->num_rows == 1) {
                return true;
            }
        }
        
        return false;
    }
    
    function get_level($table, $user) {
        $sql = sprintf(
            "SELECT * FROM %s WHERE username='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($user)
        );
        
        $result = $this->query($sql);
        $row = $result->fetch_array();
        return $row["level"];
    }
}