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
	private $workdir = constant('EVOLVE_DIR');

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
		if(file_exists(self::$workdir.'/libs/'.$name.'/'.$name.'.php')) {
			require_once $workdir.'/libs/'.$name.'/'.$name.'.php';
		} else {
			echo 'Error!!';
		}
	}

}
