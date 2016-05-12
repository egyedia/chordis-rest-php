<?php

class SPTemplateInsertSelect extends SPTemplate {

    function execute() {
        $this->executeQuery();
        return $this->getAffectedRows();
    }

    function setQuery() {
        $this->query = $this->injectedQuery;
    }
}
?>
