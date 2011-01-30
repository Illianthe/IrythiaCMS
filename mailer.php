<?php
/**
 * Purpose: Form submission page. Takes input from a contact form and parses it.
 **/

// These are needed to access methods, etc. in the CMS
define("CMS_DIR", "irythiacms");
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__FILE__) . DS . CMS_DIR);
require_once(CMS_DIR . DS . "common" . DS . "bootstrap.php");

// List of possible errors to output (used by a JS script to modify view)
class ErrorList {
    const EmptyField = 0;
    const LengthExceeded = 1;
}

// Maximum field lengths
class MaxLength {
    const Name = 50;
    const Email = 50;
    const Message = 1000;
}

$mailer = new Mailer();
$result = array();

// Required name field
if (empty($_POST["name"])) {
    $result["name"] = false;
    $result["name_err"] = ErrorList::EmptyField; 
}
else if (strlen($_POST["name"]) > MaxLength::Name) {
    $result["name"] = false;
    $result["name_err"] = ErrorList::LengthExceeded;
}
else {
    $result["name"] = true;
    $subject = "Form submission by " . $_POST["name"];
    $mailer->set_subject($subject);
}

// Required message
if (empty($_POST["message"])) {
    $result["message"] = false;
    $result["message_err"] = ErrorList::EmptyField;
}
else if (strlen($_POST["message"]) > MaxLength::Message) {
    $result["message"] = false;
    $result["message_err"] = ErrorList::LengthExceeded;
}
else {
    $result["message"] = true;
    $mailer->set_message($_POST["message"]);
}

// Required email address
if (empty($_POST["email"])) {
    $result["email"] = false;
    $result["email_err"] = ErrorList::EmptyField;
}
else if (strlen($_POST["email"]) > MaxLength::Email) {
    $result["email"] = false;
    $result["email_err"] = ErrorList::LengthExceeded;
}
else {
    $result["email"] = $mailer->set_sender($_POST["email"]);
}

// Form fields are filled correctly
if ($result["name"] && $result["message"] && $result["email"]) {
    $result["submit"] = $mailer->send();
}

// Turn the array into a JSON representation and output to browser.
// This allows JS to read the results and act upon it.
echo json_encode($result);