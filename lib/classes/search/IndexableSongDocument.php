<?php

class IndexableSongDocument extends Zend_Search_Lucene_Document {

    private $encoding = 'utf-8';

    public function __construct(SongDocument $doc) {
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_ID, $doc->getFileId(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_NAME, $doc->getName(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_PATH, $doc->getPath(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_FOLDER_ID, $doc->getFolderId(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_HASH, $doc->getHash(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Text(LUCENE_INDEX_TITLE, $doc->getTitle(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Text(LUCENE_INDEX_ARTIST, $doc->getArtist(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Text(LUCENE_INDEX_ALBUM, $doc->getAlbum(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::UnIndexed(LUCENE_INDEX_YEAR, $doc->getYear(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Text(LUCENE_INDEX_MUSIC, $doc->getMusic(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Text(LUCENE_INDEX_LYRICS, $doc->getLyrics(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::Keyword(LUCENE_INDEX_CONTENT_TYPE, $doc->getContentType(), $this->encoding));
        $this->addField(Zend_Search_Lucene_Field::UnStored(LUCENE_INDEX_INDEXABLE_CONTENT, $doc->getIndexableContent(), $this->encoding));
    }

}
