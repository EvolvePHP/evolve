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
 * Copyright (c) Vojtěch Hutla, Marian Abaffy
 *
 * Licensed under MIT
 * evolve.github.io
 */

class Settings {
	public static function get($what) {
		$settings_array = json_decode(file_get_contents(EVOLVE_DIR.'/settings/settings.json'),TRUE);
		if(isset($settings_array[$what])) {
			return $settings_array[$what];
		} else {
			return FALSE;
		}
	}
}
