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

	// Then load extension classes by context.
}
add_action( 'plugins_loaded', 'diy_time_and_materials_load' );