<?php

/**
 * libsecure module initialisation
 */
class LibsecureModule implements Knowledgeroot_Module_Interface {
	/**
	 * return akismet config path
	 */
	public function getConfigPath() {
		return __DIR__ . '/config/module.ini';
	}
}
