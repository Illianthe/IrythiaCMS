<?php
/**
 * Purpose: Error handling for the CMS.
 **/

class CMSException extends Exception {
    // Error codes:
    // 1000 - Can't load class
    // 1001 - Page could not be rendered
    // 1002 - Database connection error
    
    // Log errors to file (production only) - use for occasional, critical errors
    function log_error() {
        if (DEBUG_MODE == true) {
            echo $this->message;
        }
        else {
            error_log($this->message);
        }
    }
    
    // Output errors to browser only (primarily used for trivial things such as
    // user includes, etc. that could fill up the error log)
    function print_error() {
        echo $this->message;
    }
    
    function handle_exception() {
        switch ($this->code) {
            case 1000:
                $this->log_error();
                break;
            case 1001:
                $this->print_error();
                break;
            case 1002;
                $this->log_error();
                break;
            default:
                $this->log_error();
        }
    }
}