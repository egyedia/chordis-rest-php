<?php
class RequestContext {

    private $requestedAction;
    private $pageObject;
    private $SPFactory;
    private $view;

    public function __construct() {

    }

    public function getRequestedAction() {
        return $this->requestedAction;
    }

    public function setRequestedAction($requestedAction) {
        $this->requestedAction = $requestedAction;
    }

    /**
     * @return ControlledPage 
     */
    public function getPageObject() {
        return $this->pageObject;
    }

    public function setPageObject($pageObject) {
        $this->pageObject = $pageObject;
    }

    /**
     * @return SPFactory
     */
    public function getSPFactory() {
        return $this->SPFactory;
    }

    public function setSPFactory($SPFactory) {
        $this->SPFactory = $SPFactory;
    }

    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
    }

}
?>