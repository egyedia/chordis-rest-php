<?php

class SPTemplateInsert extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getInsertedID();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
