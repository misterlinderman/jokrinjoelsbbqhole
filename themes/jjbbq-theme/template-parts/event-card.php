<?php
/**
 * Template part: Reusable event card component.
 *
 * Expected: current post is a jjbbq_event in the loop.
 *
 * @package JJBBQ
 */

$status  = get_field( 'event_status' ) ?: 'upcoming';
$venue   = get_field( 'event_venue' ) ?: '';
$address = get_field( 'event_address' ) ?: '';
$time    = get_field( 'event_time' ) ?: '';

$card_class = 'event-card';
if ( $status === 'upcoming' ) {
    $card_class .= ' event-card--upcoming';
}
?>

<div class="<?php echo esc_attr( $card_class ); ?>">
    <div class="event-card__date">
        <?php echo esc_html( jjbbq_format_event_date( get_the_ID() ) ); ?>
    </div>
    <div class="event-card__venue"><?php echo esc_html( $venue ); ?></div>
    <?php if ( $address ) : ?>
        <div class="event-card__address"><?php echo esc_html( $address ); ?></div>
    <?php endif; ?>
    <?php if ( $time ) : ?>
        <div class="event-card__time"><?php echo esc_html( $time ); ?></div>
    <?php endif; ?>
    <div style="margin-top: var(--space-sm);">
        <?php
        $badge_map = [
            'upcoming' => 'badge--upcoming',
            'past'     => 'badge--past',
            'sold-out' => 'badge--sold-out',
        ];
        $labels = [
            'upcoming' => __( 'Upcoming', 'jjbbq' ),
            'past'     => __( 'Past', 'jjbbq' ),
            'sold-out' => __( 'Sold Out', 'jjbbq' ),
        ];
        ?>
        <span class="badge <?php echo esc_attr( $badge_map[ $status ] ?? '' ); ?>">
            <?php echo esc_html( $labels[ $status ] ?? $status ); ?>
        </span>
    </div>
</div>
