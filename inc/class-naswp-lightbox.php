<?php

/**
 * Pomocník pro vložení ligtbboxu na obrázky a do galerií
 * používá BaguetteBox https://feimosi.github.io/baguetteBox.js/
 *
 * @author Vladimír Smitka, Lynt.cz
 *
 */
if (!class_exists('NasWP_Lightbox')) {

	class NasWP_Lightbox
	{

		private $path;

		public function __construct($path)
		{
			$this->path = $path;
		}

		public function init()
		{
			add_action('wp_enqueue_scripts', array($this, 'load_assets'));
			add_action('enqueue_block_editor_assets', array($this, 'load_editor_assets'));
		}

		public function load_assets()
		{
			// TODO Allow custom blocks
			if (has_block('core/image') || has_block('core/gallery')) {

				wp_enqueue_style('baguette', trailingslashit($this->path) . 'assets/css/baguetteBox.min.css');
				// TODO nahradit jen javascript knihovnou
				wp_enqueue_script('baguette', trailingslashit($this->path) . 'assets/js/baguetteBox.combined.js', array('jquery'), '1.11.1', true);
			}
		}

		public function load_editor_assets()
		{
			// TODO nahradit jen javascript knihovnou
			wp_enqueue_script(
				'baguette',
				trailingslashit($this->path) . 'assets/js/baguetteBox.admin.js',
				array('wp-element', 'wp-blocks', 'wp-components', 'wp-editor')
			);
		}
	}
}
