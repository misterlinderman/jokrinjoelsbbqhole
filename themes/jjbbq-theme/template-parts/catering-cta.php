<?php
/**
 * Template part: Catering call-to-action band.
 *
 * @package JJBBQ
 */

$cta_headline = jjbbq_option( 'catering_cta_text' );
?>

<section class="catering-cta" aria-label="<?php esc_attr_e( 'Catering', 'jjbbq' ); ?>">
    <div class="container">
        <h2><?php echo esc_html( $cta_headline ); ?></h2>
        <p><?php esc_html_e( "Catering available for events big and small. Let's talk.", 'jjbbq' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/catering/' ) ); ?>" class="btn-secondary">
            <?php esc_html_e( 'Get a Catering Quote', 'jjbbq' ); ?>
        </a>
    </div>
</section>
