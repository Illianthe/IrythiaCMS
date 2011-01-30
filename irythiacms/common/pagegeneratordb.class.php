<?php
/**
 * Purpose: Database queries for the page generator.
 **/

class PageGeneratorDB extends Database {
    function fetch_loaded($table) {
        $sql = sprintf(
            "SELECT content FROM %s WHERE loaded='1'",
            DB_PREFIX . "_" . $this->escape($table)
        );
        
        $result = $this->query($sql);
        
        return ($result->num_rows == 1) ? $result->fetch_array() : array();
    }
    
    function fetch_article($table, $alias) {
        $sql = sprintf(
            "SELECT alias,title,content FROM %s WHERE alias='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($alias)
        );
        
        $result = $this->query($sql);
        
        return ($result->num_rows == 1) ? $result->fetch_array() : array();
    }
}