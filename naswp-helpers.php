<?php

/**
 * Main class for loading of helpers - mapping classes to functions
 *
 * @author Vladimír Smitka, Lynt.cz
 * @author Karolína Vyskočilová, kybernaut.cz
 * @package NasWP_Helpers
 */

if (!class_exists('NasWP_Helpers')) {
	class NasWP_Helpers
	{
		/**
		 * Config
		 * @var array
		 */
		private $config = [];

		/**
		 * Construct
		 *
		 * @param string $config_path Location of the config file.
		 * @return void
		 */
		function __construct(string $config_path = '')
		{
			$this->load_config($config_path);
			var_dump($this->config);
		}

		/**
		 * Load & parse config file
		 * @param string $config_path Location of the config file.
		 * @return bool Whether the config was loaded or not.
		 */
		private function load_config(string $config_path = '')
		{
			if ($config_path) {

				// Check the file extension.
				if (substr($config_path, -4) !== 'json') {
					trigger_error("The NasWP Helpers config is not a json file.", E_USER_WARNING);
					return false;
				}

				// Load content.
				$config_loaded = file_get_contents($config_path);
				if ($config_loaded) {
					$this->config =	json_decode($config_loaded, true);
					return true;
				}
			}

			return false;
		}
	}
}
