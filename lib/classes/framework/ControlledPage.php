<?php

abstract class ControlledPage {

    protected $requestContext = null;
    protected $objectList = array();
    protected $errorList = array();
    private $debug = array();

    function __construct($requestContext) {
        $this->requestContext = $requestContext;
        $this->requestContext->setPageObject($this);
    }

    public function getRequestContext() {
        return $this->requestContext;
    }

    public function debug($v, $msg = 'Info') {
        $this->debug[] = array('msg' => $msg, 'value' => $v);
    }

    function getClassName() {
        return get_class($this);
    }

    function registerObject(&$o) {
        $this->objectList[] = &$o;
    }

    function getTemplateName() {
        return 'default';
    }

    function setView($key, $value) {
        $this->view->set($key, $value);
    }

    function getView($key) {
        return $this->view->get($key);
    }

    function getViewObject() {
        return $this->view;
    }

    abstract function renderContent();

    function beforeTemplateRendering() {
        
    }

    function performActionList() {
        for ($i = 0; $i < count($this->objectList); $i++) {
            $this->objectList[$i]->setErrorList($this->errorList);
            $action = null;
            $action = $this->objectList[$i]->performAction();
            if ($action !== null) {
                return $action;
            }
        }
        $this->performPostActionList();
        return null;
    }

    function noErrors() {
        return count($this->errorList) == 0;
    }

    function hasErrors($section = null) {
        if (isset($section)) {
            return isset($this->errorList[$section]) && count($this->errorList[$section]) > 0;
        } else {
            return count($this->errorList) > 0;
        }
    }

    function outputPreTemplateData() {
        
    }

    abstract function performPostActionList();

    protected function renderErrors($errorSection = null) {
        if ($this->hasErrors($errorSection)) {
            print "<br/>";
            $a = isset($errorSection) ? $this->errorList[$errorSection] : $this->errorList;
            foreach ($a as $errorKey) {
                print '<span style="color:red !important;">' . ls($errorKey) . '</span>';
                print "<br/>";
            }
        }
    }

}
