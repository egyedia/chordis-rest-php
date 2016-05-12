<?php

class IndexPage extends ChordsPage {

    function __construct($requestContext) {
        parent::__construct($requestContext);
    }


    function getTemplateName() {
        return 'ajax';
    }

    function renderContent() {
        $r = array(
            "description" => 'Chordy Song Book REST endpoint'
        );
        print json_encode($r);
    }

}
