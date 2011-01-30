<?php
/**
 * Purpose: Database interface for the UCP
 **/

class UCPDB extends Database {
    function change_password($table, $user, $pass) {
        $sql = sprintf(
            "UPDATE %s SET passwd='%s' WHERE username='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            hash(DB_HASHTYPE, DB_SALT . $pass),
            $this->escape($user)
        );
        
        $this->query($sql);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
}