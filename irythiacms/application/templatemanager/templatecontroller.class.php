<?php
/**
 * Purpose: Controller for the template manager.
 **/

class TemplateController {
    protected $template;
    
    function __construct() {
        $this->template = new Template();
    }
    
    function add_submit() {
        if (!empty($_POST["addname"]) && !empty($_POST["addcontent"])) {
            if ($this->template->add($_POST["addname"], $_POST["addcontent"])) {
                $this->show_manager("success", "Template has been successfully added.");
            }
            else {
                $this->show_addtemplate("error", "Template name is already in use.");
            }
        }
        else {
            $this->show_addtemplate("error", "Form field(s) left uncompleted. Please try again.");
        }
    }
    
    function add() {
        $this->show_addtemplate("", "");
    }
    
    function delete() {
        if (!empty($_GET["id"])) {
            if ($this->template->delete($_GET["id"])) {
                $this->show_manager("success", "Template has been successfully deleted.");
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find template id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid template id provided.");
        }
    }
    
    // Process edit form
    function edit_submit() {
        if (!empty($_POST["id"]) && !empty($_POST["editname"]) && !empty($_POST["editcontent"])) {
            if ($this->template->edit($_POST["id"], $_POST["editname"], $_POST["editcontent"])) {
                $this->show_manager("success", "Template has been successfully modified.");
            }
            else {
                $data = $this->template->retrievedata($_POST["id"]);
                // Save view state so user doesn't have to re-enter data
                $data["content"] = $_POST["editcontent"];
                $this->show_edittemplate("error", "Template alias is already in use.", $data);
            }
        }
        else {
            $data = $this->template->retrievedata($_POST["id"]);
            // Save view state so user doesn't have to re-enter data
            $data["name"] = $_POST["editname"];
            $data["content"] = $_POST["editcontent"];
            $this->show_edittemplate("error", "Form field(s) left uncompleted. Please try again.", $data);
        }
    }
    
    function edit() {
        if (!empty($_GET["id"])) {
            if ($this->template->validateid($_GET["id"])) {
                $data = $this->template->retrievedata($_GET["id"]);
                $this->show_edittemplate("", "", $data);
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find template id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid template id provided.");
        }
    }
    
    function view() {
        $this->show_manager("", "");
    }
    
    function load() {
        if (!empty($_GET["id"])) {
            if ($this->template->validateid($_GET["id"])) {
                $this->template->load($_GET["id"]);
                $this->show_manager("success", "Template has been successfully loaded.");
            }
            else {
                $this->show_manager("error", "Unable to find template id in the database.");
            }
        }
        else {
            $this->show_manager("error", "Invalid template id provided.");
        }
    }
    
    private function show_manager($messagetype, $message) {
        // $list is a multi-dimensional array containing rows of data
        $list = $this->template->view();
        include(APP_PATH . "templatemanager" . DS . "manager.php");
    }
    
    private function show_addtemplate($messagetype, $message) {
        $data["name"] = !empty($_POST["addname"]) ? $_POST["addname"] : "";
        $data["content"] = !empty($_POST["addcontent"]) ? $_POST["addcontent"] : "";
        include(APP_PATH . "templatemanager" . DS . "addtemplate.php");
    }
    
    private function show_edittemplate($messagetype, $message, $data) {
        include(APP_PATH . "templatemanager" . DS . "edittemplate.php");
    }
}