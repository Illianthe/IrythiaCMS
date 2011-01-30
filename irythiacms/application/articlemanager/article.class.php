<?php
/**
 * Purpose: Backend for the article manager.
 **/

class Article {
    function add($alias, $title, $content) {
        $db = new ArticleDB();

        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->add("articles", $alias, $title, $content);
    }
    
    function delete($id) {
        $db = new ArticleDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->remove("articles", $id);
    }
    
    function edit($id, $alias, $title, $content) {
        $db = new ArticleDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->edit("articles", $id, $alias, $title, $content);
    }
    
    function view() {
        $db = new ArticleDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->listarticles("articles");
    }
    
    function validateid($id) {
        $db = new ArticleDB();
        
        if ($db->check_connect_error()) {
            return false;
        }
        
        return $db->validateid("articles", $id);
    }
    
    function retrievedata($id) {
        $db = new ArticleDB();
        
        if ($db->check_connect_error()) {
            return array();
        }
        
        return $db->retrievedata("articles", $id);
    }
}