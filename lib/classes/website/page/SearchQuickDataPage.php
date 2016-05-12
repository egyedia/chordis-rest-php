<?php

import('website.object.SearchQuickDataPageManager');

class SearchQuickDataPage extends ChordsPage {

    protected $SQDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->SQDPM = new SearchQuickDataPageManager($requestContext);
        $this->registerObject($this->SQDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}

?>
