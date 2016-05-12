<?php

class ArtistListDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        $jr = array();

        $sp = $this->SPF->getSP('content_file_list_distinct_artists');
        $artistList = $sp->execute();

        foreach ($artistList as $artist) {
            $r = array(
                'artist' => $artist['artist'],
                'count' => $artist['cnt']
            );
            $jr[] = $r;
        }

        $this->setView('jsonResponse', $jr);
    }

}

?>
