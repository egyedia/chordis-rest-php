<?php

class SPTemplateIterator extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getAssociativeIterator();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
