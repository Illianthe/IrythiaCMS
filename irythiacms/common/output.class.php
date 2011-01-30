<?php
/**
 * Purpose: "Glues" page together and output to browser.
 **/

class Output {
    protected $module;
    protected $action;
    protected $param;
    
    function __construct($module, $action, $param = array()) {
        $this->module = $module;
        $this->action = $action;
        $this->param = $param;
    }
    
    function render() {
        global $modules;
        global $userlevel;
        
        // Initialize
        new SessionHandler();
        session_start();
        
        // If user is not logged in, change to guest level of 0
        if (!isset($_SESSION["user"])) {
            $_SESSION["level"] = 0;
        }
        
        // If user session variable is not set, force redirection to login page
        if (!isset($_SESSION["user"])) {
            $this->module = "auth";
            $this->action = "login";
            $this->param = array();
        }
        
        // Include header file
        $header = THEME_PATH . "header.php";
        include($header);
        
        // Include main content
        try {
            // Validate $module against $modules
            if (array_key_exists($this->module, $modules)) {
                $controller = new $modules[$this->module];
                
                // Check if method exists in object
                if (method_exists($controller, $this->action)) {
                    // Check to see if user has permission to access the page first
                    if ($this->check_permissions($modules[$this->module], $this->action)) {
                        // Using buffer to output contents after navigation - usability reasons
                        ob_start();
                        // Execute action - params in order by how they were entered in url
                        call_user_func_array(array($controller, $this->action), $this->param);
                        $content = ob_get_clean();
                    }
                    else {
                        echo "Sorry, you don't have permission to access this area.";
                    }
                    
                    // Include header/navigation if user is logged in
                    if (isset($_SESSION["user"])) {
                        include(APP_PATH . "header.php");
                        include(APP_PATH . "navigation.php");
                    }
                    
                    // Output contents
                    echo $content;
                }
                else {
                    throw new CMSException("Module method could not be loaded.", 1001);
                }
            }
            else {
                throw new CMSException("Module class could not be loaded.", 1001);
            }
        }
        catch (CMSException $e) {
            $e->handle_exception();
        }
        
        // Include footer file
        $footer = THEME_PATH . "footer.php";
        include($footer);
    }
    
    // Takes a controller and action name as input and checks if user has permission to access it
    function check_permissions($controller, $action) {
        global $userlevel;
        global $permissions;
        
        // Permission id for all actions in that category (i.e. controller)
        $allactionid = $permissions[$controller]["All"];
        // Permission id for action being accessed
        $actionid = (array_key_exists($action, $permissions[$controller]) ?
            $permissions[$controller][$action] :
            $permissions[$controller]["All"]
        );
        
        foreach ($userlevel[$_SESSION["level"]] as $id) {
            if ($id == $allactionid || $id == $actionid) {
                return true;
            }
        }
        
        return false;
    }
}