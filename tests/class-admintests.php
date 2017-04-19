<?php
/**
 * Class AdminClassTests
 *
 * @package DIY_time_and_materials
 */

/**
 * Admin class tests.
 */
class AdminTests extends WP_UnitTestCase {
	/**
	 * Sets up the tests to use the plugin base
	 */
	public function setUp() {
		parent::setUp();
		require_once( dirname( dirname( __FILE__ ) ) . '/diy-time-and-materials.php' );
		require_once( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-admin.php' );

	}

	/**
	 * Test that the admin class is an instance of base.
	 */
	function test_admin_extends_base() {
		$this->assertEquals( 'DIYTAM_Base', get_parent_class( 'DIYTAM_Admin' ) );
	}

	/**
	 * Test that the admin get version returns parent ver version.
	 */
	function test_admin_get_version() {
		// Test that admin get version returns the base version.
		$base = new DIYTAM_Base;
		$admin = new DIYTAM_Admin;
		$this->assertEquals( $base->version, $admin->get_version() );
	}

	/**
	 * Test that the admin get textdomain works.
	 */
	function test_admin_get_textdomain() {
		// Test that admin get version returns the same as the base version.
		$base = new DIYTAM_Base;
		$admin = new DIYTAM_Admin;
		$this->assertEquals( $base->textdomain, $admin->get_textdomain() );
	}
}
