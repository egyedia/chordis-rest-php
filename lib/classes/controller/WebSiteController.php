<?php

class WebSiteController {

    // setup
    private $validPageNames = null;
    // inner
    protected $pageName = null;
    protected $pageObject;
    protected $requestContext;

    public function __construct($SPF) {
        global $pageObject;
        $this->requestContext = new RequestContext();
        $this->requestContext->setView(new ControlledView());
        $this->requestContext->setRequestedAction(getGPParameter('requestaction'));
        $this->requestContext->setSPFactory($SPF);

        $this->setupKnownPageNames();
        $pn = getGPParameter('page');
        $this->choosePageName($pn);
        $this->requestContext->getView()->set(ORIGINAL_REQUEST_PAGE_NAME, $pn);

        do {
            import('website.page.' . $this->pageName . 'Page');
            eval('$this->pageObject = new ' . $this->pageName . 'Page($this->requestContext);');
            $action = null;
            $action = $this->pageObject->performActionList();
            if ($action !== null) {
                if ($action instanceof ForwardAction) {
                    $this->pageName = $action->getPageName();
                } else if ($action instanceof RedirectAction) {
                    header('Location:' . $action->getUrl());
                    exit;
                }
            }
        } while ($action !== null);

        $templateName = $this->pageObject->getTemplateName();

        $this->pageObject->beforeTemplateRendering();
        $pageObject = $this->pageObject;
        include_once("../lib/templates/$templateName.php");
    }

    private function setupKnownPageNames() {
        $this->validPageNames = array(
            'Index',
            'ReindexData',
            'ReindexStatusData',
            'SongData',
            'SearchQuickData',
            'FolderAndFileTreeData',
            'ArtistListData',
            'SongsByArtistData',
            'TitleListData'
        );
    }

    private function choosePageName($pn) {
        $pageName = 'Index';

        if (getGETParameter('download') !== null) {
            $pageName = 'DownloadServer';
        }
        if (in_array($pn, $this->validPageNames)) {
            $pageName = $pn;
        }
        $this->pageName = $pageName;
    }

}
