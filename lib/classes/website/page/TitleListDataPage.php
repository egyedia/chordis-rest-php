<?php

import('website.object.TitleListDataPageManager');

class TitleListDataPage extends ChordsPage {

    protected $TLDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->TLDPM = new TitleListDataPageManager($requestContext);
        $this->registerObject($this->TLDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
