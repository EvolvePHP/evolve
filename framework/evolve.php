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
define('EVOLVE_DIR','./framework');
define('EVOLVE_INDEV','false');
define('EVOLVE_SETTINGS','./framework/settings/settings.json');
define('EVOLVE_MODE','complete');

/* If is it required by developer, rewrite selected constants */
if(!empty($ecore_arg)) {
	/* List of constants */
	$ecore_constants = array(
		'work_dir' => 'EVOLVE_DIR',
		'devel_mode' => 'EVOLVE_INDEV',
    'settings_file' => 'EVOLVE_SETTINGS',
		'mode' => 'EVOLVE_MODE'
	);

	foreach($ecore_arg as $key => $value) {
		if(isset($ecore_constants[$key])) {
			define($ecore_constants[$key],$value);
		}
	}
}

/* Manually include core components */
require_once('core/Tracer.php');
require_once('core/CompatibilityChecker.php');
require_once('core/Settings.php');
require_once('core/Loader.php');

if(constant('EVOLVE_MODE') == 'complete' OR constant('EVOLVE_MODE') == 'development') {
	require_once('core/Security.php');
  require_once('core/Router.php');

	if(constant('EVOLVE_MODE') == 'development') {
		echo 'Development tools: active';
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
