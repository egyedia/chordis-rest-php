<?php
import('website.object.ReindexDataPageManager');

class ReindexDataPage extends ChordsPage {

    protected $RDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->RDPM = new ReindexDataPageManager($requestContext);
        $this->registerObject($this->RDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}