<?php
/**
 * Enqueue scripts and styles.
 *
 * @package JJBBQ
 */

function jjbbq_enqueue_assets(): void {
    $version = JJBBQ_THEME_VERSION;

    wp_enqueue_style(
        'jjbbq-main',
        JJBBQ_THEME_URI . '/assets/css/main.css',
        [],
        $version
    );

    wp_enqueue_script(
        'jjbbq-nav',
        JJBBQ_THEME_URI . '/assets/js/nav.js',
        [],
        $version,
        true
    );

    wp_enqueue_script(
        'jjbbq-main',
        JJBBQ_THEME_URI . '/assets/js/main.js',
        [ 'jjbbq-nav' ],
        $version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'jjbbq_enqueue_assets' );
