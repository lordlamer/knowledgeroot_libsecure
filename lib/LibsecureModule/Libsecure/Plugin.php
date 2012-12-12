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

	if ($module == '' && $controller == 'content' && ($action == 'edit' || $action == 'new') && $this->getRequest()->getMethod() == 'POST') {
	    $moduleConfig = Knowledgeroot_Registry::get('libsecure_config');

	    // htmlpurifier check
	    if($moduleConfig->libsecure->htmlpurifier) {
		$htmlpurifier = new LibsecureModule_Htmlpurifier();
		$request->setParam('content', $htmlpurifier->check($request->getParam('content')));
	    }

	    // safehtml check
	    if($moduleConfig->libsecure->safehtml) {
		$safehtml = new LibsecureModule_Safehtml();
		$request->setParam('content', $safehtml->check($request->getParam('content')));
	    }
	}
    }

}