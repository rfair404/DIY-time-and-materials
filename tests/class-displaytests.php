<?php
/**
 * Class DisplayClassTests
 *
 * @package DIY_time_and_materials
 */

/**
 * Display class tests.
 */
class DisplayTests extends WP_UnitTestCase {
	/**
	 * Sets up the tests to use the plugin base
	 */
	public function setUp() {
		parent::setUp();
		require_once( dirname( dirname( __FILE__ ) ) . '/diy-time-and-materials.php' );
		require_once( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-display.php' );
	}

	/**
	 * Test that the display class is an instance of base.
	 */
	function test_display_extends_base() {
		$this->assertEquals( 'DIYTAM_Base', get_parent_class( 'DIYTAM_Display' ) );
	}

	/**
	 * Test that the display get version returns parent ver version.
	 */
	function test_display_get_version() {
		// Test that display get version returns the base version.
		$base = new DIYTAM_Base;
		$display = new DIYTAM_Display;
		$this->assertEquals( $base->version, $display->get_version() );
	}

	/**
	 * Test that the display get textdomain works.
	 */
	function test_display_get_textdomain() {
		// Test that display get version returns the same as the base version.
		$base = new DIYTAM_Base;
		$display = new DIYTAM_Display;
		$this->assertEquals( $base->textdomain, $display->get_textdomain() );
	}
}
