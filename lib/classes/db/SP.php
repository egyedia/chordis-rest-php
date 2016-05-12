<?php

abstract class SP {

    protected $result = null;
    protected $query = null;
    protected $args = array();
    protected $db = null;

    public function __construct() {
        
    }

    public function setDb($db) {
        $this->db = $db;
    }

    public function getClassName() {
        return get_class($this);
    }

    protected function executeQuery() {
        if ($this->query === null) {
            $this->setQuery();
        }
        //debug($this->query);
        if ($this->db !== null) {
            $this->result = mysql_query($this->query, $this->db->getLink());
        } else {
            $this->result = mysql_query($this->query);
        }
        if ($this->result === false) {
            //--exit;
            debug('Query error in ' . $this->getClassName() . ':' . mysql_error() . ':' . $this->query);
            exit;
        }
    }

    public function getAssociativeResultSet() {
        $ret = array();
        while ($row = mysql_fetch_assoc($this->result)) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function getNumericResultSet() {
        $ret = array();
        while ($row = mysql_fetch_row($this->result)) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function getQueryResult($s) {
        $this->executeQuery($s);
        return getAssociativeResultSet();
    }

    public function getRowNum() {
        return mysql_num_rows($this->result);
    }

    public function getInsertedID() {
        if ($this->db !== null) {
            return mysql_insert_id($this->db->getLink());
        } else {
            return mysql_insert_id();
        }
    }

    public function getAffectedRows() {
        if ($this->db !== null) {
            return mysql_affected_rows($this->db->getLink());
        } else {
            return mysql_affected_rows();
        }
    }

    public function setParameter($key, $value) {
        $this->args[$key] = $value;
        $this->setQuery();
        $this->interpolateParameters();
    }

    public function setParameters() {
        $this->args = func_get_args();
        if (isset($this->args[0])) {
            $this->args = $this->args[0];
        }
        $this->setQuery();
        $this->interpolateParameters();
        //debug ($this->query);
    }

    public function updateParameters() {
        $this->tmpargs = func_get_args();
        if (isset($this->tmpargs[0])) {
            foreach ($this->tmpargs[0] as $key => $value) {
                $this->args[$key] = $value;
            }
        }
        $this->setQuery();
        $this->interpolateParameters();
        //debug ($this->query);
    }

    protected function interpolateParameters() {
        foreach ($this->args as $key => $value) {
            $search = '{' . $key . '}';
            while (strpos($this->query, $search) !== false) {
                $this->query = str_replace($search, "'" . addslashes($value) . "'", $this->query);
            }
            $search = '#' . $key . '#';
            while (strpos($this->query, $search) !== false) {
                $this->query = str_replace($search, $value, $this->query);
            }
        }
    }

    protected function getAssociativeIterator() {
        return new RecordSetAssociativeIterator($this->result);
    }

    protected function getNumericIterator() {
        return new RecordSetNumericIterator($this->result);
    }

    public abstract function execute();

    public abstract function setQuery();
}
