<?php
/**
 * 404 template.
 *
 * @package JJBBQ
 */

get_header();
?>

<main id="main-content" class="site-main">
    <section class="error-404 section-band section-band--dark">
        <div class="container" style="text-align: center; padding: var(--space-xxl) 0;">
            <h1><?php esc_html_e( 'Sold Out.', 'jjbbq' ); ?></h1>
            <p><?php esc_html_e( 'This page is gone — just like our brisket by 1pm.', 'jjbbq' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
                <?php esc_html_e( 'Back to Home', 'jjbbq' ); ?>
            </a>
        </div>
    </section>
</main>

<?php
get_footer();
