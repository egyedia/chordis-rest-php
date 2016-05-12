<?php

class SearchResultSongRow extends SongDocument {

    private $score;

    function __construct() {
        //sparent::__construct();
    }

    public function getScore() {
        return $this->score;
    }

    public function setScore($score) {
        $this->score = $score;
    }
    
    public function getKey() {
        return $this->fileid;
    }
    
    public function getDisplayName() {
        return $this->getArtist() . ' - ' . $this->getTitle();
    }

    public static function fromHitDocument($hd, $score) {
        $p = new SearchResultSongRow();
        $p->setScore($score);
        $p->setFileId($hd->getField(LUCENE_INDEX_ID)->getUtf8Value());
        $p->setName($hd->getField(LUCENE_INDEX_NAME)->getUtf8Value());
        $p->setFolderId($hd->getField(LUCENE_INDEX_FOLDER_ID)->getUtf8Value());
        $p->setPath($hd->getField(LUCENE_INDEX_PATH)->getUtf8Value());
        $p->setTitle($hd->getField(LUCENE_INDEX_TITLE)->getUtf8Value());
        $p->setArtist($hd->getField(LUCENE_INDEX_ARTIST)->getUtf8Value());
        $p->setAlbum($hd->getField(LUCENE_INDEX_ALBUM)->getUtf8Value());
        $p->setYear($hd->getField(LUCENE_INDEX_YEAR)->getUtf8Value());
        $p->setMusic($hd->getField(LUCENE_INDEX_MUSIC)->getUtf8Value());
        $p->setLyrics($hd->getField(LUCENE_INDEX_LYRICS)->getUtf8Value());
        $p->setContentType($hd->getField(LUCENE_INDEX_CONTENT_TYPE)->getUtf8Value());
        return $p;
    }

}
