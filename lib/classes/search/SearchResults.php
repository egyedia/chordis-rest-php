<?php

class SearchResults extends AbstractSongRowList {

    private $tooMuchHits;
    private $maxHitCount;
    private $totalHitCount;
    private $showHitCount;

    private $exception;


    function __construct() {
        parent::__construct();
        $this->tooMuchHits = false;
        $this->maxHitCount = null;
    }

    public function getException() {
        return $this->exception;
    }

    public function setException($exception) {
        $this->exception = $exception;
    }

    public function setMaxHitCount($maxHitCount) {
        $this->maxHitCount = $maxHitCount;
    }

    public function storeHits($hits) {
        $this->totalHitCount = count($hits);
        $this->showHitCount = $this->totalHitCount;

        if ($this->maxHitCount !== null && $this->totalHitCount > $this->maxHitCount) {
            $this->tooMuchHits = true;
            $this->showHitCount = $this->maxHitCount;
        }

        for($i = 0; $i < $this->showHitCount; $i++) {
            if (isset($hits[$i])) {
                $hit = $hits[$i];
                $hd = $hit->getDocument();
                $row = SearchResultSongRow::fromHitDocument($hd, $hit->score);
                $this->addRow($row);
            }
        }
    }

}
