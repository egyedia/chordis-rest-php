<?php
abstract class SPTemplate extends SP {

    protected $injectedQuery;
    
    public function __construct() {
        parent::__construct();
    }

    public function injectQuery($q) {
        $this->injectedQuery = $q;
    }
}
?>
