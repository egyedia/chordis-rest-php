<?php

import('website.object.SongsByArtistDataPageManager');

class SongsByArtistDataPage extends ChordsPage {

    protected $SBADPM;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->SBADPM = new SongsByArtistDataPageManager($requestContext);
        $this->registerObject($this->SBADPM);
    }

    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        print json_encode($this->getView('jsonResponse'));
    }

}
