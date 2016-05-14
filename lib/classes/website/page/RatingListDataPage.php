<?php

import('website.object.RatingListDataPageManager');

class RatingListDataPage extends ChordsPage {

    protected $RLDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->RLDPM = new RatingListDataPageManager($requestContext);
        $this->registerObject($this->RLDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
