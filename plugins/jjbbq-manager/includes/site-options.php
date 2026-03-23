<?php
/**
 * Site-wide options (replaces Customizer for JJBBQ settings).
 *
 * @package JJBBQ
 */

/**
 * Migrate legacy theme_mod values to options once.
 */
function jjbbq_migrate_theme_mods_to_options(): void {
    if ( get_option( 'jjbbq_theme_mods_migrated' ) ) {
        return;
    }

    $keys = [
        'jjbbq_instagram_handle',
        'jjbbq_instagram_url',
        'jjbbq_facebook_url',
        'jjbbq_contact_email',
        'jjbbq_contact_phone',
        'jjbbq_hero_headline',
        'jjbbq_hero_subhead',
        'jjbbq_catering_cta_text',
    ];

    foreach ( $keys as $key ) {
        $mod = get_theme_mod( $key );
        if ( $mod === false || $mod === '' ) {
            continue;
        }
        $current = get_option( $key, '' );
        if ( $current === false || $current === '' ) {
            update_option( $key, $mod );
        }
    }

    update_option( 'jjbbq_theme_mods_migrated', 1 );
}
add_action( 'admin_init', 'jjbbq_migrate_theme_mods_to_options', 5 );
