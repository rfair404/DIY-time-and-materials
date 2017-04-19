<?php
/**
 * Class CommonClassTests
 *
 * @package DIY_time_and_materials
 */

/**
 * Common class tests.
 */
class CommonTests extends WP_UnitTestCase {
	/**
	 * Sets up the tests to use the plugin base
	 */
	public function setUp() {
		parent::setUp();
		require_once( dirname( dirname( __FILE__ ) ) . '/diy-time-and-materials.php' );
	}

	/**
	 * Test that the common class is an instance of base.
	 */
	function test_common_extends_base() {
		$common = new DIYTAM_Common;
		$this->assertEquals( 'DIYTAM_Base', get_parent_class( 'DIYTAM_Common' ) );
	}

	/**
	 * Test that the common get version returns parent ver version.
	 */
	function test_common_get_version() {
		// Test that common get version returns the base version.
		$base = new DIYTAM_Base;
		$common = new DIYTAM_Common;
		$this->assertEquals( $base->version, $common->get_version() );
	}

	/**
	 * Test that the common get textdomain works.
	 */
	function test_base_get_textdomain() {
		// Test that common get version returns the same as the base version.
		$base = new DIYTAM_Base;
		$common = new DIYTAM_Common;
		$this->assertEquals( $base->textdomain, $common->get_textdomain() );
	}
}
