<?php
/**
 * Template part: Past events / social proof.
 *
 * @package JJBBQ
 */

$past_query = function_exists( 'jjbbq_get_past_events' ) ? jjbbq_get_past_events( 5 ) : null;
?>

<section class="section section-band--light" aria-label="<?php esc_attr_e( 'Past Events', 'jjbbq' ); ?>">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: var(--space-xl);">
            <?php esc_html_e( "Where We've Been", 'jjbbq' ); ?>
        </h2>

        <?php if ( $past_query && $past_query->have_posts() ) : ?>
            <div class="past-events-list" style="max-width: 700px; margin-inline: auto;">
                <?php while ( $past_query->have_posts() ) : $past_query->the_post(); ?>
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
        <?php endif; ?>

        <p style="text-align: center; margin-top: var(--space-xl); font-family: var(--font-display); font-size: 1.2rem; color: var(--color-red);">
            <?php esc_html_e( "We sell out every time. Next one's yours.", 'jjbbq' ); ?>
        </p>
    </div>
</section>
