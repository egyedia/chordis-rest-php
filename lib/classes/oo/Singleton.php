<?php
class Singleton {

    protected static $instance = array();

    protected function __construct() {
    }

    public static function getInstance($classname = __CLASS__) {
        if (!isset(self::$instance[$classname])) {
            self::$instance[$classname] = new $classname;
        }
        return self::$instance[$classname];
    }

    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}

?>