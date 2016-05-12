<?php
class ControlledView {
    private $values;

    public function __construct() {
        $this->values = array();
    }

    public function set($key, $value) {
        $this->values[$key] = $value;
    }

    public function get($key) {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return null;
    }

    public function getValues() {
        return $this->values;
    }
}
?>