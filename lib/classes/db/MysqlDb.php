<?php

class MysqlDb {

    private $link = null;

    function __construct(MysqlConnectionData $connectionData) {
        $host = $connectionData->getHost();
        $database = $connectionData->getDatabase();
        $user = $connectionData->getUser();
        $password = $connectionData->getPassword();
        $port = $connectionData->getPort();

        $this->link = mysqli_connect($host, $user, $password, $database, $port);
        if (!$this->link) {
            //debug('DB error: '.mysqli_error());
            exit();
        }
    }

    public function getLink() {
        return $this->link;
    }

}

?>