<?php
/**
 * Purpose: Controller for the stylesheet manager.
 **/

class StylesheetController {
    protected $stylesheet;
    
    function __construct() {
        $this->stylesheet = new Stylesheet();
    }
    
    function add_submit() {
        if (!empty($_POST["addname"]) && !empty($_POST["addcontent"])) {
            if ($this->stylesheet->add($_POST["addname"], $_POST["addcontent"])) {
                $this->show_manager("success", "Stylesheet has been successfully added.");
            }
            else {
                $this->show_addstylesheet("error", "Stylesheet name is already in use.");
            }
        }
        else {
            $this->show_addstylesheet("error", "Form field(s) left uncompleted. Please try again.");
        }
    }
    
    function add() {
        $this->show_addstylesheet("", "");
    }
    
    function delete() {
        if (!empty($_GET["id"])) {
            if ($this->stylesheet->delete($_GET["id"])) {
                $this->show_manager("success", "Stylesheet has been successfully deleted.");
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find stylesheet id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid stylesheet id provided.");
        }
    }
    
    // Process edit form
    function edit_submit() {
        if (!empty($_POST["id"]) && !empty($_POST["editname"]) && !empty($_POST["editcontent"])) {
            if ($this->stylesheet->edit($_POST["id"], $_POST["editname"], $_POST["editcontent"])) {
                $this->show_manager("success", "Stylesheet has been successfully modified.");
            }
            else {
                $data = $this->stylesheet->retrievedata($_POST["id"]);
                // Save view state so user doesn't have to re-enter data
                $data["content"] = $_POST["editcontent"];
                $this->show_editstylesheet("error", "Stylesheet alias is already in use.", $data);
            }
        }
        else {
            $data = $this->stylesheet->retrievedata($_POST["id"]);
            // Save view state so user doesn't have to re-enter data
            $data["name"] = $_POST["editname"];
            $data["content"] = $_POST["editcontent"];
            $this->show_editstylesheet("error", "Form field(s) left uncompleted. Please try again.", $data);
        }
    }
    
    function edit() {
        if (!empty($_GET["id"])) {
            if ($this->stylesheet->validateid($_GET["id"])) {
                $data = $this->stylesheet->retrievedata($_GET["id"]);
                $this->show_editstylesheet("", "", $data);
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find stylesheet id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid stylesheet id provided.");
        }
    }
    
    function view() {
        $this->show_manager("", "");
    }
    
    function load() {
        if (!empty($_GET["id"])) {
            if ($this->stylesheet->validateid($_GET["id"])) {
                $this->stylesheet->load($_GET["id"]);
                $this->show_manager("success", "Stylesheet has been successfully loaded.");
            }
            else {
                $this->show_manager("error", "Unable to find stylesheet id in the database.");
            }
        }
        else {
            $this->show_manager("error", "Invalid stylesheet id provided.");
        }
    }
    
    private function show_manager($messagetype, $message) {
        // $list is a multi-dimensional array containing rows of data
        $list = $this->stylesheet->view();
        include(APP_PATH . "stylesheetmanager" . DS . "manager.php");
    }
    
    private function show_addstylesheet($messagetype, $message) {
        $data["name"] = !empty($_POST["addname"]) ? $_POST["addname"] : "";
        $data["content"] = !empty($_POST["addcontent"]) ? $_POST["addcontent"] : "";
        include(APP_PATH . "stylesheetmanager" . DS . "addstylesheet.php");
    }
    
    private function show_editstylesheet($messagetype, $message, $data) {
        include(APP_PATH . "stylesheetmanager" . DS . "editstylesheet.php");
    }
}