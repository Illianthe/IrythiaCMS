<?php
/**
 * Purpose: Common functionality in the application.
 **/

// Set error reporting depending on production/development setting
function set_reporting() {
    if (DEBUG_MODE == true) {
        error_reporting(E_ALL);
        ini_set("display_errors", "On");
    }
    else {
        error_reporting(E_ALL);
        ini_set("display_errors", "Off");
        ini_set("log_errors", "On");
        ini_set("error_log", ROOT . DS . "tmp" . DS . "logs" . DS . "errors.log");
    }
}

function __autoload($class_name) {
    global $modules;
    
    // Path to each module
    foreach ($modules as $module => $controller) {
        $directories[] = ROOT . DS . "application" . DS . $module . DS;
    }
    
    // Append standard class directories
    $directories[] = ROOT . DS . "common" . DS;
    $directories[] = ROOT . DS . "library" . DS;
    $directories[] = ROOT . DS . "plugins" . DS;
    
    // For each directory in the array, search for class
    foreach ($directories as $directory) {
        $path = $directory . strtolower($class_name) . ".class.php";
        if (file_exists($path)) {
            require_once($path);
        }
    }
}

set_reporting();