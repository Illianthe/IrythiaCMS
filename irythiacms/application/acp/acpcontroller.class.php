<?php
/**
 * Purpose: Controller for the Admin Control Panel
 **/

class ACPController {
    protected $acp;
    
    function __construct() {
        $this->acp = new ACP();
    }
    
    // Main page
    function view() {
        $this->show_acp("", "");
    }
    
    // User manager
    function user_manager() {
        $this->show_usermanager("", "");
    }
    
    // Create user page
    function add_user() {
        $this->show_adduser("", "");
    }
    
    // Create user form submit
    function add_user_submit() {
        if (!empty($_POST["user"]) && !empty($_POST["pass"]) && !empty($_POST["level"])) {
            if ($this->acp->add_user($_POST["user"], $_POST["pass"], $_POST["level"])) {
                $this->show_usermanager("success", "User has been successfully added.");
            }
            else {
                $this->show_usermanager("error", "Username is already in use.");
            }
        }
        else {
            $this->show_adduser("error", "Form field(s) left uncompleted. Please try again.");
        }
    }
    
    // Edit user page
    function edit_user() {
        if (!empty($_GET["id"])) {
            // Validate current user
            if ($this->modify_self($_GET["id"])) {
                return;
            }
            
            if ($this->acp->validate_user($_GET["id"])) {
                $data = $this->acp->retrieve_user_data($_GET["id"]);
                $this->show_edituser("", "", $data);
            }
            else {
                // Can't find username - probably manually entered id into address bar (i.e. injection)
                $this->show_usermanager("error", "Unable to find username in the database.");
            }
        }
        else {
            // Tried to call delete method with no username specified
            $this->show_usermanager("error", "Invalid username provided.");
        }
    }
    
    // Edit user form submit
    function edit_user_submit() {
        if (!empty($_POST["id"]) && !empty($_POST["user"]) && !empty($_POST["level"])) {
            // Validate current user
            if ($this->modify_self($_POST["id"])) {
                return;
            }
            
            if ($this->acp->edit_user($_POST["id"], $_POST["user"], $_POST["level"])) {
                $this->show_usermanager("success", "User has been successfully modified.");
            }
            else {
                $data = $this->acp->retrieve_user_data($_POST["id"]);
                // Save view state so user doesn't have to re-enter data
                $data["username"] = $_POST["user"];
                $data["level"] = $_POST["level"];
                $this->show_edituser("error", "Username is already in use.", $data);
            }
        }
        else {
            $data = $this->acp->retrieve_user_data($_POST["id"]);
            // Save view state so user doesn't have to re-enter data
            $data["username"] = $_POST["user"];
            $data["level"] = $_POST["level"];;
            $this->show_editarticle("error", "Form field(s) left uncompleted. Please try again.", $data);
        }
    }
    
    // Delete user
    function delete_user() {
        if (!empty($_GET["id"])) {
            // Validate current user
            if ($this->modify_self($_GET["id"])) {
                return;
            }
            
            if ($this->acp->delete_user($_GET["id"])) {
                $this->show_usermanager("success", "User has been successfully deleted.");
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_usermanager("error", "Unable to find user in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_usermanager("error", "Invalid user provided.");
        }
    }
    
    // Password reset page
    function reset_password() {
        if (!empty($_GET["id"])) {
            // Validate current user
            if ($this->modify_self($_GET["id"])) {
                return;
            }
            
            if ($this->acp->validate_user($_GET["id"])) {
                $data = $this->acp->retrieve_user_data($_GET["id"]);
                $this->show_resetpassword("", "", $data);
            }
            else {
                // Can't find username - probably manually entered id into address bar (i.e. injection)
                $this->show_usermanager("error", "Unable to find username in the database.");
            }
        }
        else {
            $this->show_usermanager("error", "Invalid user provided.");
        }
    }
    
    // Password reset form submit
    function reset_password_submit() {
        if (!empty($_POST["id"]) && !empty($_POST["newpass"]) && !empty($_POST["confirmpass"])) {
            // Validate current user
            if ($this->modify_self($_POST["id"])) {
                return;
            }
            
            if ($this->acp->verify_new_password($_POST["newpass"], $_POST["confirmpass"])) {
                $this->acp->reset_password($_POST["id"], $_POST["newpass"]);
                
                $data = $this->acp->retrieve_user_data($_POST["id"]);
                $this->show_edituser("success", "Password has been reset.", $data);
            }
            else {
                $data = $this->acp->retrieve_user_data($_POST["id"]);
                $this->show_resetpassword("error", "Your new password does not match.", $data);
            }
        }
        else {
            $data = $this->acp->retrieve_user_data($_POST["id"]);
            $this->show_resetpassword("error", "Form field(s) left uncompleted. Please try again.", $data);
        }
    }
    
    // Check to see if user is modifying him/herself
    private function modify_self($id) {
        if ($this->acp->modify_self($id)) {
            $this->show_usermanager("error", "You can't modify yourself! The world would end!");
            return true;
        }
        else {
            return false;
        }
    }
    
    private function show_acp($messagetype, $message) {
        include("acp.php");
    }
    
    private function show_usermanager($messagetype, $message) {
        // $list is a multi-dimensional array containing rows of data
        $list = $this->acp->list_users();
        include(APP_PATH . "acp" . DS . "usermanager.php");
    }
    
    private function show_adduser($messagetype, $message) {
        include("adduser.php");
    }
    
    private function show_edituser($messagetype, $message, $data) {
        include("edituser.php");
    }
    
    private function show_resetpassword($messagetype, $message, $data) {
        include ("resetpassword.php");
    }
}