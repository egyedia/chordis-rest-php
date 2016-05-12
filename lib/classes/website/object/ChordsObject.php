<?php

abstract class ChordsObject extends ControlledObject {

    /**
     * @var SPFactory 
     */
    protected $SPF;
    protected $view;

    public function __construct($requestContext) {
        parent::__construct($requestContext);
        $this->SPF = $requestContext->getSPFactory();
        $this->view = $requestContext->getView();
    }

}
