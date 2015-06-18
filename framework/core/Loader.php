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
	private $workdir;

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
		} else {
			$this->workdir = EVOLVE_DIR;
		}

		Tracer::Log('loader','info','New instance of loader was created');
		Tracer::Log('loader','info','Working directory: '+$this->workdir);
		Tracer::Log('loader','info','Autoload libraries: '+$this->autoload);
	}

	/**
	 * Find class file and load
	 * @param name of class
	 */
	public function Load($class) {
		if($workdir == EVOLVE_DIR) {
			/* Will load core function */
			$file_to_load = self::$workdir.'/libs/'.$name.'.php';
		} else {
			/* Will load app class (model, view, controller) */
			if(strpos($class,'Controller') !== FALSE) {
				$type = 'controller';
			} elseif(strpos($class,'Model') !== FALSE) {
				$type = 'model';
			} elseif(strpos($class,'View') !== FALSE) {
				$type = 'view';
			} else {
				Tracer::Log('loader','crit_error','Bad class type specified - application was stopped');
				throw new EvolveException('1000');
			}
		}

		/* Load specified class file */
		if(file_exists($file_to_load)) {
			require_once $file_to_load;
		} else {
			Tracer::Log('loader','crit_error','Class '.$name.' cannot be loaded - application was stopped');
			throw new EvolveException('1000');
		}
	}
}
