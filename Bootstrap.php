<?php

/**
 * module bootstrap
 */
class LibsecureBootstrap extends Knowledgeroot_Module_Bootstrap_Abstract {
	/**
	 * init plugin for libsecure
	 */
	protected function _initPlugin() {
		// get controller instance
		$controller = Zend_Controller_Front::getInstance();

		// register akismet plugin
		$controller->registerPlugin(new LibsecureModule_Libsecure_Plugin());
	}
}
