<?php
class Options {

    private $SPF;
    private $loadedValues;
    private $failedKeys;

    public function  __construct($SPF) {
        $this->SPF = $SPF;
        $this->loadedValues = array();
        $this->failedKeys = array();
        $this->autoloadValues();
    }

    private function autoloadValues() {
        $sp = $this->SPF->getSP('list_site_options_by_autoload');
        $sp->setParameter('autoload', 1);
        $list = $sp->execute();
        foreach($list as $row) {
            $this->storeValue($row);
        }
    }

    private function storeValue($row) {
        $ot = $row['option_type'];
        $value = $row['option_value'];
        $key = $row['option_name'];
        if ($ot == 'json') {
            // assoc
            $value = json_decode($value, true);
        } else if ($ot == 'jsonObject') {
            // object
            $value = json_decode($value, false);
        }
        $this->loadedValues[$key] = $value;
    }

    public function getOption($key, $defaultValue = null) {
        if (isset($this->loadedValues[$key])) {
            return $this->loadedValues[$key];
        } else if ($defaultValue !== null) {
            return $defaultValue;
        } else if (!isset($this->failedKeys[$key])) {
            return $this->loadNoAutoloadKey($key);
        } else {
            return 'NO SUCH OPTION:' . $key;
        }
    }
    
    private function loadNoAutoloadKey($key) {
        print "Missing key:$key";
        exit;
    }
}
?>
