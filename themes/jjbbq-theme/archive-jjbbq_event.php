<?php
/**
 * Pop-Up Events archive template.
 *
 * @package JJBBQ
 */

get_header();

$upcoming = function_exists( 'jjbbq_get_upcoming_events' ) ? jjbbq_get_upcoming_events( 20 ) : null;
$past     = function_exists( 'jjbbq_get_past_events' ) ? jjbbq_get_past_events( 20 ) : null;
$instagram_url    = jjbbq_option( 'instagram_url', '' );
$instagram_handle = jjbbq_option( 'instagram_handle', '' );
?>

<main id="main-content" class="site-main">

    <section class="section-band section-band--red">
        <div class="container" style="text-align: center;">
            <h1><?php esc_html_e( 'Pop-Up Schedule', 'jjbbq' ); ?></h1>
        </div>
    </section>

    <section class="events-archive">
        <div class="container">

            <!-- Upcoming Events -->
            <div class="events-section">
                <h2><?php esc_html_e( 'Upcoming Events', 'jjbbq' ); ?></h2>

                <?php if ( $upcoming && $upcoming->have_posts() ) : ?>
                    <div class="grid-2">
                        <?php while ( $upcoming->have_posts() ) : $upcoming->the_post(); ?>
                            <div class="event-card event-card--upcoming">
                                <span class="badge badge--upcoming"><?php esc_html_e( 'Upcoming', 'jjbbq' ); ?></span>
                                <div class="event-card__date">
                                    <?php echo esc_html( jjbbq_format_event_date( get_the_ID() ) ); ?>
                                </div>
                                <div class="event-card__venue">
                                    <?php echo esc_html( get_field( 'event_venue' ) ?: '' ); ?>
                                </div>
                                <?php $address = get_field( 'event_address' ); ?>
                                <?php if ( $address ) : ?>
                                    <div class="event-card__address"><?php echo esc_html( $address ); ?></div>
                                <?php endif; ?>
                                <?php $time = get_field( 'event_time' ); ?>
                                <?php if ( $time ) : ?>
                                    <div class="event-card__time"><?php echo esc_html( $time ); ?></div>
                                <?php endif; ?>
                                <?php $partner = get_field( 'event_partner' ); ?>
                                <?php if ( $partner ) : ?>
                                    <div class="next-popup__partner">
                                        <?php
                                        /* translators: %s: partner name */
                                        printf( esc_html__( 'Featuring %s', 'jjbbq' ), esc_html( $partner ) );
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <?php $flyer_id = get_field( 'event_flyer' ); ?>
                                <?php if ( $flyer_id ) : ?>
                                    <div style="margin-top: var(--space-md);">
                                        <?php echo wp_get_attachment_image( $flyer_id, 'event-thumb', false, [
                                            'alt'     => get_the_title(),
                                            'loading' => 'lazy',
                                        ] ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p>
                        <?php esc_html_e( 'No upcoming dates announced yet.', 'jjbbq' ); ?>
                        <?php if ( $instagram_url ) : ?>
                            <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer">
                                <?php
                                if ( $instagram_handle ) {
                                    /* translators: %s: Instagram handle */
                                    printf( esc_html__( 'Follow @%s on Instagram.', 'jjbbq' ), esc_html( $instagram_handle ) );
                                } else {
                                    esc_html_e( 'Follow us on Instagram.', 'jjbbq' );
                                }
                                ?>
                            </a>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Past Events -->
            <div class="events-section">
                <h2><?php esc_html_e( 'Past Events', 'jjbbq' ); ?></h2>

                <?php if ( $past && $past->have_posts() ) : ?>
                    <div class="past-events-list">
                        <?php while ( $past->have_posts() ) : $past->the_post(); ?>
                            <div class="past-event">
                                <span class="past-event__venue">
                                    <?php echo esc_html( get_field( 'event_venue' ) ?: get_the_title() ); ?>
                                </span>
                                <span class="past-event__date">
                                    <?php echo esc_html( jjbbq_format_event_date( get_the_ID() ) ); ?>
                                </span>
                                <span class="badge badge--sold-out">
                                    <?php esc_html_e( 'Sold Out', 'jjbbq' ); ?> &#10003;
                                </span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'No past events yet — we\'re just getting started.', 'jjbbq' ); ?></p>
                <?php endif; ?>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
