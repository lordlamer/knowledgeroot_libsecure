<?php

/**
 *
 */

class LibsecureModule_Htmlpurifier extends LibsecureModule_Libsecure_Service_Abstract {
    protected $htmlpurifier = null;

    public function __construct() {
	$moduleConfig = Knowledgeroot_Registry::get('libsecure_config');

	require_once('htmlpurifier/HTMLPurifier.auto.php');

	$config = HTMLPurifier_Config::createDefault();
	$config->set('Core.Encoding', 'UTF-8'); //replace with your encoding
	$config->set('HTML.XHTML', true); //replace with false if HTML 4.01
	$config->set('Cache.SerializerPath', dirname(__FILE__).'/../../data/cache');

	$this->htmlpurifier = new HTMLPurifier($config);
    }

    public function check($value) {
	return $this->htmlpurifier->purify($value);
    }
}

?>
