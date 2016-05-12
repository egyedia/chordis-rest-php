<?php

class ReindexStatusDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        global $options;
        
        $jr = $options->getOption('indexing.status');

        $this->setView('jsonResponse', $jr);
    }

}