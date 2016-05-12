<?php
abstract class AbstractSongRowList {

    protected $rows;
    protected $keyRows;

    public function  __construct() {
        $this->rows = array();
        $this->keyRows = array();
    }

    public function addRow($r) {
        $this->rows[] = $r;
        $key = $r->getKey();
        $this->keyRows[$key] = $r;
    }

    protected function getKeyedRow($key) {
        if (isset($this->keyRows[$key])) {
            return $this->keyRows[$key];
        }
        return null;
    }

    protected function removeRow($row) {
        $foundAt = null;
        foreach($this->rows as $id => $r) {
            if ($r === $row) {
                $foundAt = $id;
            }
        }
        if ($foundAt !== null) {
            unset($this->rows[$foundAt]);
        }
        unset($this->keyRows[$row->getKey()]);
    }


    public function getRows() {
        return $this->rows;
    }

}