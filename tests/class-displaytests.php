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
		$this->base = new DIYTAM_Base;
		$this->display = new DIYTAM_Display;
		/** Since this class is loaded "conditionally" in WordPress
		 * I must call init manually to be able to test it
		 */
		$this->display->init();
	}

	/**
	 * Test that the display class is an instance of base.
	 */
	function test_display_extends_base() {
		$this->assertEquals( 'DIYTAM_Common', get_parent_class( 'DIYTAM_Display' ) );
	}

	/**
	 * Test that the display get version returns parent ver version.
	 */
	function test_display_get_version() {
		// Test that display get version returns the base version.
		$this->assertEquals( $this->base->version, $this->display->get_version() );
	}

	/**
	 * Test that the display get textdomain works.
	 */
	function test_display_get_textdomain() {
		// Test that display get version returns the same as the base version.
		$this->assertEquals( $this->base->textdomain, $this->display->get_textdomain() );
	}

	/**
	 * Test that the display class adds a filter to the content
	 */
	function test_display_adds_content_filter() {
		$this->assertEquals( 10, has_filter( 'the_content', array( $this->display, 'display_content' ) ) );
	}

	/**
	 * Test that the display_content function returns content
	 */
	function test_display_content_returns_content() {
		$test_content = 'This is an example of a test content.';
		$this->assertEquals( $test_content, $this->display->display_content( $test_content ) );
	}

	/**
	 * Test that the has_term function returns false if empty taxonomy
	 */
	function test_display_has_terms_returns_false_if_no_term_passed() {
		$this->assertFalse( $this->display->has_terms() );
	}

	/**
	 * Test that the has_term function returns false if invalid taxonomy
	 */
	function test_display_has_terms_returns_false_term_invalid() {
		$this->assertFalse( $this->display->has_terms( 'foo' ) );
	}

	/**
	 * Test that the has_term function returns false if not on a single post
	 */
	function test_display_has_terms_returns_false_if_not_single() {
		$post = wp_insert_post( array(
			'post_title'    => 'test page',
			'post_status'   => 'publish',
			'post_type'     => 'page',
			'post_content'  => 'example page.',
		) );

		$this->go_to( get_permalink( $post ) );
		$this->assertTrue( is_page() );
		$this->assertFalse( $this->display->has_terms( 'difficulty' ) );
		$this->assertFalse( $this->display->has_terms( 'time' ) );
		$this->assertFalse( $this->display->has_terms( 'materials' ) );
	}

	/**
	 * Test that the has_term function returns false if no terms for post
	 */
	function test_display_has_terms_returns_false_when_no_terms() {
		$post = wp_insert_post( array(
			'post_title'    => 'test post with no difficulty terms',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => 'example with no difficulty terms.',
		) );

		$this->go_to( get_permalink( $post ) );
		$this->assertFalse( $this->display->has_terms( 'difficulty' ) );
		$this->assertFalse( $this->display->has_terms( 'time' ) );
		$this->assertFalse( $this->display->has_terms( 'materials' ) );

	}

	/**
	 * Test that the has_term function returns true when terms exist in taxonomy
	 */
	function test_display_has_terms_returns_true_when_terms() {
		$post = wp_insert_post( array(
			'post_title'    => 'test post with no difficulty terms',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => 'example with no difficulty terms.',
		) );

		wp_set_object_terms( $post, 'test difficulty', 'difficulty' );
		wp_set_object_terms( $post, 'test time', 'time' );
		wp_set_object_terms( $post, 'test materials', 'materials' );

		$this->go_to( get_permalink( $post ) );

		$this->assertTrue( $this->display->has_terms( 'difficulty' ) );
		$this->assertTrue( $this->display->has_terms( 'time' ) );
		$this->assertTrue( $this->display->has_terms( 'materials' ) );
	}

	/**
	 * Test that the display_terms function returns the content when no terms are set.
	 */
	function test_display_terms_does_nothing_if_no_has_terms() {
		$test_post_content = 'example with no terms.';
		$post = wp_insert_post( array(
			'post_title'    => 'test post with no terms',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => $test_post_content,
		) );

		$content = $this->display->display_content( $test_post_content );
		$this->assertEquals( $test_post_content, $content );
	}
	/**
	 * Tests that terms return an array
	 */
	function test_get_terms_returns_array_of_terms_if_exist() {
		$post = wp_insert_post( array(
			'post_title'    => 'test post with many terms',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => 'example with many terms.',
		) );

		wp_set_object_terms( $post, 'd1', 'difficulty' );
		wp_set_object_terms( $post, 't1', 'time' );
		wp_set_object_terms( $post, 'm1', 'materials' );

		$this->go_to( get_permalink( $post ) );
		$this->assertTrue( is_array( $this->display->get_terms( 'difficulty' ) ) );
		$this->assertTrue( 'd1' === $this->display->get_terms( 'difficulty' )[0]->name );
		$this->assertTrue( is_array( $this->display->get_terms( 'time' ) ) );
		$this->assertTrue( 't1' === $this->display->get_terms( 'time' )[0]->name );
		$this->assertTrue( is_array( $this->display->get_terms( 'materials' ) ) );
		$this->assertTrue( 'm1' === $this->display->get_terms( 'materials' )[0]->name );
	}

	/**
	 * Test if spans are output when a term is set.
	 */
	function test_display_list_terms_prints_spans_for_single_term_if_set() {
		$post = wp_insert_post( array(
			'post_title'    => 'test post with one term',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => 'example with one term.',
		) );

		wp_set_object_terms( $post, 'hard', 'difficulty' );
		wp_set_object_terms( $post, '4 hours', 'time' );
		wp_set_object_terms( $post, 'hot glue', 'materials' );
		$this->go_to( get_permalink( $post ) );

		$content = $this->display->list_terms( 'difficulty' );
		$this->assertEquals( '<span class="diy-tam diy-tam-difficulty">Difficulty: hard</span>', $content );

		$content = $this->display->list_terms( 'time' );
		$this->assertEquals( '<span class="diy-tam diy-tam-time">Time: 4 hours</span>', $content );

		$content = $this->display->list_terms( 'materials' );
		$this->assertEquals( '<span class="diy-tam diy-tam-materials">Materials: hot glue</span>', $content );
	}

	/**
	 * Test if multiple termms are output when more than one term is set.
	 */
	function test_display_list_terms_prints_spans_for_multiple_terms_if_set() {
		$post = wp_insert_post( array(
			'post_title'    => 'test post with more than one term',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => 'example with more than one term.',
		) );

		wp_set_object_terms( $post, array( 'moderate', '5+' ), 'difficulty' );
		wp_set_object_terms( $post, array( '1 day', '4 hours' ), 'time' );
		wp_set_object_terms( $post, array( 'hammer', 'hot glue' ), 'materials' );
		$this->go_to( get_permalink( $post ) );

		$content = $this->display->list_terms( 'difficulty' );
		$this->assertEquals( '<span class="diy-tam diy-tam-difficulty">Difficulty: 5+, moderate</span>', $content );

		$content = $this->display->list_terms( 'time' );
		$this->assertEquals( '<span class="diy-tam diy-tam-time">Time: 1 day, 4 hours</span>', $content );

		$content = $this->display->list_terms( 'materials' );
		$this->assertEquals( '<span class="diy-tam diy-tam-materials">Materials: hammer, hot glue</span>', $content );
	}
	/**
	 * Test that the display_terms function returns a list when terms are set
	 */
	function test_display_terms_shows_terms_before_content() {
		$test_post_content = 'example with terms.';
		$post = wp_insert_post( array(
			'post_title'    => 'test post with terms',
			'post_status'   => 'publish',
			'post_type'     => 'post',
			'post_content'  => $test_post_content,
		) );

		wp_set_object_terms( $post, 'easy', 'difficulty' );
		$this->go_to( get_permalink( $post ) );

		$term_markup_before = $this->display->list_terms( 'difficulty' );

		$this->assertEquals( '<span class="diy-tam diy-tam-difficulty">Difficulty: easy</span>', $term_markup_before );

		$content = $this->display->display_content( $test_post_content );
		$this->assertEquals( $term_markup_before . $test_post_content, $content );
	}
	/**
	 * Tests if the output css is added.
	 */
	function test_display_terms_outputs_css_inline() {
		$this->assertEquals( 10, has_action( 'wp_print_scripts', array( $this->display, 'print_css' ) ) );
	}
	/**
	 * Tests if the output css includes style tags.
	 */
	function test_display_print_css_outputs_css() {
		$this->assertRegExp( '/<style type="text\/css">/' , $this->display->print_css( true ) );
		$this->assertRegExp( '/<\/style>/' , $this->display->print_css( true ) );
	}

	/**
	 * Tests if the color filter works
	 */
	function test_display_get_color_returns_false_if_not_set() {
		$this->assertFalse( $this->display->get_color() );
	}

	/**
	 * Tests if the color filter works
	 */
	function test_display_get_color_returns_color_if_set() {
		update_option( $this->base->textdomain, array(
			'color' => '#f5f5f5',
		) );
		$this->assertEquals( '#f5f5f5', $this->display->get_color() );
	}

	/**
	 * Tests if the css custom color is over-ridable by filter
	 */
	function test_display_print_css_override_color_with_filter() {
		update_option( $this->display->get_textdomain(), array( 'color', '#f5f5f5' ) );
		add_filter( 'diy_tam_color', function() {
			return '#444444';
		}, 10);
		$this->assertRegExp( '/color:#444444;/' , $this->display->print_css( true ) );
	}

	/**
	 * Tests if the css custom color is set by option
	 */
	function test_display_print_css_includes_color_if_set() {
		update_option( $this->display->get_textdomain(), array(
			'color' => '#f5f5f5',
		) );
		$this->assertRegExp( '/color:#f5f5f5;/' , $this->display->print_css( true ) );

		delete_option( $this->display->get_textdomain() );
		$this->assertNotRegExp( '/color:/' , $this->display->print_css( true ) );
	}
	
	/**
	 * Test is Font Awesome is enqueued if option set
	 */
	 function test_font_awesome_support_if_option_set() {
	 	global $wp_scripts;
	 	echo var_dump( $wp_scripts );
	 	
	 }
}
