<?php
abstract class ChordsPage extends ControlledPage {
    /**
     * @var SPFactory
     */
    protected $SPF;
    protected $view;
    protected $title;

    function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->SPF = $requestContext->getSPFactory();
        $this->view = $requestContext->getView();
    }
    
    function performPostActionList() {
    }
}