<?php
/**
 * Template helper functions.
 *
 * These are fallback declarations — the plugin's helpers.php defines the
 * canonical versions. Guards prevent redeclaration when the plugin is active.
 *
 * @package JJBBQ
 */

if ( ! function_exists( 'jjbbq_get_next_event' ) ) {
    /**
     * Get the next upcoming pop-up event.
     *
     * @return WP_Post|null
     */
    function jjbbq_get_next_event(): ?WP_Post {
        if ( ! post_type_exists( 'jjbbq_event' ) ) {
            return null;
        }

        $query = new WP_Query( [
            'post_type'      => 'jjbbq_event',
            'posts_per_page' => 1,
            'meta_query'     => [
                [
                    'key'   => 'event_status',
                    'value' => 'upcoming',
                ],
            ],
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'no_found_rows'  => true,
        ] );

        $post = $query->have_posts() ? $query->posts[0] : null;
        wp_reset_postdata();

        return $post;
    }
}

if ( ! function_exists( 'jjbbq_get_upcoming_events' ) ) {
    /**
     * Get upcoming events.
     *
     * @param int $limit Number of events to return.
     * @return WP_Query
     */
    function jjbbq_get_upcoming_events( int $limit = 5 ): WP_Query {
        return new WP_Query( [
            'post_type'      => 'jjbbq_event',
            'posts_per_page' => $limit,
            'meta_query'     => [
                [
                    'key'   => 'event_status',
                    'value' => 'upcoming',
                ],
            ],
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
        ] );
    }
}

if ( ! function_exists( 'jjbbq_get_past_events' ) ) {
    /**
     * Get past events.
     *
     * @param int $limit Number of events to return.
     * @return WP_Query
     */
    function jjbbq_get_past_events( int $limit = 10 ): WP_Query {
        return new WP_Query( [
            'post_type'      => 'jjbbq_event',
            'posts_per_page' => $limit,
            'meta_query'     => [
                [
                    'key'   => 'event_status',
                    'value' => 'past',
                ],
            ],
            'meta_key'       => 'event_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
        ] );
    }
}

if ( ! function_exists( 'jjbbq_get_menu_items' ) ) {
    /**
     * Get menu items by category.
     *
     * @param string $category Category slug or 'all'.
     * @return WP_Query
     */
    function jjbbq_get_menu_items( string $category = 'all' ): WP_Query {
        $args = [
            'post_type'      => 'jjbbq_menu_item',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order title',
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'   => 'menu_available',
                    'value' => '1',
                ],
            ],
        ];

        if ( $category !== 'all' ) {
            $args['meta_query'][] = [
                'key'   => 'menu_category',
                'value' => $category,
            ];
        }

        return new WP_Query( $args );
    }
}

if ( ! function_exists( 'jjbbq_format_event_date' ) ) {
    /**
     * Format an event date for display.
     *
     * @param int $post_id Post ID.
     * @return string Formatted date string (e.g. "Saturday, March 24").
     */
    function jjbbq_format_event_date( int $post_id ): string {
        $raw = get_field( 'event_date', $post_id );

        if ( ! $raw ) {
            return __( 'Date TBD', 'jjbbq' );
        }

        $timestamp = strtotime( $raw );

        return $timestamp ? date_i18n( 'l, F j', $timestamp ) : __( 'Date TBD', 'jjbbq' );
    }
}
