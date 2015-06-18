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
	/* Set working directory */
	if(isset($ecore_arg['dir'])) {
		define('EVOLVE_DIR',$ecore_arg['dir']);
	} else {
		define('EVOLVE_DIR','./framework');
	}

	/* Set settings file path */
	if(isset($ecore_arg['settings_path'])) {
		define('EVOLVE_SETTINGS',$ecore_arg['settings_path']);
	} else {
		define('EVOLVE_SETTINGS','./framework/settings/settings.json');
	}

	/* Set framework mode */
	if(isset($ecore_arg['mode'])) {
		define('EVOLVE_MODE',$ecore_arg['mode']);
	} else {
		define('EVOLVE_MODE','complete');
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

if(EVOLVE_MODE == 'complete' OR EVOLVE_MODE == 'api_mode') {
	require_once('core/Security.php');
  require_once('core/Router.php');

	if(EVOLVE_MODE == 'complete') {
		require_once('core/Templates.php');
	}
}

Tracer::Log('core','info','Core initialized successfully');

/* Initialize loader */
function __autoload($class) {
	$loader = new Loader();
	try {
		$loader->Load($class);
	} catch(EvolveException $e) {
		Tracer::Show();
	}
}
