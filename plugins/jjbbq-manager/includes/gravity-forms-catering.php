<?php
/**
 * Gravity Forms: catering form uses Legacy theme markup and skips Orbital CSS variables.
 *
 * @package JJBBQ
 */

/**
 * Force Legacy theme slug for the configured catering form on the front end.
 *
 * @param string $slug Current theme slug.
 * @param array  $form Form object.
 * @return string
 */
function jjbbq_gform_catering_theme_slug( string $slug, $form ): string {
    if ( ! is_array( $form ) ) {
        return $slug;
    }
    if ( is_admin() && ! wp_doing_ajax() ) {
        return $slug;
    }
    $cid = (int) get_option( 'jjbbq_catering_gravity_form_id', 0 );
    if ( $cid && (int) rgar( $form, 'id' ) === $cid ) {
        return 'legacy';
    }
    return $slug;
}
add_filter( 'gform_form_theme_slug', 'jjbbq_gform_catering_theme_slug', 50, 2 );
