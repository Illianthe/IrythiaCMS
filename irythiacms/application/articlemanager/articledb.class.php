<?php
/**
 * Purpose: Database interface for the article manager.
 **/

class ArticleDB extends Database {
    // Add article to database
    function add($table, $alias, $title, $content) {
        $cols = array("alias", "title", "content", "created", "lastupdated");
        $values = array($alias, $title, $content, time(), time());
        $this->insert_cols($table, $cols, $values);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    // Remove article from database
    function remove($table, $id) {
        $this->delete($table, $id);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    // Update database entries
    function edit($table, $id, $alias, $title, $content) {
        $sql = sprintf(
            "UPDATE %s SET alias='%s',title='%s',content='%s',lastupdated='%s' WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($alias),
            $this->escape($title),
            $this->escape($content),
            time(),
            $this->escape($id)
        );
        
        $this->query($sql);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    function validateid($table, $id) {
        if ($result = $this->select($table, $id)) {
            if ($result->num_rows == 1) {
                return true;
            }
        }
        
        return false;
    }
    
    function retrievedata($table, $id) {
        $result = $this->select($table, $id);
        
        if ($result->num_rows == 1) {
            return $result->fetch_array();
        }
        
        return array();
    }
    
    function listarticles($table) {
        $articlearray = array();
        
        $result = $this->select_all($table);
        while ($row = $result->fetch_array()) {
            $articlearray[] = $row;
        }
        
        return $articlearray;
    }
}