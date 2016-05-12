<?php

class MysqlDb {

    private $link = null;

    function __construct(MysqlConnectionData $connectionData) {
        $host = $connectionData->getHost();
        $database = $connectionData->getDatabase();
        $user = $connectionData->getUser();
        $password = $connectionData->getPassword();
        $port = $connectionData->getPort();

        $this->link = mysql_connect("$host:$port", $user, $password, true);
        if (!$this->link) {
            //debug('DB error: '.mysql_error());
            exit();
        } else {
            $dbSel = mysql_select_db($database);
            if (!$dbSel) {
                //debug('DB error: '.mysql_error());
                exit();
            }
        }
    }

    public function getLink() {
        return $this->link;
    }

}

?>