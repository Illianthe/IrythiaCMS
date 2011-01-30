<?php
/**
 * Purpose: Takes input from a form and parses it, then creates
 *          an email to be sent to a target.
 **/
 
 class Mailer {
    protected $to;            // Recipient's email
    protected $subject;       // Subject line
    protected $message;       // Body content
    protected $headers;       // Additional headers (e.g. from:, cc:, bcc:)
    protected $parameters;    // Extra parameters used by the mail() function
    
    function __construct() {
        $this->to = DEFAULT_EMAIL;
    }
    
    function set_recipient($to) {
        $this->to = $to;
    }
    
    function set_subject($subject) {
        $this->subject = $subject;
    }
    
    function set_message($message) {
        $this->message = $message;
    }
    
    function set_headers($headers) {
        $this->headers = $headers;
    }
    
    function set_parameters($parameters) {
        $this->parameters = $parameters;
    }
    
    // Appends a header to the current list
    function append_header($header) {
        if (!empty($this->headers)) {
            $this->headers .= PHP_EOL;
        }
        $this->headers .= $header;
    }
    
    // Takes a string (presumably containing an email address) and validates it.
    // Returns the email address if it's valid and false otherwise.
    function validate_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    // Set headers for sender (e.g. "From:", "Reply-To;", etc.)
    function set_sender($email) {
        if ($this->validate_email($email)) {
            $header = "From: " . $email;
            $this->append_header($header);
            
            $header = "Reply-To: " . $email;
            $this->append_header($header);
            
            return true;
        }
        return false;
    }
    
    // Generate an email and send it.
    // Returns true if email was sent successfully and false otherwise.
    function send() {
        return mail($this->to, $this->subject, $this->message, $this->headers, $this->parameters);
    }
 }