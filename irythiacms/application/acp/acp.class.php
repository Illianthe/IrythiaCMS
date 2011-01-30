<?php
/**
 * Purpose: Backend logic for the Admin Control Panel
 **/

class ACP {
    function list_users() {
        $db = new ACPDB();
        return $db->list_users("users");
    }
    
    function retrieve_user_data($id) {
        $db = new ACPDB();
        return $db->retrieve_user_data("users", $id);
    }
    
    function validate_user($user) {
        $db = new ACPDB();
        return $db->validate_user("users", $user);
    }
    
    function add_user($user, $pass, $level) {
        $db = new ACPDB();
        return $db->add_user("users", $user, $pass, $level);
    }
    
    function edit_user($id, $user, $level) {
        $db = new ACPDB();
        return $db->edit_user("users", $id, $user, $level);
    }
    
    function delete_user($id) {
        $db = new ACPDB();
        return $db->delete_user("users", $id);
    }
    
    function reset_password($id, $pass) {
        $db = new ACPDB();
        return $db->reset_password("users", $id, $pass);
    }
    
    function verify_new_password($newpass, $confirmpass) {
        return ($newpass == $confirmpass) ? true : false;
    }
    
    // Check to see if user is trying to modify him/herself via. the ACP
    function modify_self($id) {
        $data = $this->retrieve_user_data($id);
        
        // Check to see if array keys are actually populated before comparing
        if (isset($_SESSION["user"]) && isset($data["username"]) && $_SESSION["user"] == $data["username"]) {
            return true;
        }
        else {
            return false;
        }
    }
}