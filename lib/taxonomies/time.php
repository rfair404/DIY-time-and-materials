<?php

function time_init() {
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
			'assign_terms'  => 'edit_posts'
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
add_action( 'init', 'time_init' );
