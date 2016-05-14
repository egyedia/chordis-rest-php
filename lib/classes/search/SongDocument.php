<?php

class SongDocument {

    protected $fileid;
    private $name;
    private $path;
    private $folderid;
    private $title;
    private $artist;
    private $album;
    private $year;
    private $music;
    private $lyrics;
    private $content;
    private $contentType;
    private $hash;

    function __construct($fileid, $name, $path, $folderid, $title, $artist, $album, $year, $music, $lyrics, $content, $contentType, $hash) {
        $this->fileid = $fileid;
        $this->name = $name;
        $this->path = $path;
        $this->folderid = $folderid;
        $this->title = $title;
        $this->artist = $artist;
        $this->album = $album;
        $this->year = $year;
        $this->music = $music;
        $this->lyrics = $lyrics;
        $this->content = $content;
        $this->contentType = $contentType;
        $this->hash = $hash;
    }

    function getFileid() {
        return $this->fileid;
    }

    function getName() {
        return $this->name;
    }

    function getPath() {
        return $this->path;
    }

    function getFolderid() {
        return $this->folderid;
    }

    function getTitle() {
        return $this->title;
    }

    function getArtist() {
        return $this->artist;
    }

    function getAlbum() {
        return $this->album;
    }

    function getYear() {
        return $this->year;
    }

    function getMusic() {
        return $this->music;
    }

    function getLyrics() {
        return $this->lyrics;
    }

    function getContent() {
        return $this->content;
    }

    function getContentType() {
        return $this->contentType;
    }

    function setFileid($fileid) {
        $this->fileid = $fileid;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPath($path) {
        $this->path = $path;
    }

    function setFolderid($folderid) {
        $this->folderid = $folderid;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setArtist($artist) {
        $this->artist = $artist;
    }

    function setAlbum($album) {
        $this->album = $album;
    }

    function setYear($year) {
        $this->year = $year;
    }

    function setMusic($music) {
        $this->music = $music;
    }

    function setLyrics($lyrics) {
        $this->lyrics = $lyrics;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setContentType($contentType) {
        $this->contentType = $contentType;
    }
    
    function getHash() {
        return $this->hash;
    }

    function setHash($hash) {
        $this->hash = $hash;
    }

    function getIndexableContent() {
        $s = '';
        $s .= $this->name . ' ';
        $s .= $this->path . ' ';
        $s .= $this->title . ' ';
        $s .= $this->artist . ' ';
        $s .= $this->album . ' ';
        $s .= $this->year . ' ';
        $s .= $this->music . ' ';
        $s .= $this->lyrics . ' ';
        $s .= $this->content . ' ';
        return $s;
    }

}
