<?php
/**
 * Functions relative to the difficulty taxonomy.
 *
 * @package DIY-time-and-materials/
 */

/**
 * The difficulty_init function registers the difficult taxonomy within WordPress.
 */
function difficulty_init() {
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
add_action( 'init', 'difficulty_init' );
