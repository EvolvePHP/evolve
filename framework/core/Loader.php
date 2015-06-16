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
	 * @var Framework directory (will be overwritted, if is set as argument)
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
		if(isset($arg['directory'])) {
			$this->workdir = $arg['workdir'];
		}
	}

	/**
	 * Find class file and load
	 * @param name of class
	 */
	public function Load($class) {
		if($workdir == constant('EVOLVE_DIR')) {
			/* Will load core function */
			if(file_exists(self::$workdir.'/libs/'.$name.'.php')) {
				require_once self::$workdir.'/libs/'.$name.'.php';
			} elseif(file_exists(self::$workdir.'/app_classes/'.$name.'/'.$name.'.php')) {
				require_once self::$workdir.'/app_classes/'.$name.'/'.$name.'.php';
			} else {
				throw new EvolveException('1000');
			}
		} else {
			/* Will load app class (model, view, controller) */
			if(strpos($class,'Controller') !== FALSE) {
				$type = 'controller';
			} elseif(strpos($class,'Model') !== FALSE) {
				$type = 'model';
			} elseif(strpos($class,'View') !== FALSE) {
				$type = 'view';
			} else {
				throw new EvolveException('1000');
			}
		}
	}

}
