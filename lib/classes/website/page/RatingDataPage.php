<?php

import('website.object.RatingDataPageManager');

class RatingDataPage extends ChordsPage {

    protected $RDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->RDPM = new RatingDataPageManager($requestContext);
        $this->registerObject($this->RDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
