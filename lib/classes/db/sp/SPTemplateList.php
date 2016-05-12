<?php

class SPTemplateList extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getAssociativeResultSet();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
