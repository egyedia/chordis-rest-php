<?php

class SongDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        $jr = array();

        $sp = $this->SPF->getSP('content_file_get_by_id');
        $sp->setParameter('id', getGETParameter('id'));
        $song = $sp->execute();

        $jr = $song;

        $this->setView('jsonResponse', $jr);
    }

}

?>
