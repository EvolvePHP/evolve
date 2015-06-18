<?php
/**
 * ███████╗██╗   ██╗ ██████╗ ██╗    ██╗   ██╗███████╗
 * ██╔════╝██║   ██║██╔═══██╗██║    ██║   ██║██╔════╝
 * █████╗  ██║   ██║██║   ██║██║    ██║   ██║█████╗
 * ██╔══╝  ╚██╗ ██╔╝██║   ██║██║    ╚██╗ ██╔╝██╔══╝
 * ███████╗ ╚████╔╝ ╚██████╔╝███████╗╚████╔╝ ███████╗
 * ╚══════╝  ╚═══╝   ╚═════╝ ╚══════╝ ╚═══╝  ╚══════╝
 *
 * Evolve Framework
 * Copyright (c) Evolve Team
 *
 * Licensed under MIT
 * evolve.github.io
 */

class Loader {
	/**
	 * @var Autoloaded libraries
	 */
	private $autoload;

	/**
	 * @var Framework directory
	 */
	private $workdir = EVOLVE_DIR;

	/**
	 * @var Array with known core modules
	 */
	private $known_modules = array(
		'TemplateEngine' => '/core/Templates.php',
		'Router' => '/core/Router.php',
		'Security' => '/core/Security.php'
	);

	/**
	 * Prepare variables and others
	 * @param arguments for loader
	 */
	public function __construct($arg) {
		if(isset($arg['autoload'])) {
			$this->autoload = $arg['autoload'];
		}
	}

	/**
	 * Find class file and load
	 * @param name of class
	 */
	public function Load($class) {
		if(isset($this->known_modules[$class])) {
			/* If loader recognize this class, get path from array */
			$file = EVOLVE_DIR.$this->known_modules[$class];
		} else {
			if(file_exists(EVOLVE_DIR.'/core/'.$class.'.php')) {
				/* Search in core modules */
				$file = EVOLVE_DIR.'/core/'.$class.'.php';
			} elseif(file_exists(EVOLVE_DIR.'/libs/'.$class.'.php')) {
				/* Search in libs */
				$file = EVOLVE_DIR.'/libs/'.$class.'.php';
			} else {
				/* It's not an library, search in app files */
				if($_GET['api_mode'] == 'true') {
					if(file_exists(EVOLVE_APPDIR.'/'.$class.'/'.$class.'.class.php')) {
						$file = EVOLVE_APPDIR.'/'.$class.'/'.$class.'.class.php';
					} else {
						throw new EvolveException('1001');
					}
				} else {
					/* At first, framework need to know type of class */
					if(strpos($class,'Controller') !== FALSE) {
						$type = 'controllers';
					} elseif(strpos($class,'Model') !== FALSE) {
						$type = 'models';
					} elseif(strpos($class,'View') !== FALSE) {
						$type = 'views';
					} else {
						throw new EvolveException('1003');
					}

					if(file_exists(EVOLVE_APPDIR.'/'.$type.'/'.$class.'/'.$class.'.class.php')) {
						$file = EVOLVE_APPDIR.'/'.$type.'/'.$class.'/'.$class.'.class.php';
					} else {
						throw new EvolveException('1001');
					}
				}
			}
		}

		/* File exists, try to load it */
		require_once($file);

	}
}
