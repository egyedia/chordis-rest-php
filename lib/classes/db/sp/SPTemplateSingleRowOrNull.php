<?php

class SPTemplateSingleRowOrNull extends SPTemplate {

    function execute() {
        $this->executeQuery();
        $result = $this->getAssociativeResultSet();
        if (count($result) == 1) {
            return $result[0];
        } else {
            return null;
        }
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
