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
		// Envoke the base class.
		$this->base = new DIYTAM_Base;
		// Envoke the admin class.
		$this->admin = new DIYTAM_Admin;
		/** Since this class is loaded "conditionally" in WordPress
		 * I must call init manually to be able to test it
		 */
		$this->admin->init();

		$user_id = $this->factory->user->create( array(
			'role' => 'administrator',
		) );
		$user = wp_set_current_user( $user_id );
		set_current_screen( 'edit-post' );
	}

	/**
	 * Test that the admin class is an instance of base.
	 */
	function test_admin_extends_base() {
		$this->assertEquals( 'DIYTAM_Common', get_parent_class( 'DIYTAM_Admin' ) );
	}

	/**
	 * Test that the admin get version returns parent ver version.
	 */
	function test_admin_get_version() {
		$this->assertEquals( $this->base->version, $this->admin->get_version() );
	}

	/**
	 * Test that the admin get textdomain works.
	 */
	function test_admin_get_textdomain() {
		$this->assertEquals( $this->base->textdomain, $this->admin->get_textdomain() );
	}

	/**
	 * Tests if the admin setting is is added.
	 */
	function test_admin_init_registers_setting_function() {
		$this->assertEquals( 10, has_action( 'admin_init', array( $this->admin, 'register_settings' ) ) );
	}

	/**
	 * Test that register setting does its job
	 */
	function test_admin_register_setting_registers_setting() {
		$this->admin->register_settings();

	 	$settings = get_registered_settings();
	 	$this->assertArrayHasKey( 'diy-time-and-materials', $settings );
	}

	 /**
	  * Tests if the admin menu is is added.
	  */
	function test_admin_init_registers_menu_function() {
		$this->assertEquals( 10, has_action( 'admin_menu', array( $this->admin, 'register_menu' ) ) );
	}

	/**
	 * Not a testible solution
	 *
	 * @todo: find a way to add unit test coverage here.
	 */
	function test_admin_register_menu_adds_menu_page() {
		// Can't quite fiture out how to unit test this.
		// perhaps try regex ~DIY Time and Materials Options.
	}
	/**
	 * Test the setting section outputs something
	 */
	function test_setting_sections_exist() {
		$section_html = ob_start();
		do_settings_sections( 'diy-time-and-materials' );
		$out = ob_get_clean();

		$this->assertTrue( 0 !== strlen( $out ) );
	}
	/**
	 * Check that the settings section has a heading
	 */
	function test_setting_sections_has_heading() {
		$section_html = ob_start();
		do_settings_sections( 'diy-time-and-materials' );
		$out = ob_get_clean();

		$this->assertRegExp( '/<h2>/' , $out );
		$this->assertRegExp( '/Adjust the time and materials appearance to your liking by configuring the options below./' , $out );
		$this->assertRegExp( '/<\/h2>/' , $out );
	}

	/**
	 * Check that the settings section has color field
	 */
	function test_setting_sections_has_color_field() {
		$section_html = ob_start();
		do_settings_sections( 'diy-time-and-materials' );
		$out = ob_get_clean();

		$this->assertRegExp( '/<th scope="row">/' , $out );
		$this->assertRegExp( '/Set the color of the text./' , $out );
		$this->assertRegExp( '/<\/th>/' , $out );
	}

	/**
	 * Check that the settings section has font awesome field
	 */
	function test_setting_sections_has_fa_field() {
		$section_html = ob_start();
		do_settings_sections( 'diy-time-and-materials' );
		$out = ob_get_clean();

		$this->assertRegExp( '/<th scope="row">/' , $out );
		$this->assertRegExp( '/Check to enable Font Awesome./' , $out );
		$this->assertRegExp( '/<\/th>/' , $out );
	}
	/**
	 * Test the validation when invalid
	 */
	function test_admin_validation_returns_empty_array_if_invalid() {
		$test = array(
			'foo' => 'bar',
		);
		$this->assertEquals( array() , $this->admin->validate_settings( $test ) );
	}

	/**
	 * Test the validation when color set
	 */
	function test_admin_validation_returns_color_array_when_color_set() {
		$test = array(
			'color' => 'blue',
		);
		$this->assertArrayHasKey( 'color', $this->admin->validate_settings( $test ) );
	}

	/**
	 * Test the validation when font awesome set
	 */
	function test_admin_validation_returns_color_array_when_font_awesome_set() {
		$test = array(
			'enable_font_awesome' => true,
		);
		$this->assertArrayHasKey( 'enable_font_awesome', $this->admin->validate_settings( $test ) );
	}

	/**
	 * Test the validation when color and font awesome set
	 */
	function test_admin_validation_returns_color_array_when_color_and_font_awesome_set() {
		$test = array(
			'color' => 'blue',
			'enable_font_awesome' => true,
		);
		$this->assertArrayHasKey( 'color', $this->admin->validate_settings( $test ) );
		$this->assertArrayHasKey( 'enable_font_awesome', $this->admin->validate_settings( $test ) );
	}
}
