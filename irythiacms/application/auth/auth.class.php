<?php
/**
 * Purpose: Backend for authentication module.
 **/

class Auth {
    // Compare info provided with entry in database and initialize
    function login($user, $pass) {
        $db = new AuthDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        if ($db->verify("users", $user, $pass)) {
            $_SESSION["user"] = $user;
            $_SESSION["level"] = $this->get_level($user);
            return true;
        }
        
        // Can't verify input
        return false;
    }
    
    // Destroy session and session data
    function logout() {
        unset($_SESSION["user"]);
        unset($_SESSION["level"]);
        session_destroy();
    }
    
    // Retrieve user level
    function get_level($user) {
        global $userlevel;
        
        $db = new AuthDB();
        
        if ($db->check_connect_error()) {
            return 0;
        }
        
        return $db->get_level("users", $user);
    }
}