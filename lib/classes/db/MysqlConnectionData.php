<?php
class MysqlConnectionData {

    private $host;
    private $port;
    private $user;
    private $password;
    private $database;

    function __construct($host, $port, $user, $password, $database) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getAttribute($key) {
        switch ($key) {
            case ATTR_NAME_DRIVER: return 'MySQLManager';
            case ATTR_NAME_HOST: return $this->host;
            case ATTR_NAME_PORT: return $this->port;
            case ATTR_NAME_USER: return $this->user;
            case ATTR_NAME_PASSWORD: return $this->password;
            case ATTR_NAME_DATABASE_NAME: return $this->database;
            case ATTR_NAME_CHARSET: return 'UTF-8';
        }
    }
}
?>