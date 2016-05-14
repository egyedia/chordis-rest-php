<?php

class RatingDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        $jr = array();

        $sp = $this->SPF->getSP('rating_file_replace');
        $sp->setParameter('hash', getGETParameter('hash'));
        $sp->setParameter('rating', getGETParameter('rating'));
        $sp->execute();

     
        $sp = $this->SPF->getSP('content_file_get_by_hash');
        $sp->setParameter('hash', getGETParameter('hash'));
        $song = $sp->execute();

        $jr = $song;

        $this->setView('jsonResponse', $jr);
    }

}

?>
