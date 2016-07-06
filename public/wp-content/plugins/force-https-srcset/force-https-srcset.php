<?php

/*
Plugin Name: Force HTTPS Srcset
Plugin URI: https://wordpress.org/plugins/force-https-srcset
Description: Replace Responsive images srcset since wp 4.4 to https!
Version: 1.0
Author: Hinaloe
Author URI: https://hinaloe.net/
Text Domain: force-https-srcset
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

*/

class Hina_Force_Https_Srcset {

	private static $instance = null;


	/**
	 * @return Hina_Force_Https_Srcset instance
	 */
	public static function init() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hina_Force_Https_Srcset constructor.
	 */
	private function __construct() {
		$this->register_hook();
	}

	/**
	 * register action hook(s)
	 */
	private function register_hook() {
		add_filter( 'wp_calculate_image_srcset', array( $this, 'filter_image_srcset' ), 14, 5 );
		add_action( 'admin_init', array( $this, 'load_textdomain' ) );
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );
	}

	/**
	 * @param $sources array
	 * @param $size_array array
	 * @param $image_src string
	 * @param $image_meta array
	 * @param $attachiment_id int
	 *
	 * @return array
	 */
	public function filter_image_srcset( $sources, $size_array, $image_src, $image_meta, $attachiment_id ) {

		if ( is_ssl() or $this->is_force_ssl_everytime() ) {
			array_walk( $sources, array( $this, 'force_scheme_source_url' ) );
		}

		return $sources;
	}

	private function force_scheme_source_url( &$source, $size ) {
		$source['url'] = set_url_scheme( $source['url'], 'https' );
	}

	/**
	 * @return bool
	 */
	private function is_force_ssl_everytime() {
		return (bool) get_option( 'force_https_srcset_everytime' );
	}

	public function settings_api_init() {
		add_settings_field( 'srcset-force-ssl', __( 'Responsive Images', 'force-https-srcset' ), array(
			$this,
			'setting_html',
		), 'media', 'default' );
		register_setting( 'media', 'force_https_srcset_everytime', 'esc_attr' );
	}

	public function setting_html() {
		echo '<label><input name="force_https_srcset_everytime" type="checkbox" value="1" ' . checked( 1, '' != get_option( 'force_https_srcset_everytime' ), false ) . ' />' .
		     __( 'Force <code>srcset</code> attr\'s url scheme to <code>https</code>', 'force-https-srcset' ) . '</label>';
		echo '<p class="description">' . __( 'This option makes srcset url tobe https when you access with <code>http</code>.', 'force-https-srcset' ) . '</p>';

	}

	public function load_textdomain() {
		load_plugin_textdomain( 'force-https-srcset' );
	}


}

if ( defined( 'ABSPATH' ) ) {
	Hina_Force_Https_Srcset::init();
}