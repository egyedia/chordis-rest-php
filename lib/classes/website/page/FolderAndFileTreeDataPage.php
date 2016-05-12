<?php

import('website.object.FolderAndFileTreeDataPageManager');

class FolderAndFileTreeDataPage extends ChordsPage {

    protected $FAFTDPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->FAFTDPM = new FolderAndFileTreeDataPageManager($requestContext);
        $this->registerObject($this->FAFTDPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}

?>
