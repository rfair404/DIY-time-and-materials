<?php
/**
 * Class BaseClassTests
 *
 * @package DIY_time_and_materials
 */

/**
 * Base class tests.
 */
class BaseTests extends WP_UnitTestCase {
	/**
	 * Sets up the tests to use the plugin base
	 */
	public function setUp() {
		parent::setUp();
		require_once( dirname( dirname( __FILE__ ) ) . '/diy-time-and-materials.php' );
		$this->base = new DIYTAM_Base;
	}

	/**
	 * Test that the base class attributes exist.
	 */
	function test_base_has_attributes() {
		// Test that the base class has known attributes.
		$this->assertClassHasAttribute( 'version', 'DIYTAM_Base' );
		$this->assertClassHasAttribute( 'textdomain', 'DIYTAM_Base' );
	}

	/**
	 * Test that the base get version works.
	 */
	function test_base_get_version() {
		// Test that the get version returns the same as the version.
		$this->assertEquals( $this->base->version, $this->base->get_version() );
	}

	/**
	 * Test that the base get textdomain works.
	 */
	function test_base_get_textdomain() {
		// Test that the get version returns the same as the version.
		$this->assertEquals( $this->base->textdomain, $this->base->get_textdomain() );
	}
}
