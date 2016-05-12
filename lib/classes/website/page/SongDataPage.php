<?php

import('website.object.SongDataPageManager');

class SongDataPage extends ChordsPage {

    protected $SDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->SDPM = new SongDataPageManager($requestContext);
        $this->registerObject($this->SDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
