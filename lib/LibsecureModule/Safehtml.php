<?php

/**
 *
 */

class LibsecureModule_Safehtml extends LibsecureModule_Libsecure_Service_Abstract {
    protected $safehtml = null;

    public function __construct() {
	$moduleConfig = Knowledgeroot_Registry::get('libsecure_config');

	if(!defined('XML_HTMLSAX3')) define('XML_HTMLSAX3', dirname(__FILE__)."../../safehtml/classes/");
	require_once('safehtml/classes/safehtml.php');

	$this->safehtml = new safehtml();
    }

    public function check($value) {
	$value = $this->safehtml->parse($value);
	$this->safehtml->clear();

	return $value;
    }
}

?>
