<?php

class SearchHandler {

    private $SPF;
    private $options;
    private $sr;
// Index
    private $index = null;
    private $folderMap;
    private $albumMap;

    public function __construct($SPF, $options) {
        $this->SPF = $SPF;
        $this->options = $options;
        set_time_limit(60 * 10);
    }

    /*
      public function clearSearchIndex() {
      $this->initLucene();
      $this->openFreshIndex();
      $this->closeIndex();
      }
     */

    private function initLucene() {
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
                new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
    }

    private function openFreshIndex() {
        global $p2r;
        $wd = $p2r . $this->options->getOption('lucene.product.dir');
        $this->index = Zend_Search_Lucene::create($wd);
        return $wd;
    }

    private function openOldIndex() {
        global $p2r;
        $wd = $p2r . $this->options->getOption('lucene.product.dir');
        $this->index = Zend_Search_Lucene::open($wd);
    }

    function closeIndex() {
        $this->index->commit();
    }

    /*
      private function processKalaka() {

      $this->albumMap = array();
      $this->albumMap['Hol a nadragom'] = 'Hol a nadrágom';
      $this->albumMap['Fekete ember'] = 'Fekete ember';
      $this->albumMap['Varazsviragok'] = 'Varázsvirágok';
      $this->albumMap['Esti csendben'] = 'Esti csendben';
      $this->albumMap['Csak az egeszseg'] = 'Csak az egészség';
      $this->albumMap['Egyeb'] = 'Egyéb';
      $this->albumMap['Hajnali rigok'] = 'Hajnali rigók';
      $this->albumMap['Borond Odon'] = 'Bőrönd Ödön';
      $this->albumMap['25'] = '25';
      $this->albumMap['Ukulele'] = 'Ukulele';
      $this->albumMap['Nalatok laknak-e allatok'] = 'Nálatok laknak-e állatok';
      $this->albumMap['Kanyadi'] = 'Kányádi';
      $this->albumMap['30'] = '30';
      $this->albumMap['Az en szivemben'] = 'Az én szívemben';
      $this->albumMap['Kalaka'] = 'Kaláka';
      $this->albumMap['Villon'] = 'Villon';
      $this->albumMap['Boldog, szomoru dal'] = 'Boldog, szomorú dal';
      $this->albumMap['A pelikan'] = 'A pelikán';
      $this->albumMap['Az en koromban'] = 'Az én koromban';
      $path = $this->options->getOption('chords.source.dir');
      //debug($path);
      $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
      foreach ($objects as $name => $object) {
      $fn = $object->getFileName();
      if ($fn != '.' && $fn != '..') {
      $relative = $name;
      $relative = str_replace($path, '', $relative);
      $parentFolder = $object->getPath();
      $relativeParent = str_replace($path, '', $parentFolder);
      if (!is_dir($name)) {
      print "<hr />";
      //debug($fn);
      debug($relativeParent);
      $album = substr($relativeParent, 9);
      $album = $this->albumMap[$album];
      $content = $this->getFileContent($object);
      $content = trim($content);
      $lines = explode("\n", $content);
      $dataline = $lines[0];
      //debug($dataline);
      list($names, $title) = explode(":", $dataline);
      $title = trim($title);
      list($lyrics, $music) = explode('-', $names);
      $lyrics = trim($lyrics);
      $music = trim($music);
      //debug($lyrics);
      //debug($music);
      //debug($title);

      $meta = '';
      $meta .= "{charset:UTF-8}\n";
      $meta .= "{artist:Kaláka}\n";
      $meta .= "{title:$title}\n";
      $meta .= "{album:$album}\n";
      $meta .= "{lyrics:$lyrics}\n";
      $meta .= "{music:$music}\n";

      array_shift($lines);

      $meta .= implode("\n", $lines);

      $meta = str_replace('û', 'ű', $meta);
      $meta = str_replace('õ', 'ő', $meta);

      //debug($meta);

      $targetDir = '/home/dubylon/chords_dest/' . $relativeParent;
      mkdir($targetDir, 0777, true);
      $target = $targetDir . '/' . $fn;
      debug($target);
      file_put_contents($target, $meta);
      //debug($lines);
      }
      }
      }
      }
     */

    public function updateSearchIndex() {

        $sp = $this->SPF->getSP('content_folder_truncate');
        $sp->execute();

        $sp = $this->SPF->getSP('content_file_truncate');
        $sp->execute();

        $spInsertFolder = $this->SPF->getSP('content_folder_insert');
        $spSelectFolder = $this->SPF->getSP('content_folder_get_by_path');
        $spUpdateFolderSI = $this->SPF->getSP('content_folder_update_source_info');
        $spUpdateFolderTA = $this->SPF->getSP('content_folder_update_title_artist');
        $spInsertFile = $this->SPF->getSP('content_file_insert');

        $folderMap = array();

        $path = $this->options->getOption('chords.source.dir');
        //debug($path);
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        $i = 0;
        foreach ($objects as $name => $object) {
            $fn = $object->getFileName();
            if ($fn != '.' && $fn != '..') {
                $relative = $name;
                $relative = str_replace($path, '', $relative);
                $parentFolder = $object->getPath();
                $relativeParent = str_replace($path, '', $parentFolder);
                if (is_dir($name)) {
                    //echo "<hr>";
                    //echo "<b>DIR : $relative</b><br />\n";
                    $this->reportStatus("Detecting structure", $relative, $i);

                    $spSelectFolder->setParameter('path', $relativeParent);
                    $parentFolder = $spSelectFolder->execute();

                    $parentFolderId = $parentFolder == null ? null : $parentFolder['id'];

                    $spInsertFolder->setParameter('name', $fn);
                    $spInsertFolder->setParameter('path', $relative);
                    $spInsertFolder->setParameter('parent_id', $parentFolderId);
                    $containerId = $spInsertFolder->execute();
                    $folderMap[$relative] = $containerId;
                } else {
                    //debug($folderMap);
                    $ownerId = $folderMap[$relativeParent];
                    $content = $this->getFileContent($object);
                    if ($fn == 'source.info') {
                        //echo "<b>SOURCE INFO: $relative</b><br />\n";
                        $this->reportStatus("Detecting structure", $relative, $i);
                        $spUpdateFolderSI->setParameter('id', $ownerId);
                        $spUpdateFolderSI->setParameter('source_info', $content);
                        $spUpdateFolderSI->execute();
                    } else if ($fn == '_dirinfo.ecrd') {
                        //echo "<b>DIR INFO: $relative</b><br />\n";
                        $this->reportStatus("Detecting structure", $relative, $i);
                        list($title, $artist) = $this->extractTitleAndArtist($content);
                        $spUpdateFolderTA->setParameter('id', $ownerId);
                        $spUpdateFolderTA->setParameter('title', $title);
                        $spUpdateFolderTA->setParameter('artist', $artist);
                        $spUpdateFolderTA->execute();
                    } else {
                        //echo "FILE: $relativeParent|$fn<br>\n";
                        $hash = md5($relativeParent . '/' . $fn);
                        $this->reportStatus("Detecting structure", $relative, $i);
                        $spInsertFile->setParameter('parent_id', $ownerId);
                        $spInsertFile->setParameter('name', $fn);
                        $spInsertFile->setParameter('hash', $hash);
                        $spInsertFile->setParameter('title', $this->extractTag($content, 'title'));
                        $spInsertFile->setParameter('artist', $this->extractTag($content, 'artist'));
                        $spInsertFile->setParameter('album', $this->extractTag($content, 'album'));
                        $spInsertFile->setParameter('year', $this->extractTag($content, 'year'));
                        $spInsertFile->setParameter('music', $this->extractTag($content, 'music'));
                        $spInsertFile->setParameter('lyrics', $this->extractTag($content, 'lyrics'));
                        $spInsertFile->setParameter('content_type', $this->extractTag($content, 'filetype'));
                        $spInsertFile->setParameter('youtube', $this->extractTag($content, 'youtube'));

                        $content = $this->deleteTag($content, 'title');
                        $content = $this->deleteTag($content, 'artist');
                        $content = $this->deleteTag($content, 'album');
                        $content = $this->deleteTag($content, 'year');
                        $content = $this->deleteTag($content, 'music');
                        $content = $this->deleteTag($content, 'lyrics');
                        $content = $this->deleteTag($content, 'filetype');
                        $content = $this->deleteTag($content, 'charset');
                        $content = $this->deleteTag($content, 'youtube');
                        $content = trim($content);

                        $spInsertFile->setParameter('content', $content);
                        $spInsertFile->execute();
                    }
                }
            }
            $i++;
        }

        $this->initLucene();
        $this->openFreshIndex();
        $this->indexSongs();
        $this->closeIndex();
        $this->reportStatus("", "", "", false);
    }

    private function reportStatus($phase, $step, $count, $running = true) {
        if ($count % 25 == 0) {
            $status = array(
                'phase' => $phase,
                'step' => $step,
                'count' => $count,
                'running' => $running
            );
            $sp = $this->SPF->getSP('site_editable_options_update');
            $sp->setParameter('name', 'indexing.status');
            $sp->setParameter('value', json_encode($status));
            $sp->execute();
        }
    }

    private function extractTag($content, $tagName) {
        $v = null;
        $pattern = '/{' . $tagName . ':(.*)}/';
        $matches = null;
        preg_match($pattern, $content, $matches);
        //debug($pattern);
        //debug($matches);
        if (isset($matches[1])) {
            $v = trim($matches[1]);
        }
        return $v;
    }

    private function deleteTag($content, $tagName) {
        $pattern = '/{' . $tagName . ':(.*)}/';
        $matches = null;
        preg_match($pattern, $content, $matches);
        //debug($pattern);
        //debug($matches);
        if (isset($matches[0])) {
            $content = str_replace($matches[0], '', $content);
        }
        return $content;
    }

    private function extractTitleAndArtist($content) {
        $title = $this->extractTag($content, 'title');
        $artist = $this->extractTag($content, 'artist');
        return array($title, $artist);
    }

    private function getFileContent($fo) {
        $path = $fo->getPathName();

        $c = file_get_contents($path);

        if ($fo->getFileName() == 'source.info') {
            return $c;
        }

        $charset = $this->extractTag($c, 'charset');
        if ($charset == null) {
            //debug("<b>Charset not detected: $path</b>");
            return $c;
        } else {
            $c = mb_convert_encoding($c, 'UTF-8', $charset);
            return $c;
        }
    }

    private function indexSongs() {
        $i = 0;
        $sp = $this->SPF->getSP('content_file_list_all');
        $list = $sp->execute();
        foreach ($list as $song) {
            //debug($song);
            $doc = new SongDocument(
                    $song['fileid'], $song['name'], $song['path'], $song['folderid'], $song['title'], $song['artist'], $song['album'], $song['year'], $song['music'], $song['lyrics'], $song['content'], $song['content_type'], $song['hash']
            );
            $idoc = new IndexableSongDocument($doc);
            $this->index->addDocument($idoc);
            $this->reportStatus("Indexing documents", $song['path'] . '/' . $song['name'], $i);
            $i++;
            /*if ($i > 100) {
                return;
            }*/
        }
    }

    private function sanitizeQueryString($qs) {
//$qs = str_replace('*', '', $qs);
//$qs = str_replace('?', '', $qs);
        $qs = str_replace('~', '', $qs);
        $qs = str_replace(':', '', $qs);
        $qs = str_replace('.', ',', $qs);
        return $qs;
    }

    /*
      function dummyzeQueryString($qs) {
      $qs = str_replace(' ', '+', $qs);
      return '+' . $qs;
      }
     */

    public function searchQS($qs, $maxHitCount) {
        $this->initLucene();
        $this->openOldIndex();
        $sqs = $this->sanitizeQueryString($qs);
        //$sqs = dummyzeQueryString($sqs);
        $searcException = null;
        try {
            $currentResultSetLimit = Zend_Search_Lucene::getResultSetLimit();
            Zend_Search_Lucene::setResultSetLimit(150);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($sqs, 'UTF-8');
            $hits = $this->index->find($query);
        } catch (Zend_Search_Lucene_Exception $ex) {
            $searcException = $ex;
        }

        $this->sr = new SearchResults();

        if ($searcException !== null) {
            $this->sr->setException($searcException);
        } else {
            $this->sr->setMaxHitCount($maxHitCount);
            $this->sr->storeHits($hits);

            $this->decorateResultWithSongData();
        }
        return $this->sr;
    }

    private function decorateResultWithSongData() {
        $hashList = $this->sr->getHashList();
     
        if (strlen($hashList) > 0) {
            $sp = $this->SPF->getSP('content_file_list_for_hash_list');
            $sp->setParameters(
                    array(
                        'hash_list' => $hashList
                    )
            );
            $list = $sp->execute();
            foreach ($list as $song) {
                $this->sr->decorateSongWithCurrentData($song['hash'], $song['rating']);
            }
        }
    }

}
