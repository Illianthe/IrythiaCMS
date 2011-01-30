<?php
/**
 * Purpose: Controls the article manager.
 **/

class ArticleController {
    protected $art;
    
    function __construct() {
        $this->art = new Article();
    }
    
    // Process add form
    function add_submit() {
        if (!empty($_POST["addalias"]) && !empty($_POST["addtitle"]) && !empty($_POST["addcontent"])) {
            if ($this->art->add($_POST["addalias"], $_POST["addtitle"], $_POST["addcontent"])) {
                $this->show_manager("success", "Article has been successfully added.");
            }
            else {
                $this->show_addarticle("error", "Article alias is already in use.");
            }
        }
        else {
            $this->show_addarticle("error", "Form field(s) left uncompleted. Please try again.");
        }
    }
    
    function add() {
        $this->show_addarticle("", "");
    }
    
    function delete() {
        if (!empty($_GET["id"])) {
            if ($this->art->delete($_GET["id"])) {
                $this->show_manager("success", "Article has been successfully deleted.");
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find article id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid article id provided.");
        }
    }
    
    // Process edit form
    function edit_submit() {
        if (!empty($_POST["id"]) && !empty($_POST["editalias"]) && !empty($_POST["edittitle"]) && !empty($_POST["editcontent"])) {
            if ($this->art->edit($_POST["id"], $_POST["editalias"], $_POST["edittitle"], $_POST["editcontent"])) {
                $this->show_manager("success", "Article has been successfully modified.");
            }
            else {
                $data = $this->art->retrievedata($_POST["id"]);
                // Save view state so user doesn't have to re-enter data
                $data["title"] = $_POST["edittitle"];
                $data["content"] = $_POST["editcontent"];
                $this->show_editarticle("error", "Article alias is already in use.", $data);
            }
        }
        else {
            $data = $this->art->retrievedata($_POST["id"]);
            // Save view state so user doesn't have to re-enter data
            $data["alias"] = $_POST["editalias"];
            $data["title"] = $_POST["edittitle"];
            $data["content"] = $_POST["editcontent"];
            $this->show_editarticle("error", "Form field(s) left uncompleted. Please try again.", $data);
        }
    }
    
    function edit() {
        if (!empty($_GET["id"])) {
            if ($this->art->validateid($_GET["id"])) {
                $data = $this->art->retrievedata($_GET["id"]);
                $this->show_editarticle("", "", $data);
            }
            else {
                // Can't find id - probably manually entered id into address bar (i.e. injection)
                $this->show_manager("error", "Unable to find article id in the database.");
            }
        }
        else {
            // Tried to call delete method with no id specified
            $this->show_manager("error", "Invalid article id provided.");
        }
    }
    
    function view() {
        $this->show_manager("", "");
    }
    
    private function show_manager($messagetype, $message) {
        // $list is a multi-dimensional array containing rows of data
        $list = $this->art->view();
        include(APP_PATH . "articlemanager" . DS . "manager.php");
    }
    
    private function show_addarticle($messagetype, $message) {
        $data["alias"] = !empty($_POST["addalias"]) ? $_POST["addalias"] : "";
        $data["title"] = !empty($_POST["addtitle"]) ? $_POST["addtitle"] : "";
        $data["content"] = !empty($_POST["addcontent"]) ? $_POST["addcontent"] : "";
        include(APP_PATH . "articlemanager" . DS . "addarticle.php");
    }
    
    private function show_editarticle($messagetype, $message, $data) {
        include(APP_PATH . "articlemanager" . DS . "editarticle.php");
    }
}