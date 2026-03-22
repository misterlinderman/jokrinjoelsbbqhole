<?php
/**
 * Handle catering inquiry form submissions.
 *
 * @package JJBBQ
 */

function jjbbq_handle_catering_form(): void {
    if ( ! isset( $_POST['jjbbq_catering_nonce'] ) ||
         ! wp_verify_nonce( $_POST['jjbbq_catering_nonce'], 'jjbbq_catering' ) ) {
        wp_die( __( 'Security check failed.', 'jjbbq' ) );
    }

    $name    = sanitize_text_field( $_POST['catering_name'] ?? '' );
    $email   = sanitize_email( $_POST['catering_email'] ?? '' );
    $phone   = sanitize_text_field( $_POST['catering_phone'] ?? '' );
    $date    = sanitize_text_field( $_POST['catering_date'] ?? '' );
    $guests  = absint( $_POST['catering_guests'] ?? 0 );
    $type    = sanitize_text_field( $_POST['catering_type'] ?? '' );
    $message = sanitize_textarea_field( $_POST['catering_message'] ?? '' );

    if ( ! $name || ! $email ) {
        wp_safe_redirect( wp_get_referer() ?: home_url() );
        exit;
    }

    $admin_email = get_theme_mod( 'jjbbq_contact_email', get_option( 'admin_email' ) );

    $subject = sprintf(
        /* translators: %s: person name */
        __( 'Catering Inquiry from %s', 'jjbbq' ),
        $name
    );

    $body  = __( 'New catering inquiry:', 'jjbbq' ) . "\n\n";
    $body .= __( 'Name:', 'jjbbq' ) . " {$name}\n";
    $body .= __( 'Email:', 'jjbbq' ) . " {$email}\n";
    if ( $phone )  $body .= __( 'Phone:', 'jjbbq' ) . " {$phone}\n";
    if ( $date )   $body .= __( 'Event Date:', 'jjbbq' ) . " {$date}\n";
    if ( $guests ) $body .= __( 'Guests:', 'jjbbq' ) . " {$guests}\n";
    if ( $type )   $body .= __( 'Type:', 'jjbbq' ) . " {$type}\n";
    if ( $message ) {
        $body .= "\n" . __( 'Message:', 'jjbbq' ) . "\n{$message}\n";
    }

    $headers = [ "Reply-To: {$name} <{$email}>" ];

    wp_mail( $admin_email, $subject, $body, $headers );

    $redirect = add_query_arg( 'catering_sent', '1', wp_get_referer() ?: home_url( '/catering/' ) );
    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'admin_post_jjbbq_catering_inquiry', 'jjbbq_handle_catering_form' );
add_action( 'admin_post_nopriv_jjbbq_catering_inquiry', 'jjbbq_handle_catering_form' );
