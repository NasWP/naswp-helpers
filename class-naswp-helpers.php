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
		private $_config = [];

		/**
		 * Construct
		 *
		 * @param string $config_path Location of the config file.
		 * @return void
		 */
		function __construct(string $config_path = '')
		{
			$this->_load_config($config_path);
		}

		public function mimes($formats_array = [])
		{

			if (empty($formats_array)) {
				$formats_array = $this->_get_value_from_config('mimes', 'array');
			}

			require_once "class-naswp-mimes.php";
			$mimes = new NasWP_Mimes($formats_array);
			$mimes->init();
		}

		public function protected_member($protected_prefix = false)
		{
			require_once "class-naswp-protected-member.php";
			$protected_member = new NasWP_Protected_Member($protected_prefix);
			$protected_member->init();
		}

		public function seo()
		{
			require_once "class-naswp-seo.php";
			$seo = new NasWP_SEO();
			$seo->init();
		}

		public function sitemap($cpts = ['post', 'page'])
		{
			require_once "class-naswp-sitemap.php";
			$sitemap = new NasWP_Sitemap($cpts);
			$sitemap->init();
		}

		/**
		 * Get value from config and check its type. Die with error if doesn't exist or pass the gettype test.
		 * @param string $key Value key.
		 * @param string $type Value type.
		 * @return mixed
		 */
		private function _get_value_from_config(string $key, string $type = 'string')
		{
			if (isset($this->_config[$key])) {
				$value = $this->_config[$key];
				if (gettype($value) === $type) {
					return $value;
				} else {
					trigger_error("NasWP_Helpers: Incorect value type declared for config key $key", E_USER_WARNING);
					die();
				}
			}
			trigger_error("NasWP_Helpers: Parameter for $key not declared in config file or passed in the function.", E_USER_WARNING);
			die();
		}

		/**
		 * Load & parse config file
		 * @param string $config_path Location of the config file.
		 * @return bool Whether the config was loaded or not.
		 */
		private function _load_config(string $config_path = '')
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
					$this->_config =	json_decode($config_loaded, true);
					return true;
				}
			}

			return false;
		}
	}
}
