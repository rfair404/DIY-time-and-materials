<?php

function materials_init() {
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
			'assign_terms'  => 'edit_posts'
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
add_action( 'init', 'materials_init' );
