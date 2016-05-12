<?php

class SPTemplateNumericIterator extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getNumericIterator();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
