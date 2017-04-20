<?php
/**
 * Plugin Name: DIY-time-and-materials/
 * Version: 0.1-alpha
 * Description: A WordPress plugin for displaying time, materials and for DIY bloggers.
 * Author: Russell Fair
 * Author URI: https://rfair404.github.io/resume
 * Text Domain: diy-time-and-materials/
 * Domain Path: /languages
 *
 * @package DIY-time-and-materials/
 */

if ( ! defined( ABSPATH ) ) { die(); }

global $wp_version;
if ( version_compare( PHP_VERSION, '5.3', '<' ) || version_compare( $wp_version, '4.7', '<' ) ) {
	exit(
		sprintf( 'This plugin requires PHP 5.3 or higher and WordPress version 4.7 or higher. You\'re current PHP version is %1$s and WordPress version is %2$s', esc_html( PHP_VERSION ), esc_html( $wp_version ) )
	);
}

/**
 * Function diy_time_and_materials_load loads required files
 *
 * @since 0.1-alpha
 * @author Russell Fair
 */
function diy_time_and_materials_load() {
	// Load the base class.
	require_once( 'lib/class-diytam-base.php' );
	require_once( 'lib/class-diytam-common.php' );

	$common = new DIYTAM_Common;
	$common->init();

	if ( is_admin() ) {
		// Administrative pages get admin.
		require_once( 'lib/class-diytam-admin.php' );
		$admin = new DIYTAM_Admin;
		$admin->init();
	} else {
		// Not admin pages get display.
		require_once( 'lib/class-diytam-display.php' );
		$display = new DIYTAM_Display;
		$display->init();
	}

	// Then load extension classes by context.
}
add_action( 'plugins_loaded', 'diy_time_and_materials_load' );
