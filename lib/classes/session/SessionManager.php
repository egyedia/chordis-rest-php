<?php

define('SESSION_DATA_STORE', 'session_data_store');

class SessionManager extends Singleton {

    var $propertyList;

    /**
     * @return SessionManager
     */
    public static function getInstance($class = __CLASS__) {
        return parent::getInstance($class);
    }

    function beginSession() {
        // if started twice, notice is sent
        @session_start();
        if (isset($_SESSION[SESSION_DATA_STORE])) {
            $this->propertyList = $_SESSION[SESSION_DATA_STORE];
        } else {
            $this->propertyList = array();
        }
    }

    function flushSession() {
        $_SESSION[SESSION_DATA_STORE] = $this->propertyList;
    }

    function setProperty($key, $value) {
        $this->propertyList[$key]=$value;
        $this->flushSession();
    }

    function removeProperty($key) {
        unset($this->propertyList[$key]);
        $this->flushSession();
    }

    function getProperty($key,$default = null) {
        if (isset($this->propertyList[$key])) {
            return $this->propertyList[$key];
        } else {
            return $default;
        }
    }
}

?>