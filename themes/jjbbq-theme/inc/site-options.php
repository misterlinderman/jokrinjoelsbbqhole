<?php
/**
 * Read JJBBQ site options (saved under JJBBQ → Site Settings in wp-admin).
 *
 * @package JJBBQ
 */

/**
 * Get a JJBBQ site option (stored as jjbbq_{$key} in wp_options).
 *
 * @param string     $key     Short key, e.g. instagram_url (becomes jjbbq_instagram_url).
 * @param mixed|null $default Default if empty; null uses built-in defaults for known keys.
 * @return mixed
 */
function jjbbq_option( string $key, $default = null ) {
    $built_in = [
        'hero_headline'      => __( 'Pop-Up BBQ. Sell-Out Quality.', 'jjbbq' ),
        'hero_subhead'       => __( 'Smoked in Omaha. Gone before you know it.', 'jjbbq' ),
        'catering_cta_text'  => __( 'Feed Your Crew', 'jjbbq' ),
    ];

    $opt_key = 'jjbbq_' . $key;
    $value   = get_option( $opt_key, null );

    if ( $value !== null && $value !== false && $value !== '' ) {
        return $value;
    }

    if ( $default !== null ) {
        return $default;
    }

    return $built_in[ $key ] ?? '';
}

/**
 * Labels for Menu page tabs (merge saved labels from JJBBQ → Menu Page Tabs).
 *
 * @return array<string, string> slug => label
 */
function jjbbq_get_menu_tab_categories(): array {
    $defaults = [
        'core'      => __( 'Core Menu', 'jjbbq' ),
        'specialty' => __( 'Specialty Items', 'jjbbq' ),
        'sides'     => __( 'Sides', 'jjbbq' ),
        'collab'    => __( 'Collaborations', 'jjbbq' ),
    ];

    $saved = get_option( 'jjbbq_menu_categories', [] );
    if ( ! is_array( $saved ) ) {
        $saved = [];
    }

    foreach ( $defaults as $slug => $label ) {
        if ( isset( $saved[ $slug ] ) && $saved[ $slug ] !== '' ) {
            $defaults[ $slug ] = $saved[ $slug ];
        }
    }

    return $defaults;
}

/**
 * Gravity Form ID for catering page, or 0 to use built-in form.
 */
function jjbbq_catering_gravity_form_id(): int {
    return (int) get_option( 'jjbbq_catering_gravity_form_id', 0 );
}
