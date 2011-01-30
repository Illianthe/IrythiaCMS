<?php
/**
 * Purpose: Database interface for the template manager.
 **/

class TemplateDB extends Database {
    // Add template to database
    function add($table, $name, $content) {
        $cols = array("name", "content", "created", "lastupdated");
        $values = array($name, $content, time(), time());
        $this->insert_cols($table, $cols, $values);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    // Remove template from database
    function remove($table, $id) {
        $this->delete($table, $id);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    // Update database entries
    function edit($table, $id, $name, $content) {
        $sql = sprintf(
            "UPDATE %s SET name='%s',content='%s',lastupdated='%s' WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($name),
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
    
    // Load template
    function load($table, $id) {
        $sql = sprintf(
            "UPDATE %s SET loaded='%s' WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            "1",
            $this->escape($id)
        );
        
        $this->query($sql);
        
        if ($this->affected_rows == 1) {
            return true;
        }
        
        return false;
    }
    
    // Unload currently loaded template
    function unload($table, $id) {
        $sql = sprintf(
            "UPDATE %s SET loaded='%s' WHERE loaded='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            "0",
            "1"
        );
        
        return $this->query($sql);
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
    
    function listtemplates($table) {
        $templatearray = array();
        
        $result = $this->select_all($table);
        while ($row = $result->fetch_array()) {
            $templatearray[] = $row;
        }
        
        return $templatearray;
    }
}