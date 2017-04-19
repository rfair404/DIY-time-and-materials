<?php
/**
 * Plugin Name: DIY-time-and-materials/
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: DIY-time-and-materials/
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
	// Then load extension classes by context.
}
add_action( 'plugins_loaded', 'diy_time_and_materials_load' );
