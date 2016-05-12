<?php

class SearchQuickDataPageManager extends ChordsObject {

    public function __construct($requestContext) {
        parent::__construct($requestContext);
    }

    public function performAction() {
        global $options;

        $jr = array();
        $sq = getGETParameter('term');


        $sh = new SearchHandler($this->SPF, $options);
        $searchResults = $sh->searchQS($sq, null);
        foreach ($searchResults->getRows() as $row) {
            //debug($row);
            $r = array(
                'id' => $row->getFileId(),
                'title' => $row->getTitle(),
                'artist' => $row->getArtist(),
                'folderid' => $row->getFolderId(),
                'path' => $row->getPath(),
                'name' => $row->getName(),
                'contentType' => $row->getContentType()
            );
            $jr[] = $r;
        }

        $this->setView('jsonResponse', $jr);
    }

}

?>
