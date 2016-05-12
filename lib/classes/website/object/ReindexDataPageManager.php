<?php

class ReindexDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        global $options;

        $jr = array();

        $sh = new SearchHandler($this->SPF, $options);
        $sh->updateSearchIndex();
        
        $jr['updated'] = true;

        $this->setView('jsonResponse', $jr);
    }

}