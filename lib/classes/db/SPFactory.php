<?php

class SPFactory {

    private $pathToSPs;
    private $db;

    public function __construct($relativePathToSPs, $db) {
        global $globalImportPrefix;
        $this->db = $db;
        if ($relativePathToSPs === null) {
            $this->pathToSPs = $globalImportPrefix . '../sp/';
        } else {
            $this->pathToSPs = $globalImportPrefix . '../' . $relativePathToSPs;
        }
        mysqli_query($db->getLink(), "SET NAMES 'utf8'");
    }

    /**
     * @param string $name
     * @return SP
     */
    public function getSP($name) {
        $sqlCandidate = $this->pathToSPs . $name . '.sql';
        $phpCandidate = $this->pathToSPs . $name . '.php';
        if (file_exists($sqlCandidate)) {
            return $this->getSQLSP($sqlCandidate, $name);
        } else if (file_exists($phpCandidate)) {
            return $this->getPHPSP($phpCandidate, $name);
        } else {
            debug("Can not read Stored Procedure:\n" . $sqlCandidate . "\n" . $phpCandidate);
            return null;
        }
    }

    private function getPHPSP($filePath, $name) {
        $inc = include_once($filePath);
        $cs = '$sp = new ' . $name . '();';
        eval($cs);
        $sp->setDb($this->db);
        return $sp;
    }

    private function getSQLSP($filePath, $name) {
        $lines = file($filePath);
        if (isset($lines[0])) {
            $firstLine = $lines[0];
            $firstLine = str_replace('--', '', $firstLine);
            $firstLine = ucfirst($firstLine);
            $cs = '$sp = new SPTemplate' . $firstLine . '();';
            eval($cs);
            $sp->setDb($this->db);
            $q = '';
            for ($i = 1; $i < count($lines); $i++) {
                $q .= $lines[$i];
            }
            $sp->injectQuery($q);
            return $sp;
        }
        return null;
    }

}

?>