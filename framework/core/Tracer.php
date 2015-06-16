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

class EvolveException extends Exception {}

class Tracer {
	/**
	 * Clear output, show BSOD and kill itself
	 * @param exception info
	 */
	public static function Show($params) {
		// Initialize BSOD module and execute
		BSOD::Show(array(
			'error_code' => $params['code'],
			'error_line' => $params['line'],
			'show_debug' => constant('EVOLVE_INDEV')
		);

		// Clear output and stop application
		ob_clean();
		exit;
	}
}

class BSOD {
	/**
	 * @var messages for error codes
	 */
	protected $error_messages = array(
		/* Framework's core errors 1XXX */
		'1000' => 'Unknown core error',
		'1001' => 'Cannot load library or plugin - file not exists. Maybe you are trying to use class with uncorrect name.',
		'1002' => 'Cannot access required scripts, because your server has bad access rights'

		/* Database errors 2XXX */
	);

	/**
	 * Show blue screen of death
	 * @param array with arguments (error code, line, ...)
	 */
	public static function Show($params) {
		if(isset($params['show_debug']) AND $params['show_debug'] == 'true') {
			/* Show debug info */
			$output = 'BSOD with debug info';

			/* Get error code comment */
			if(isset(self::$error_messages[$params['code']])) {
				$comment = self::$error_messages[$params['code']];
			} else {
				$comment = 'Unknown error';
			}

		} else {
			/* Show error message only */
			$output = 'Standard BSOD';
		}

		echo $output;
	}
}
