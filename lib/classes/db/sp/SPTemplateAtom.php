<?php

class SPTemplateAtom extends SPTemplate {

    function execute() {
        $this->executeQuery();
        $result = $this->getNumericResultSet();
        return $result[0][0];
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>