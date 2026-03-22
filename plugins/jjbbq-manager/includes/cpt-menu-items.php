<?php
/**
 * Register jjbbq_menu_item Custom Post Type.
 *
 * @package JJBBQ
 */

function jjbbq_register_menu_item_cpt(): void {
    $labels = [
        'name'               => __( 'Menu Items', 'jjbbq' ),
        'singular_name'      => __( 'Menu Item', 'jjbbq' ),
        'add_new'            => __( 'Add New', 'jjbbq' ),
        'add_new_item'       => __( 'Add New Menu Item', 'jjbbq' ),
        'edit_item'          => __( 'Edit Menu Item', 'jjbbq' ),
        'new_item'           => __( 'New Menu Item', 'jjbbq' ),
        'view_item'          => __( 'View Menu Item', 'jjbbq' ),
        'search_items'       => __( 'Search Menu Items', 'jjbbq' ),
        'not_found'          => __( 'No menu items found.', 'jjbbq' ),
        'not_found_in_trash' => __( 'No menu items found in Trash.', 'jjbbq' ),
        'all_items'          => __( 'All Menu Items', 'jjbbq' ),
        'menu_name'          => __( 'Menu Items', 'jjbbq' ),
    ];

    register_post_type( 'jjbbq_menu_item', [
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'show_in_rest'  => true,
        'supports'      => [ 'title', 'thumbnail' ],
        'menu_icon'     => 'dashicons-food',
        'rewrite'       => false,
        'capability_type' => 'post',
        'menu_position' => 6,
    ] );
}
add_action( 'init', 'jjbbq_register_menu_item_cpt' );
