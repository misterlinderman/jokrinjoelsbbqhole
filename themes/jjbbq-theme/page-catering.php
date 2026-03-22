<?php
/**
 * Template Name: Catering
 *
 * Catering inquiry page.
 *
 * @package JJBBQ
 */

get_header();

$instagram_url = get_theme_mod( 'jjbbq_instagram_url', '' );
$contact_email = get_theme_mod( 'jjbbq_contact_email', '' );
?>

<main id="main-content" class="site-main">

    <!-- Hero -->
    <section class="catering-hero">
        <div class="container">
            <h1><?php esc_html_e( "Catering by Jorkin' Joel's", 'jjbbq' ); ?></h1>
            <p><?php esc_html_e( 'Smoked meats. No fuss. Just fire.', 'jjbbq' ); ?></p>
        </div>
    </section>

    <section class="catering-content">
        <div class="container">

            <!-- What We Offer -->
            <div class="catering-offerings">
                <h2><?php esc_html_e( 'What We Offer', 'jjbbq' ); ?></h2>
                <p>
                    <?php esc_html_e(
                        "We're putting together our catering packages — check back soon, or reach out below and we'll get you taken care of.",
                        'jjbbq'
                    ); ?>
                </p>
                <ul>
                    <li><?php esc_html_e( 'Private events', 'jjbbq' ); ?></li>
                    <li><?php esc_html_e( 'Corporate lunches', 'jjbbq' ); ?></li>
                    <li><?php esc_html_e( 'Backyard parties', 'jjbbq' ); ?></li>
                    <li><?php esc_html_e( 'Game days', 'jjbbq' ); ?></li>
                </ul>
                <p style="margin-top: var(--space-lg); font-style: italic; color: #666;">
                    <?php esc_html_e(
                        'Pricing and availability depend on event size and date. Contact us to start the conversation.',
                        'jjbbq'
                    ); ?>
                </p>
            </div>

            <!-- Inquiry Form -->
            <div class="catering-form">
                <h2><?php esc_html_e( 'Get in Touch', 'jjbbq' ); ?></h2>

                <?php if ( isset( $_GET['catering_sent'] ) && $_GET['catering_sent'] === '1' ) : ?>
                    <div class="card" style="background: #e8f5e9; border-color: #4caf50; margin-bottom: var(--space-xl);">
                        <p style="color: #2e7d32; font-weight: 600;">
                            <?php esc_html_e( "Thanks! We'll be in touch soon.", 'jjbbq' ); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <input type="hidden" name="action" value="jjbbq_catering_inquiry">
                    <?php wp_nonce_field( 'jjbbq_catering', 'jjbbq_catering_nonce' ); ?>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="catering-name"><?php esc_html_e( 'Name', 'jjbbq' ); ?></label>
                            <input type="text" id="catering-name" name="catering_name" required>
                        </div>
                        <div class="form-group">
                            <label for="catering-email"><?php esc_html_e( 'Email', 'jjbbq' ); ?></label>
                            <input type="email" id="catering-email" name="catering_email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="catering-phone"><?php esc_html_e( 'Phone', 'jjbbq' ); ?></label>
                            <input type="tel" id="catering-phone" name="catering_phone">
                        </div>
                        <div class="form-group">
                            <label for="catering-date"><?php esc_html_e( 'Event Date', 'jjbbq' ); ?></label>
                            <input type="date" id="catering-date" name="catering_date">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="catering-guests"><?php esc_html_e( 'Estimated Guest Count', 'jjbbq' ); ?></label>
                            <input type="number" id="catering-guests" name="catering_guests" min="1">
                        </div>
                        <div class="form-group">
                            <label for="catering-type"><?php esc_html_e( 'Event Type', 'jjbbq' ); ?></label>
                            <select id="catering-type" name="catering_type">
                                <option value=""><?php esc_html_e( 'Select...', 'jjbbq' ); ?></option>
                                <option value="private"><?php esc_html_e( 'Private Event', 'jjbbq' ); ?></option>
                                <option value="corporate"><?php esc_html_e( 'Corporate Lunch', 'jjbbq' ); ?></option>
                                <option value="backyard"><?php esc_html_e( 'Backyard Party', 'jjbbq' ); ?></option>
                                <option value="gameday"><?php esc_html_e( 'Game Day', 'jjbbq' ); ?></option>
                                <option value="other"><?php esc_html_e( 'Other', 'jjbbq' ); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="catering-message"><?php esc_html_e( 'Message', 'jjbbq' ); ?></label>
                        <textarea id="catering-message" name="catering_message" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn-primary">
                        <?php esc_html_e( 'Send Inquiry', 'jjbbq' ); ?>
                    </button>
                </form>
            </div>

            <!-- Alt contact -->
            <div class="catering-alt-contact">
                <p>
                    <?php esc_html_e( 'Prefer to reach out directly?', 'jjbbq' ); ?>
                    <?php if ( $instagram_url ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php esc_html_e( 'DM us on Instagram.', 'jjbbq' ); ?>
                        </a>
                    <?php else : ?>
                        <?php esc_html_e( 'DM us on Instagram.', 'jjbbq' ); ?>
                    <?php endif; ?>
                </p>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
