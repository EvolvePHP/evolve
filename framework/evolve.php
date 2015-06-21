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

/* Define constants */
	/* Set framework directory */
	if(isset($ecore_arg['framework_dir'])) {
		define('EVOLVE_DIR',$ecore_arg['framework_dir']);
	} else {
		define('EVOLVE_DIR','./framework');
	}

	/* Set application directory */
	if(isset($ecore_arg['app_dir'])) {
		define('EVOLVE_APPDIR',$ecore_arg['app_dir']);
	} else {
		define('EVOLVE_APPDIR','./app');
	}

	/* Set cache directory */
	if(isset($ecore_arg['cache_dir'])) {
		define('EVOLVE_CACHEDIR',$ecore_arg['cache_dir']);
	} else {
		define('EVOLVE_CACHEDIR','./cache');
	}

	/* Set settings file path */
	if(isset($ecore_arg['settings_path'])) {
		define('EVOLVE_SETTINGS',$ecore_arg['settings_path']);
	} else {
		define('EVOLVE_SETTINGS','./framework/settings/settings.json');
	}

	/* Set development mode */
	if(isset($ecore_arg['devmode'])) {
		define('EVOLVE_INDEV',$ecore_arg['devmode']);
	} else {
		define('EVOLVE_INDEV','false');
	}

/* Manually include core components */
require_once('core/Tracer.php');
require_once('core/CompatibilityChecker.php');
require_once('core/Settings.php');
require_once('core/Loader.php');

/* Initialize loader */
function __autoload($class) {
	$loader = new Loader('NULL');
	try {
		$loader->Load($class);
	} catch(EvolveException $e) {
		Tracer::Show(array('code' => $e->getMessage()));
	}
}
