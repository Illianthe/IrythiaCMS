<?php
/**
 * Purpose: Point-of-entry for the authentication module.
 **/

class AuthController {
    function login() {
        global $userlevel;
        
        // Already logged in and user level is valid
        if (isset($_SESSION["user"]) && array_key_exists($_SESSION["level"], $userlevel)) {
            include(APP_PATH . "main.php");
        }
        // Process form
        else if (isset($_POST["user"], $_POST["pass"])) {
            $auth = new Auth();
            
            if ($auth->login($_POST["user"], $_POST["pass"])) {
                include(APP_PATH . "main.php");
            }
            else {
                $message = "The information provided was incorrect. Please try again.";
                include(APP_PATH . "auth" . DS . "login.php");
            }
        }
        else {
            include(APP_PATH . "auth" . DS . "login.php");
        }
    }
    
    function logout() {
        $auth = new Auth();
        $auth->logout();
        include(APP_PATH . "auth" . DS . "login.php");
    }
}