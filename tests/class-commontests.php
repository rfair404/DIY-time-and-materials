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
	function test_common_registers_taxonomies() {
		$this->assertEquals( 10, has_action('init', array( $this->common , 'difficulty_init') ) );
		$this->assertEquals( 10, has_action('init', array( $this->common , 'materials_init') ) );
		$this->assertEquals( 10, has_action('init', array( $this->common , 'time_init') ) );

		
		
		// $this->assertEquals( 10, has_action( 'init', array( 'DIYTAM_Common', 'difficulty_init' ) ) );
		
		// $taxes = get_taxonomies( array(), 'array' );
		
		// $this->assertTrue( is_array( $taxes ) );
	
		// $this->assertTrue( array_key_exists( 'difficulty', $taxes ) );
	}
}
