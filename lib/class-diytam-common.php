<?php
/**
 * Class DIYTAM_Common handles functionality used in frontend and admin contexts.
 * Class naming convention due to php 5.3 compatability (no namespace)
 *
 * @package DIY-time-and-materials
 */

<<<<<<< HEAD
if ( ! defined( ABSPATH ) ) { die(); }
=======
if ( ! defined( 'ABSPATH' ) ) { exit(); }
>>>>>>> reset-01

/**
 * Common functionality.
 *
 * @since 0.1-alpha
 */
class DIYTAM_Common extends DIYTAM_Base {

	/**
	 * Array of taxonomies created by this plugin
	 *
	 * @var array $taxonomies the taxonomies created by the plugin.
	 */
	private $taxonomies = array( 'difficulty', 'time', 'materials' );

	/**
	 * Registers all actions with WordPress
	 *
	 * @since 0.1-alpha
	 */
	public function init() {
		add_action( 'init', array( $this, 'difficulty_init' ), 10 );
		add_action( 'init', array( $this, 'materials_init' ), 10 );
		add_action( 'init', array( $this, 'time_init' ), 10 );
	}

	/**
	 * Returns the list of taxonomies created in the plugin.
	 *
	 * @since 0.1-alpha
	 */
	public function get_taxonomy_list() {
		return $this->taxonomies;
	}

	/**
	 * Returns the settings created in the plugin.
	 *
	 * @since 0.1-alpha
	 */
	public function get_settings() {
		return get_option( self::get_textdomain() );
	}

	/**
	 * The difficulty_init function registers the difficult taxonomy within WordPress.
	 *
	 * @since 0.1-alpha
	 */
	public function difficulty_init() {
		register_taxonomy( 'difficulty', array( 'post' ), array(
			'hierarchical'      => false,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => true,
			'capabilities'      => array(
				'manage_terms'  => 'edit_posts',
				'edit_terms'    => 'edit_posts',
				'delete_terms'  => 'edit_posts',
				'assign_terms'  => 'edit_posts',
			),
			'labels'            => array(
				'name'                       => __( 'Difficulty Ratings', 'diy-time-and-materials' ),
				'singular_name'              => _x( 'Difficulty Rating', 'taxonomy general name', 'diy-time-and-materials' ),
				'search_items'               => __( 'Search Difficulty Ratings', 'diy-time-and-materials' ),
				'popular_items'              => __( 'Popular Difficulty Ratings', 'diy-time-and-materials' ),
				'all_items'                  => __( 'All Difficulty Ratings', 'diy-time-and-materials' ),
				'parent_item'                => __( 'Parent Difficulty Rating', 'diy-time-and-materials' ),
				'parent_item_colon'          => __( 'Parent Difficulty Rating:', 'diy-time-and-materials' ),
				'edit_item'                  => __( 'Edit Difficulty Rating', 'diy-time-and-materials' ),
				'update_item'                => __( 'Update Difficulty Rating', 'diy-time-and-materials' ),
				'add_new_item'               => __( 'New Difficulty Rating', 'diy-time-and-materials' ),
				'new_item_name'              => __( 'New Difficulty Rating', 'diy-time-and-materials' ),
				'separate_items_with_commas' => __( 'Difficulty Ratings separated by comma', 'diy-time-and-materials' ),
				'add_or_remove_items'        => __( 'Add or remove Difficulty Ratings', 'diy-time-and-materials' ),
				'choose_from_most_used'      => __( 'Choose from the most used Difficulty Ratings', 'diy-time-and-materials' ),
				'not_found'                  => __( 'No Difficulty Ratings found.', 'diy-time-and-materials' ),
				'menu_name'                  => __( 'Difficulty Ratings', 'diy-time-and-materials' ),
			),
			'show_in_rest'      => true,
			'rest_base'         => 'difficulty',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		) );
	}

	/**
	 * The materials_init function registers the materials taxonomy within WordPress.
	 *
	 @since 0.1-alpha
	 */
	public function materials_init() {
		register_taxonomy( 'materials', array( 'post' ), array(
			'hierarchical'      => false,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => true,
			'capabilities'      => array(
				'manage_terms'  => 'edit_posts',
				'edit_terms'    => 'edit_posts',
				'delete_terms'  => 'edit_posts',
				'assign_terms'  => 'edit_posts',
			),
			'labels'            => array(
				'name'                       => __( 'Materials Costs', 'diy-time-and-materials' ),
				'singular_name'              => _x( 'Materials Cost', 'taxonomy general name', 'diy-time-and-materials' ),
				'search_items'               => __( 'Search Materials Costs', 'diy-time-and-materials' ),
				'popular_items'              => __( 'Popular Materials Costs', 'diy-time-and-materials' ),
				'all_items'                  => __( 'All Materials Costs', 'diy-time-and-materials' ),
				'parent_item'                => __( 'Parent Materials Cost', 'diy-time-and-materials' ),
				'parent_item_colon'          => __( 'Parent Materials Cost:', 'diy-time-and-materials' ),
				'edit_item'                  => __( 'Edit Materials Cost', 'diy-time-and-materials' ),
				'update_item'                => __( 'Update Materials Cost', 'diy-time-and-materials' ),
				'add_new_item'               => __( 'New Materials Cost', 'diy-time-and-materials' ),
				'new_item_name'              => __( 'New Materials Cost', 'diy-time-and-materials' ),
				'separate_items_with_commas' => __( 'Materials Costs separated by comma', 'diy-time-and-materials' ),
				'add_or_remove_items'        => __( 'Add or remove Materials Costs', 'diy-time-and-materials' ),
				'choose_from_most_used'      => __( 'Choose from the most used Materials Costs', 'diy-time-and-materials' ),
				'not_found'                  => __( 'No Materials Costs found.', 'diy-time-and-materials' ),
				'menu_name'                  => __( 'Materials Costs', 'diy-time-and-materials' ),
			),
			'show_in_rest'      => true,
			'rest_base'         => 'materials',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		) );

	}

	/**
	 * The time_init function registers the time taxonomy within WordPress.
	 *
	 @since 0.1-alpha
	 */
	public function time_init() {
		register_taxonomy( 'time', array( 'post' ), array(
			'hierarchical'      => false,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_admin_column' => false,
			'query_var'         => true,
			'rewrite'           => true,
			'capabilities'      => array(
				'manage_terms'  => 'edit_posts',
				'edit_terms'    => 'edit_posts',
				'delete_terms'  => 'edit_posts',
				'assign_terms'  => 'edit_posts',
			),
			'labels'            => array(
				'name'                       => __( 'Time Requireds', 'diy-time-and-materials' ),
				'singular_name'              => _x( 'Time Required', 'taxonomy general name', 'diy-time-and-materials' ),
				'search_items'               => __( 'Search Time Requireds', 'diy-time-and-materials' ),
				'popular_items'              => __( 'Popular Time Requireds', 'diy-time-and-materials' ),
				'all_items'                  => __( 'All Time Requireds', 'diy-time-and-materials' ),
				'parent_item'                => __( 'Parent Time Required', 'diy-time-and-materials' ),
				'parent_item_colon'          => __( 'Parent Time Required:', 'diy-time-and-materials' ),
				'edit_item'                  => __( 'Edit Time Required', 'diy-time-and-materials' ),
				'update_item'                => __( 'Update Time Required', 'diy-time-and-materials' ),
				'add_new_item'               => __( 'New Time Required', 'diy-time-and-materials' ),
				'new_item_name'              => __( 'New Time Required', 'diy-time-and-materials' ),
				'separate_items_with_commas' => __( 'Time Requireds separated by comma', 'diy-time-and-materials' ),
				'add_or_remove_items'        => __( 'Add or remove Time Requireds', 'diy-time-and-materials' ),
				'choose_from_most_used'      => __( 'Choose from the most used Time Requireds', 'diy-time-and-materials' ),
				'not_found'                  => __( 'No Time Requireds found.', 'diy-time-and-materials' ),
				'menu_name'                  => __( 'Time Requireds', 'diy-time-and-materials' ),
			),
			'show_in_rest'      => true,
			'rest_base'         => 'time',
			'rest_controller_class' => 'WP_REST_Terms_Controller',
		) );
	}
}
