<?php
//add custom post type

// Register Custom Post Type
function hhd_owlcrs() {

	$labels = array(
		'name'                  => _x( 'Custom carousel', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Custom carousel', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Custom carousel', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Item Carousels', 'text_domain' ),
		'add_new_item'          => __( 'Add New Carousels', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item Carousels', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Images slider', 'text_domain' ),
		'set_featured_image'    => __( 'Set images slider', 'text_domain' ),
		'remove_featured_image' => __( 'Delete images', 'text_domain' ),
		'use_featured_image'    => __( 'Set images carousels', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Custom carousel', 'text_domain' ),
		'description'           => __( 'Custom carousel', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'hhd_owlcrs', $args );

}
add_action( 'init', 'hhd_owlcrs', 0 );

// Adding a taxonomy for the carousel post type
function hhd_carousel_taxonomy() {
	$args = array('hierarchical' => true);
	register_taxonomy( 'hhd_carousel_category', 'hhd_owlcrs', $args );
}
add_action( 'init', 'hhd_carousel_taxonomy', 0 );