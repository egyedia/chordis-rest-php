<?php
class RecordSetAssociativeIterator implements Iterator {

    private $result;
    private $row;
    private $key;

    public function __construct($result) {
        $this->result = $result;
    }

    public function current() {
        return $this->row;
    }

    public function key() {
        return $this->key;
    }

    public function next() {
        $this->row = mysql_fetch_assoc($this->result);
        if ($this->row !== false) {
            $this->key ++;
        }
    }

    public function rewind() {
        $this->row = mysql_fetch_assoc($this->result);
        $this->key = 0;
    }

    public function valid() {
        return $this->row;
    }
}
?>
