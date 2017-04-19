<?php
/**
 * Class IntegrationTests
 *
 * @package DIY_time_and_materials
 */

/**
 * Integration tests.
 */
class IntegrationTests extends WP_UnitTestCase {
	/**
	 * Sets up the tests to use the plugin base
	 */
	public function setUp() {
		parent::setUp();
		require_once( dirname( dirname( __FILE__ ) ) . '/diy-time-and-materials.php' );
	}
	/**
	 * Test that the core plugin class files exist.
	 */
	function test_core_class_files_exist() {
		// Test that the custom class files exist in the plugin.
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-base.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-common.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-display.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-admin.php' );
	}

	/**
	 * Test that the required taxonomy registration files exist.
	 */
	function test_taxonomy_files_exist() {
		// Test that the taxonomy files exist in the plugin.
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/taxonomies/difficulty.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/taxonomies/time.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/taxonomies/materials.php' );
	}

	/**
	 * Test that the core plugin classes exist.
	 */
	function test_core_classes_exist() {
		// Test that the custom class files exist in the plugin.
		$this->assertTrue( class_exists( 'DIYTAM_Base' ) );
		$this->assertTrue( class_exists( 'DIYTAM_Common' ) );
	}

	/**
	 * Test that the admin  class exists.
	 */
	function test_admin_classes_exist() {
		// Load the class files manually, since it is contextually loaded in plugin.
		require_once( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-admin.php' );
		$this->assertTrue( class_exists( 'DIYTAM_Admin' ) );
	}

	/**
	 * Test that the display class exists.
	 */
	function test_display_classes_exist() {
		// Load the class files manually, since it is contextually loaded in plugin.
		require_once( dirname( dirname( __FILE__ ) ) . '/lib/class-diytam-display.php' );
		$this->assertTrue( class_exists( 'DIYTAM_Display' ) );
	}

}
