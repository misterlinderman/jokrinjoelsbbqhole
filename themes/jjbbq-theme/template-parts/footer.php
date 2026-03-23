<?php
/**
 * Template part: Site footer.
 *
 * @package JJBBQ
 */

$instagram_url = jjbbq_option( 'instagram_url', '' );
$facebook_url  = jjbbq_option( 'facebook_url', '' );
$footer_logo      = get_theme_file_uri( 'reference-images/logo-primary.png' );
?>

<footer class="site-footer" role="contentinfo">
    <div class="container footer-inner">

        <div class="footer-brand">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-brand__logo-link">
                <img
                    src="<?php echo esc_url( $footer_logo ); ?>"
                    alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                    class="footer__logo"
                    width="120"
                    height="120"
                    loading="lazy"
                    decoding="async"
                />
            </a>
            <p class="footer__tagline"><?php esc_html_e( 'Pop-up BBQ. Sell-out quality.', 'jjbbq' ); ?></p>
        </div>

        <div class="footer-nav">
            <h4><?php esc_html_e( 'Quick Links', 'jjbbq' ); ?></h4>
            <?php
            wp_nav_menu( [
                'theme_location' => 'footer',
                'container'      => false,
                'fallback_cb'    => false,
                'depth'          => 1,
            ] );
            ?>
        </div>

        <div class="footer-social">
            <h4><?php esc_html_e( 'Follow the Smoke', 'jjbbq' ); ?></h4>
            <?php if ( $instagram_url ) : ?>
                <a
                    href="<?php echo esc_url( $instagram_url ); ?>"
                    class="footer__social-link"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="<?php esc_attr_e( "Follow Jorkin' Joel's on Instagram", 'jjbbq' ); ?>"
                >
                    <?php esc_html_e( 'Follow the Smoke on Instagram ↗', 'jjbbq' ); ?>
                </a>
            <?php endif; ?>

            <?php if ( $facebook_url ) : ?>
                <div class="social-links">
                    <a href="<?php echo esc_url( $facebook_url ); ?>"
                       class="social-link"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="<?php esc_attr_e( 'Follow us on Facebook', 'jjbbq' ); ?>">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Facebook
                    </a>
                </div>
            <?php endif; ?>

            <p><?php esc_html_e( 'Follow for pop-up announcements.', 'jjbbq' ); ?></p>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Built with smoke and pixels.', 'jjbbq' ); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
