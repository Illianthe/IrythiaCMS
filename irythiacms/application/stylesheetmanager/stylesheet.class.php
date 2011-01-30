<?php
/**
 * Purpose: Backend for the stylesheet manager.
 **/

class Stylesheet {
    function add($name, $content) {
        $db = new StylesheetDB();

        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->add("stylesheets", $name, $content);
    }
    
    function delete($id) {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->remove("stylesheets", $id);
    }
    
    function edit($id, $name, $content) {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->edit("stylesheets", $id, $name, $content);
    }
    
    function view() {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->liststylesheets("stylesheets");
    }
    
    function load($id) {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        // Unload the previously loaded stylesheet and replace with the new one
        if ($db->unload("stylesheets", $id) && $db->load("stylesheets", $id)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    function validateid($id) {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->validateid("stylesheets", $id);
    }
    
    function retrievedata($id) {
        $db = new StylesheetDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->retrievedata("stylesheets", $id);
    }
}