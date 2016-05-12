<?php

import('website.object.ReindexStatusDataPageManager');

class ReindexStatusDataPage extends ChordsPage {

    protected $RSDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->RSDPM = new ReindexStatusDataPageManager($requestContext);
        $this->registerObject($this->RSDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
