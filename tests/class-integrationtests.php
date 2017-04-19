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
	 * Test that the core plugin classes files exist.
	 */
	function test_core_class_files_exist() {
		// Test that the custom class files exist in the plugin.
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-DIYTAM_Base.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-DIYTAM_Common.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-DIYTAM_Display.php' );
		$this->assertFileExists( dirname( dirname( __FILE__ ) ) . '/lib/class-DIYTAM_Admin.php' );
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
}
