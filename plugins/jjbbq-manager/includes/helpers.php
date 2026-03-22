<?php
/**
 * Shared query helper functions.
 *
 * These are duplicated from the theme's template-functions.php
 * to ensure they're available regardless of active theme.
 * The theme versions take precedence if both are loaded.
 *
 * @package JJBBQ
 */

if ( ! function_exists( 'jjbbq_get_next_event' ) ) {
    function jjbbq_get_next_event(): ?WP_Post {
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

if ( ! function_exists( 'jjbbq_get_menu_items' ) ) {
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
    function jjbbq_format_event_date( int $post_id ): string {
        $raw = get_field( 'event_date', $post_id );

        if ( ! $raw ) {
            return __( 'Date TBD', 'jjbbq' );
        }

        $timestamp = strtotime( $raw );

        return $timestamp ? date_i18n( 'l, F j', $timestamp ) : __( 'Date TBD', 'jjbbq' );
    }
}
