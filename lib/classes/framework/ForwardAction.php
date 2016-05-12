<?php
class ForwardAction {
    private $pageName;

    public function __construct($pageName) {
        $this->pageName = $pageName;
    }

    public function getPageName() {
        return $this->pageName;
    }

    
}
?>
