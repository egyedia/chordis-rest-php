<?php

import('website.object.ArtistListDataPageManager');

class ArtistListDataPage extends ChordsPage {

    protected $ALDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->ALDPM = new ArtistListDataPageManager($requestContext);
        $this->registerObject($this->ALDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
