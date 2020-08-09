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

		public function auto_async_js()
		{
			require_once "class-naswp-auto-async-js.php";
			$async = new NasWP_AutoAsyncJS();
			$async->init();
		}

		public function colors($colors = [], $allow_custom_colors = null, $gradients = [], $allow_custom_gradients = null)
		{

			if (empty($colors)) {
				$colors = $this->_get_value_from_config('colors', 'array');
			}
			if ($allow_custom_colors === null) {
				$allow_custom_colors = $this->_get_value_from_config('allow_custom_colors', 'boolean', true);
			}
			if (empty($gradients)) {
				$gradients = $this->_get_value_from_config('gradients', 'array', null);
			}
			if ($allow_custom_gradients === null) {
				$allow_custom_gradients = $this->_get_value_from_config('allow_custom_gradients', 'boolean', true);
			}

			require_once "class-naswp-colors.php";
			$colors_obj = new NasWP_Colors($colors, $allow_custom_colors, $gradients, $allow_custom_gradients);
			$colors_obj->init();
		}

		public function file_names()
		{
			require_once "class-naswp-file-names.php";
			$filenames = new NasWP_FileNames();
			$filenames->init();
		}

		/**
		 * Load GA
		 * @param string $id  GA ID. Could by passed in config file.
		 * @return void
		 */
		public function ga($id = '')
		{
			if (empty($id)) {
				$id = $this->_get_value_from_config('ga');
			}
			require_once "class-naswp-ga.php";
			$ga = new NasWP_GA($id);
			$ga->init();
		}
		/**
		 * Load GTM
		 * @param string $id  GTM ID. Could by passed in config file.
		 * @return void
		 */
		public function gtm($id = '')
		{
			if (empty($id)) {
				$id = $this->_get_value_from_config('gtm');
			}
			require_once "class-naswp-gtm.php";
			$gtm = new NasWP_GTM($id);
			$gtm->init();
		}

		/**
		 * Load lightbox
		 * @param mixed $path_to_helpers The path to helpers.
		 * @return void
		 */
		public function lightbox($path_to_helpers)
		{

			// TODO Jak vyřešit cestu ke zdrojovým souborům?

			require_once "class-naswp-lightbox.php";
			$lightbox = new NasWP_Lightbox($path_to_helpers);
			$lightbox->init();
		}

		/**
		 * Allow selected mime types.
		 * @param array $formats_array Mime types keyed by the file extension regex corresponding to those types. Could by passed in config file.
		 * @return void
		 */
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

		/**
		 * Generate sitemap for selected post types.
		 * @param array $cpts List of postypes. Could by passed in config file.
		 * @return void
		 */
		public function sitemap($cpts = [])
		{
			if (empty($cpts)) {
				$cpts = $this->_get_value_from_config('sitemap', 'array', ['post', 'page']);
			}

			require_once "class-naswp-sitemap.php";
			$sitemap = new NasWP_Sitemap($cpts);
			$sitemap->init();
		}

		/**
		 * Get value from config and check its type. Die with error if no default value provided.
		 * @param string $key Value key.
		 * @param string $type Value type.
		 * @param mixed $default Default value.
		 * @return mixed
		 */
		private function _get_value_from_config(string $key, string $type = 'string', $default = '')
		{
			if (isset($this->_config[$key])) {
				$value = $this->_config[$key];
				if (gettype($value) === $type) {
					return $value;
				} else {
					trigger_error("NasWP_Helpers: Incorect value type declared for config key $key", E_USER_WARNING);
					if ($default) {
						return $default;
					} else {
						die();
					}
				}
			}

			if ('' === $default) {
				return $default;
			} else {
				trigger_error("NasWP_Helpers: Parameter for $key not declared in config file or passed in the function.", E_USER_WARNING);
				die();
			}
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
