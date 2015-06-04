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

/* Framework version */
define('EVOLVE_VER','0.0.1_indev');

/* Define default constants */
define('EVOLVE_DIR','./framework');
define('EVOLVE_INDEV','false');

/* If is it required, add new value to selected constants */
if(!empty($ecore_arg)) {
	/* List of constants */
	$ecore_constants = array(
		'work_dir' => 'EVOLVE_DIR'
		'devel_mode' => 'EVOLVE_INDEV'
	);

	foreach($ecore_arg as $key => $value) {
		if(isset($ecore_constants[$key])) {
			define($ecore_constants[$key],$value);
		}
	}
}

/* Manually include core components */
require_once('core/Tracer/Tracer.php');
require_once('core/CompatibilityChecker/CompatibilityChecker.php');
require_once('core/Settings/Settings.php');
require_once('core/Loader/Loader.php');

/* Initialize loader */
function LoadClass($class) {
	$loader = new Loader();
	$loader->Load($class);
}
spl_autoload_register(LoadClass);