<?php

/**
 *
 */
class LibsecureModule_Libsecure_Plugin extends Zend_Controller_Plugin_Abstract {

    /**
     *
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request) {
	$module = $request->getModuleName();
	$controller = $request->getControllerName();
	$action = $request->getActionName();

	// content check
	if ($module == '' && $controller == 'content' && ($action == 'edit' || $action == 'new') && $this->getRequest()->getMethod() == 'POST') {
	    // check content
	    $this->checkParam($request, 'content');
	    $this->checkParam($request, 'content-title');
	}

	// page check
	if ($module == '' && $controller == 'page' && ($action == 'edit' || $action == 'new') && $this->getRequest()->getMethod() == 'POST') {
	    // check content
	    $this->checkParam($request, 'content');
	    $this->checkParam($request, 'page_title');
	}
    }

    /**
     * check specific parameter
     *
     * @param object $request
     * @param string $name
     */
    public function checkParam(Zend_Controller_Request_Abstract $request, $name) {
	$moduleConfig = Knowledgeroot_Registry::get('libsecure_config');

	// htmlpurifier check
	if($moduleConfig->libsecure->htmlpurifier) {
	    $htmlpurifier = new LibsecureModule_Htmlpurifier();
	    $request->setParam($name, $htmlpurifier->check($request->getParam($name)));
	}

	// safehtml check
	if($moduleConfig->libsecure->safehtml) {
	    $safehtml = new LibsecureModule_Safehtml();
	    $request->setParam($name, $safehtml->check($request->getParam($name)));
	}
    }

}