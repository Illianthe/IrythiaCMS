<?php
/**
 * Purpose: Controller for the UCP
 **/

class UCPController {
    protected $ucp;
    
    function __construct() {
        $this->ucp = new UCP();
    }
    
    // Main page
    function view() {
        $this->show_ucp("", "");
    }
    
    // Password changer page
    function change_password() {
        $this->show_passwordchanger("", "");
    }
    
    // Password changer form submit
    function change_password_submit() {
        if (!empty($_POST["currentpass"]) && !empty($_POST["newpass"]) && !empty($_POST["confirmpass"])) {
            if ($this->ucp->verify_password($_POST["currentpass"])) {
                if ($this->ucp->verify_new_password($_POST["newpass"], $_POST["confirmpass"])) {
                    $this->ucp->change_password($_POST["newpass"]);
                }
                else {
                    $this->show_passwordchanger("error", "Your new password does not match.");
                }
            }
            else {
                $this->show_passwordchanger("error", "You have incorrectly entered your current password.");
            }
        }
        else {
            $this->show_passwordchanger("error", "Form field(s) left uncompleted. Please try again.");
        }
    }
    
    private function show_ucp($messagetype, $message) {
        include("ucp.php");
    }
    
    private function show_passwordchanger($messagetype, $message) {
        include("passwordchanger.php");
    }
}