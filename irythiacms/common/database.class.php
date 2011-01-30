<?php
/**
 * Purpose: MySQL database access layer
 **/

class Database extends mysqli {
    protected $db;
    
    // Connect to database using specified data
    function __construct() {
        $this->db = parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
    
    // Select all data from a table
    function select_all($table) {
        $sql = sprintf(
            "SELECT * FROM %s",
            DB_PREFIX . "_" . $this->escape($table)
        );
        return $this->query($sql);
    }
    
    // Select a row of data with a specified id
    function select($table, $id) {
        $sql = sprintf(
            "SELECT * FROM %s WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($id)
        );
        return $this->query($sql);
    }
    
    // Delete a row of data with a specified id
    function delete($table, $id) {
        $sql = sprintf(
            "DELETE FROM %s WHERE id='%s'",
            DB_PREFIX . "_" . $this->escape($table),
            $this->escape($id)
        );
        return $this->query($sql);
    }
    
    // Insert a row of data - values passed in as an array
    function insert($table, $values) {
        $valuestring = NULL;
        
        // Construct a string of values to convert to SQL form
        foreach ($values as $value) {
            $this->escape($value);
            
            if ($valuestring == NULL) {
                $valuestring = "'" . $value . "'";
            }
            else {
                $valuestring = $valuestring . ", '" . $value . "'";
            }
        }
        
        $sql = sprintf(
            "INSERT INTO %s VALUES (%s)",
            DB_PREFIX . "_" . $this->escape($table),
            $valuestring
        );
        
        return $this->query($sql);
    }
    
    // Insert data into specific columns
    function insert_cols($table, $cols, $values) {
        $columnstring = NULL;
        $valuestring = NULL;
        
        // Construct a string of columns to input to
        foreach ($cols as $col) {
            $this->escape($col);
            
            if ($columnstring == NULL) {
                $columnstring = $col;
            }
            else {
                $columnstring = $columnstring . ", " . $col;
            }
        }
        
        // Construct a string of values to convert to SQL form
        foreach ($values as $value) {
            $this->escape($value);
            
            if ($valuestring == NULL) {
                $valuestring = "'" . $value . "'";
            }
            else {
                $valuestring = $valuestring . ", '" . $value . "'";
            }
        }
        
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            DB_PREFIX . "_" . $this->escape($table),
            $columnstring,
            $valuestring
        );
        
        return $this->query($sql);
    }
    
    // Checks whether an entry with a certain id exists
    function validate_id($table, $id) {
        if ($result = $this->select($table, $id)) {
            if ($result->num_rows == 1) {
                return true;
            }
        }
        
        return false;
    }
    
    // Retrieves all data from a table and returns the array containing it
    function retrieve_all($table) {
        $array = array();
        
        $result = $this->select_all($table);
        while ($row = $result->fetch_array()) {
            $array[] = $row;
        }
        
        return $array;
    }
    
    // Retrieves data for a certain id
    function retrieve_id($table, $id) {
        $result = $this->select($table, $id);
        return ($result->num_rows == 1) ? $result->fetch_array() : array();
    }
    
    // Attempt to delete a row of data and returns whether it was successful or not
    function verified_delete($table, $id) {
        $this->delete($table, $id);
        return ($this->affected_rows == 1) ? true : false;
    }
    
    // Alias for escaping strings
    function escape($string) {
        return parent::real_escape_string($string);
    }
    
    // Check whether there was a connection error and throw an exception if there is
    function check_connect_error() {
        try {
            if ($this->connect_error) {
                throw new CMSException("Error connecting to the database", 1002);
            }
            return false;
        }
        catch (CMSException $e) {
            $e->handle_exception();
        }
        
        return true;
    }
}