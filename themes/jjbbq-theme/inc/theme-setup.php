<?php
/**
 * Theme setup — supports, menus, image sizes.
 *
 * @package JJBBQ
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function jjbbq_theme_setup(): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', [
        'height'      => 200,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'jjbbq' ),
        'footer'  => __( 'Footer Navigation', 'jjbbq' ),
    ] );

    add_image_size( 'event-thumb', 800, 600, true );
    add_image_size( 'event-hero', 1600, 800, true );
}
add_action( 'after_setup_theme', 'jjbbq_theme_setup' );

/**
 * Add preconnect for Google Fonts.
 */
function jjbbq_preconnect_google_fonts(): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'jjbbq_preconnect_google_fonts', 1 );
