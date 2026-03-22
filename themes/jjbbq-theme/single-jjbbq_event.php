<?php
/**
 * Single pop-up event template.
 *
 * @package JJBBQ
 */

get_header();
?>

<main id="main-content" class="site-main">

    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $date      = jjbbq_format_event_date( get_the_ID() );
        $venue     = get_field( 'event_venue' ) ?: '';
        $address   = get_field( 'event_address' ) ?: '';
        $time      = get_field( 'event_time' ) ?: '';
        $status    = get_field( 'event_status' ) ?: 'upcoming';
        $partner   = get_field( 'event_partner' ) ?: '';
        $flyer_id  = get_field( 'event_flyer' );
        $raw_date  = get_field( 'event_date' );
        ?>

        <section class="section-band section-band--red">
            <div class="container" style="text-align: center;">
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <section class="single-event">
            <div class="container" style="max-width: 800px;">

                <a href="<?php echo esc_url( get_post_type_archive_link( 'jjbbq_event' ) ); ?>" class="single-event__back">
                    &larr; <?php esc_html_e( 'All Pop-Ups', 'jjbbq' ); ?>
                </a>

                <div class="single-event__header">
                    <div class="single-event__date"><?php echo esc_html( $date ); ?></div>

                    <?php
                    $status_labels = [
                        'upcoming' => __( 'Upcoming', 'jjbbq' ),
                        'past'     => __( 'Past', 'jjbbq' ),
                        'sold-out' => __( 'Sold Out', 'jjbbq' ),
                    ];
                    ?>
                    <span class="badge badge--<?php echo esc_attr( $status ); ?>">
                        <?php echo esc_html( $status_labels[ $status ] ?? $status ); ?>
                    </span>
                </div>

                <div class="single-event__meta">
                    <?php if ( $venue ) : ?>
                        <div><strong><?php esc_html_e( 'Venue:', 'jjbbq' ); ?></strong> <?php echo esc_html( $venue ); ?></div>
                    <?php endif; ?>
                    <?php if ( $address ) : ?>
                        <div><strong><?php esc_html_e( 'Address:', 'jjbbq' ); ?></strong> <?php echo esc_html( $address ); ?></div>
                    <?php endif; ?>
                    <?php if ( $time ) : ?>
                        <div><strong><?php esc_html_e( 'Time:', 'jjbbq' ); ?></strong> <?php echo esc_html( $time ); ?></div>
                    <?php endif; ?>
                    <?php if ( $partner ) : ?>
                        <div><strong><?php esc_html_e( 'Featuring:', 'jjbbq' ); ?></strong> <?php echo esc_html( $partner ); ?></div>
                    <?php endif; ?>
                </div>

                <?php if ( $flyer_id ) : ?>
                    <div class="single-event__flyer">
                        <?php echo wp_get_attachment_image( $flyer_id, 'event-hero', false, [
                            'alt'     => get_the_title(),
                            'loading' => 'lazy',
                        ] ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( get_the_content() ) : ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $raw_date && $venue && $status === 'upcoming' ) : ?>
                    <?php
                    $ics_start = date( 'Ymd', strtotime( $raw_date ) );
                    $ics_summary = get_the_title();
                    $ics_location = $venue . ( $address ? ', ' . $address : '' );
                    $ics_data = "BEGIN:VCALENDAR\r\nVERSION:2.0\r\nBEGIN:VEVENT\r\nDTSTART;VALUE=DATE:{$ics_start}\r\nSUMMARY:{$ics_summary}\r\nLOCATION:{$ics_location}\r\nEND:VEVENT\r\nEND:VCALENDAR";
                    $ics_href = 'data:text/calendar;charset=utf-8,' . rawurlencode( $ics_data );
                    ?>
                    <div style="margin-top: var(--space-xl);">
                        <a href="<?php echo esc_attr( $ics_href ); ?>"
                           download="<?php echo esc_attr( sanitize_title( get_the_title() ) ); ?>.ics"
                           class="btn-secondary">
                            <?php esc_html_e( 'Add to Calendar', 'jjbbq' ); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php
get_footer();
