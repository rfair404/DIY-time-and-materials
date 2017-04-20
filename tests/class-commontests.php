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
		// Envoke the base class.
		$this->base = new DIYTAM_Base;
		// Envoke the common class.
		$this->common = new DIYTAM_Common;
		// Initialize the common class constructor.
		$this->common->init();
	}

	/**
	 * Test that the common class is an instance of base.
	 */
	function test_common_extends_base() {
		$this->assertEquals( 'DIYTAM_Base', get_parent_class( 'DIYTAM_Common' ) );
	}

	/**
	 * Test that the common get version returns parent ver version.
	 */
	function test_common_get_version() {
		// Test that common get version returns the base version.
		$this->assertEquals( $this->base->version, $this->common->get_version() );
	}

	/**
	 * Test that the common get textdomain works.
	 */
	function test_common_get_textdomain() {
		// Test that common get version returns the same as the base version.
		$this->assertEquals( $this->base->textdomain, $this->common->get_textdomain() );
	}

	/**
	 * Test that the common registers custom taxonomies.
	 */
	function test_common_init_hooks_registration_functions() {
		$this->assertEquals( 10, has_action( 'init', array( $this->common, 'difficulty_init' ) ) );
		$this->assertEquals( 10, has_action( 'init', array( $this->common, 'materials_init' ) ) );
		$this->assertEquals( 10, has_action( 'init', array( $this->common, 'time_init' ) ) );
	}

	/**
	 * Test that the taxonomies are actually registered
	 */
	function test_common_registers_taxonomies() {
		$taxes = get_taxonomies( array(), 'array' );
		$this->assertTrue( is_array( $taxes ) );
		$this->assertTrue( array_key_exists( 'difficulty', $taxes ) );
		$this->assertTrue( array_key_exists( 'time', $taxes ) );
		$this->assertTrue( array_key_exists( 'materials', $taxes ) );
	}

	/**
	 * Tests that the common class get_taxonomy_list returns array of all the registered taxonomies
	 */
	function test_common_get_taxonomy_list_returns_array() {
		$taxonomy_list = $this->common->get_taxonomy_list();
	 	$this->assertTrue( 3 === count( $taxonomy_list ) );
	 	$this->assertTrue( in_array( 'difficulty', $taxonomy_list, true ) );
	 	$this->assertTrue( in_array( 'time', $taxonomy_list, true ) );
	 	$this->assertTrue( in_array( 'materials', $taxonomy_list, true ) );
	}

	/**
	 * Returns the options created in the plugin.
	 *
	 * @since 0.1-alpha
	 */
	function test_get_settings_returns_settings_array() {
		update_option( $this->common->get_textdomain(), array() );
		$this->assertTrue( is_array( get_option( $this->common->get_textdomain() ) ) );

		update_option( $this->common->get_textdomain(), array(
			'test' => 'test',
		) );
		$this->assertEquals( array(
			'test' => 'test',
		), get_option( $this->common->get_textdomain() ) );
	}


}
