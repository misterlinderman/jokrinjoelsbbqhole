<?php
/**
 * Template part: Next Pop-Up section.
 *
 * @package JJBBQ
 */

$next_event    = function_exists( 'jjbbq_get_next_event' ) ? jjbbq_get_next_event() : null;
$instagram_url = jjbbq_option( 'instagram_url', '' );
?>

<section id="find-the-truck" class="next-popup" aria-label="<?php esc_attr_e( 'Next Pop-Up', 'jjbbq' ); ?>">
    <div class="container">
        <h2><?php esc_html_e( 'Next Pop-Up', 'jjbbq' ); ?></h2>

        <?php if ( $next_event ) : ?>
            <div class="next-popup__card">
                <div class="next-popup__date">
                    <?php echo esc_html( jjbbq_format_event_date( $next_event->ID ) ); ?>
                </div>

                <div class="next-popup__venue">
                    <?php echo esc_html( get_field( 'event_venue', $next_event->ID ) ?: '' ); ?>
                </div>

                <?php $address = get_field( 'event_address', $next_event->ID ); ?>
                <?php if ( $address ) : ?>
                    <div class="next-popup__detail">
                        <?php echo esc_html( $address ); ?>
                    </div>
                <?php endif; ?>

                <?php $time = get_field( 'event_time', $next_event->ID ); ?>
                <?php if ( $time ) : ?>
                    <div class="next-popup__detail">
                        <?php echo esc_html( $time ); ?>
                    </div>
                <?php endif; ?>

                <?php $partner = get_field( 'event_partner', $next_event->ID ); ?>
                <?php if ( $partner ) : ?>
                    <div class="next-popup__partner">
                        <?php
                        /* translators: %s: partner name */
                        printf( esc_html__( 'Featuring %s', 'jjbbq' ), esc_html( $partner ) );
                        ?>
                    </div>
                <?php endif; ?>

                <?php $flyer_id = get_field( 'event_flyer', $next_event->ID ); ?>
                <?php if ( $flyer_id ) : ?>
                    <div class="next-popup__flyer">
                        <?php echo wp_get_attachment_image( $flyer_id, 'event-hero', false, [
                            'alt'     => get_the_title( $next_event->ID ),
                            'loading' => 'lazy',
                        ] ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $instagram_url ) : ?>
                <p style="margin-top: var(--space-lg);">
                    <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer">
                        <?php esc_html_e( 'More Pop-Ups Coming — Follow on Instagram', 'jjbbq' ); ?>
                    </a>
                </p>
            <?php endif; ?>

        <?php else : ?>
            <div class="next-popup__fallback">
                <p>
                    <?php if ( $instagram_url ) : ?>
                        <?php esc_html_e( 'No upcoming dates announced yet.', 'jjbbq' ); ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e( 'Follow us on Instagram to be first.', 'jjbbq' ); ?>
                        </a>
                    <?php else : ?>
                        <?php esc_html_e( 'No upcoming dates announced yet. Follow us on Instagram for the next date announcement.', 'jjbbq' ); ?>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>
