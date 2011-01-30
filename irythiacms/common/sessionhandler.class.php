<?php
/**
 * Purpose: Allows for the storage of session variables in the database.
 * The session table has 3 fields: session id, session data and last access time.
 **/

class SessionHandler {
    // Database connection
    protected $db;
    
    // Takes a database connection as an argument and calls session_set_save_handler()
    function __construct() {
        // Setting secure session cookies
        session_set_cookie_params(0, '/', '', true, true);
        
        session_set_save_handler(
            array($this, "open"),
            array($this, "close"),
            array($this, "read"),
            array($this, "write"),
            array($this, "destroy"),
            array($this, "gc")
        );
    }
    
    // Open connection to database
    function open($savepath, $sessionname) {
        $this->db = new SessionDB;
        
        if ($this->db->connect_error) {
            return false;
        }
        
        return true;
    }
    
    // Close connection to database
    function close() {
        $this->gc(get_cfg_var("session.gc_maxlifetime"));
        return @$this->db->close();
    }
    
    // Reads session data
    function read($id) {
        $result = $this->db->select("sessions", $id);
        $row = $result->fetch_array();
        
        if ($row == NULL) {
            return "";
        }
        
        return $row["data"];
    }
    
    // Writes session data
    function write($id, $data) {
        $this->db->session_write("sessions", $id, time(), $data);
        
        if ($this->db->affected_rows != 1) {
            return false;
        }
        
        return true;
    }
    
    // Deletes session data
    function destroy($id) {
        $this->db->delete("sessions", $id);
        
        if ($this->db->affected_rows != 1) {
            return false;
        }
        
        return true;
    }
    
    // Garbage collection
    function gc($maxlifetime) {
        // Determine timeout and delete entries older than it
        $timeout = time() - $maxlifetime;
        
        // Delete entry from database
        $this->db->session_gc("sessions", $timeout);
        
        return $this->db->affected_rows;
    }
}