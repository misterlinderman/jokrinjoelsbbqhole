<?php
/**
 * Register jjbbq_event Custom Post Type.
 *
 * @package JJBBQ
 */

function jjbbq_register_event_cpt(): void {
    $labels = [
        'name'               => __( 'Pop-Up Events', 'jjbbq' ),
        'singular_name'      => __( 'Pop-Up Event', 'jjbbq' ),
        'add_new'            => __( 'Add New', 'jjbbq' ),
        'add_new_item'       => __( 'Add New Pop-Up Event', 'jjbbq' ),
        'edit_item'          => __( 'Edit Pop-Up Event', 'jjbbq' ),
        'new_item'           => __( 'New Pop-Up Event', 'jjbbq' ),
        'view_item'          => __( 'View Pop-Up Event', 'jjbbq' ),
        'search_items'       => __( 'Search Pop-Up Events', 'jjbbq' ),
        'not_found'          => __( 'No pop-up events found.', 'jjbbq' ),
        'not_found_in_trash' => __( 'No pop-up events found in Trash.', 'jjbbq' ),
        'all_items'          => __( 'All Pop-Up Events', 'jjbbq' ),
        'menu_name'          => __( 'Pop-Up Events', 'jjbbq' ),
    ];

    register_post_type( 'jjbbq_event', [
        'labels'        => $labels,
        'public'        => true,
        'show_in_rest'  => true,
        'has_archive'   => true,
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
        'menu_icon'     => 'dashicons-calendar-alt',
        'rewrite'       => [ 'slug' => 'pop-ups' ],
        'capability_type' => 'post',
        'menu_position' => 5,
    ] );
}
add_action( 'init', 'jjbbq_register_event_cpt' );
