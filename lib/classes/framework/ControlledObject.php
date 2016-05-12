<?php

abstract class ControlledObject {

    /**
     * @var RequestContext 
     */
    protected $requestContext = null;
    protected $errorList = null;
    protected $hasSelfError = false;

    public function __construct($requestContext) {
        $this->requestContext = $requestContext;
    }

    function getClassName() {
        return get_class($this);
    }

    function setErrorList(&$el) {
        $this->errorList = &$el;
    }

    function setView($key, $value) {
        $this->view->set($key, $value);
    }

    function getView($key) {
        return $this->view->get($key);
    }

    function addError($s, $section = null) {
        if (isset($section)) {
            if (!isset($this->errorList[$section])) {
                $this->errorList[$section] = array();
            }
            $this->errorList[$section][] = $s;
        } else {
            $this->errorList[] = $s;
        }
        $this->hasSelfError = true;
    }

    function noSelfErrors() {
        return !$this->hasSelfError;
    }

    function forward($pageName) {
        return new ForwardAction($pageName);
    }

    function redirect($url) {
        return new RedirectAction($url);
    }

    public function debug($v, $msg = 'Info') {
        $this->requestContext->getPageObject()->debug($v, $msg);
    }

    function fromPost($form) {
        $form->fromArray($_POST);
        return $form;
    }

    function isPostRequest() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    abstract function performAction();
}

?>