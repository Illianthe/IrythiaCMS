<?php
/**
 * Purpose: Backend for the template manager.
 **/

class Template {
    function add($name, $content) {
        $db = new TemplateDB();

        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->add("templates", $name, $content);
    }
    
    function delete($id) {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->remove("templates", $id);
    }
    
    function edit($id, $name, $content) {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->edit("templates", $id, $name, $content);
    }
    
    function view() {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->listtemplates("templates");
    }
    
    function load($id) {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        // Unload the previously loaded stylesheet and replace with the new one
        if ($db->unload("templates", $id) && $db->load("templates", $id)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function validateid($id) {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->validateid("templates", $id);
    }
    
    function retrievedata($id) {
        $db = new TemplateDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->retrievedata("templates", $id);
    }
}