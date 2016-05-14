<?php

class RatingListDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        $jr = array();

        $sp = $this->SPF->getSP('content_file_list_all_rated');
        $songList = $sp->execute();

        foreach ($songList as $song) {
            $r = array(
                'fileid' => $song['fileid'],
                'artist' => $song['artist'],
                'title' => $song['title'],
                'name' => $song['name'],
                'contentType' => $song['content_type'],
                'album' => $song['album'],
                'folderid' => $song['folderid'],
                'path' => $song['path'],
		'rating' => $song['rating']
            );
            $jr[] = $r;
        }

        $this->setView('jsonResponse', $jr);
    }

}

?>
