<?php
/**
 * Purpose: Backend logic for the UCP
 **/

class UCP {
    // Call verify function from authentication module
    function verify_password($pass) {
        $authdb = new AuthDB();
        
        if (isset($_SESSION["user"])) {
            return $authdb->verify("users", $_SESSION["user"], $pass);
        }
        else {
            return false;
        }
    }
    
    // Quick check to make sure the new password is what the user wanted
    function verify_new_password($newpass, $confirmpass) {
        return ($newpass == $confirmpass) ? true : false;
    }
    
    // Change password - modify database
    function change_password($pass) {
        $db = new UCPDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->change_password("users", $_SESSION["user"], $pass);
    }
}