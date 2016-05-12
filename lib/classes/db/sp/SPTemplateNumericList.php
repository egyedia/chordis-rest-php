<?php

class SPTemplateNumericList extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getNumericResultSet();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
