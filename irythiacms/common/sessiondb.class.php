<?php
/**
 * Purpose: Database interface for the session handler
 **/

class SessionDB extends Database {
    function session_write($table, $id, $lastaccess, $data) {
        $sql = sprintf(
            "REPLACE INTO %s SET id='%s', lastaccess='%s', data='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($id),
            $this->escape($lastaccess),
            $this->escape($data)
        );
        return $this->query($sql);
    }
    
    function session_gc($table, $timeout) {
        $sql = sprintf(
            "DELETE FROM %s WHERE lastaccess<'%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($timeout)
        );
        return $this->query($sql);
    }
}