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
	 * A single example test.
	 */
	function test_files_exist() {
		// Test that the required files exist in the plugin.
		$this->assertTrue( file_exists( '../lib/taxonomy-time.php' ) );
	}
}

