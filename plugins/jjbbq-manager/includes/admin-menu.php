<?php
/**
 * JJBBQ top-level admin menu and settings screens.
 *
 * @package JJBBQ
 */

/**
 * Register admin menu and submenus.
 */
function jjbbq_register_admin_menu(): void {
    add_menu_page(
        __( 'JJBBQ', 'jjbbq' ),
        __( 'JJBBQ', 'jjbbq' ),
        'manage_options',
        'jjbbq',
        'jjbbq_render_site_settings_page',
        'dashicons-food',
        26
    );

    add_submenu_page(
        'jjbbq',
        __( 'Site Settings', 'jjbbq' ),
        __( 'Site Settings', 'jjbbq' ),
        'manage_options',
        'jjbbq',
        'jjbbq_render_site_settings_page'
    );

    add_submenu_page(
        'jjbbq',
        __( 'Menu Page Tabs', 'jjbbq' ),
        __( 'Menu Page Tabs', 'jjbbq' ),
        'manage_options',
        'jjbbq-menu-tabs',
        'jjbbq_render_menu_tabs_page'
    );

    add_submenu_page(
        'jjbbq',
        __( 'Catering Form', 'jjbbq' ),
        __( 'Catering Form', 'jjbbq' ),
        'manage_options',
        'jjbbq-catering',
        'jjbbq_render_catering_settings_page'
    );

    add_submenu_page(
        'jjbbq',
        __( 'Sample Data', 'jjbbq' ),
        __( 'Sample Data', 'jjbbq' ),
        'manage_options',
        'jjbbq-setup',
        'jjbbq_seed_page_render'
    );
}
add_action( 'admin_menu', 'jjbbq_register_admin_menu', 9 );

add_action( 'admin_post_jjbbq_save_settings', 'jjbbq_handle_admin_settings_save' );

/**
 * Handle POST saves for all JJBBQ admin pages.
 */
function jjbbq_handle_admin_settings_save(): void {
    if ( ! isset( $_POST['jjbbq_admin_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['jjbbq_admin_nonce'] ) ), 'jjbbq_admin_save' ) ) {
        return;
    }

    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $page = isset( $_POST['jjbbq_admin_page'] ) ? sanitize_text_field( wp_unslash( $_POST['jjbbq_admin_page'] ) ) : '';

    if ( $page === 'site' ) {
        update_option( 'jjbbq_instagram_handle', sanitize_text_field( wp_unslash( $_POST['jjbbq_instagram_handle'] ?? '' ) ) );
        update_option( 'jjbbq_instagram_url', esc_url_raw( wp_unslash( $_POST['jjbbq_instagram_url'] ?? '' ) ) );
        update_option( 'jjbbq_facebook_url', esc_url_raw( wp_unslash( $_POST['jjbbq_facebook_url'] ?? '' ) ) );
        update_option( 'jjbbq_contact_email', sanitize_email( wp_unslash( $_POST['jjbbq_contact_email'] ?? '' ) ) );
        update_option( 'jjbbq_contact_phone', sanitize_text_field( wp_unslash( $_POST['jjbbq_contact_phone'] ?? '' ) ) );
        update_option( 'jjbbq_hero_headline', sanitize_text_field( wp_unslash( $_POST['jjbbq_hero_headline'] ?? '' ) ) );
        update_option( 'jjbbq_hero_subhead', sanitize_text_field( wp_unslash( $_POST['jjbbq_hero_subhead'] ?? '' ) ) );
        update_option( 'jjbbq_catering_cta_text', sanitize_text_field( wp_unslash( $_POST['jjbbq_catering_cta_text'] ?? '' ) ) );

        add_settings_error( 'jjbbq_messages', 'jjbbq_saved', __( 'Settings saved.', 'jjbbq' ), 'success' );
    }

    if ( $page === 'menu_tabs' ) {
        $slugs = [ 'core', 'specialty', 'sides', 'collab' ];
        $cats  = [];
        foreach ( $slugs as $slug ) {
            $field = 'jjbbq_menu_label_' . $slug;
            $cats[ $slug ] = sanitize_text_field( wp_unslash( $_POST[ $field ] ?? '' ) );
        }
        update_option( 'jjbbq_menu_categories', $cats );
        add_settings_error( 'jjbbq_messages', 'jjbbq_saved', __( 'Menu tab labels saved.', 'jjbbq' ), 'success' );
    }

    if ( $page === 'catering' ) {
        $gf_id = isset( $_POST['jjbbq_catering_gravity_form_id'] ) ? absint( $_POST['jjbbq_catering_gravity_form_id'] ) : 0;
        update_option( 'jjbbq_catering_gravity_form_id', $gf_id );
        add_settings_error( 'jjbbq_messages', 'jjbbq_saved', __( 'Catering form settings saved.', 'jjbbq' ), 'success' );
    }

    set_transient( 'jjbbq_settings_errors', get_settings_errors(), 30 );
    $redirect = menu_page_url( 'jjbbq', false );
    if ( $page === 'menu_tabs' ) {
        $redirect = menu_page_url( 'jjbbq-menu-tabs', false );
    } elseif ( $page === 'catering' ) {
        $redirect = menu_page_url( 'jjbbq-catering', false );
    }
    wp_safe_redirect( add_query_arg( 'settings-updated', '1', $redirect ) );
    exit;
}
add_action( 'admin_post_jjbbq_save_settings', 'jjbbq_handle_admin_settings_save' );

/**
 * Show settings errors after redirect.
 */
function jjbbq_admin_settings_notices(): void {
    if ( ! isset( $_GET['settings-updated'] ) ) {
        return;
    }
    $page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';
    if ( ! in_array( $page, [ 'jjbbq', 'jjbbq-menu-tabs', 'jjbbq-catering' ], true ) ) {
        return;
    }

    $errors = get_transient( 'jjbbq_settings_errors' );
    if ( ! $errors || ! is_array( $errors ) ) {
        return;
    }
    delete_transient( 'jjbbq_settings_errors' );
    foreach ( $errors as $error ) {
        $type = $error['type'] ?? 'info';
        printf(
            '<div class="notice notice-%1$s is-dismissible"><p>%2$s</p></div>',
            esc_attr( $type === 'success' ? 'success' : 'info' ),
            esc_html( $error['message'] ?? '' )
        );
    }
}
add_action( 'admin_notices', 'jjbbq_admin_settings_notices' );

/**
 * Site Settings screen.
 */
function jjbbq_render_site_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $instagram_handle   = get_option( 'jjbbq_instagram_handle', '' );
    $instagram_url      = get_option( 'jjbbq_instagram_url', '' );
    $facebook_url       = get_option( 'jjbbq_facebook_url', '' );
    $contact_email      = get_option( 'jjbbq_contact_email', '' );
    $contact_phone      = get_option( 'jjbbq_contact_phone', '' );
    $hero_headline      = get_option( 'jjbbq_hero_headline', '' );
    $hero_subhead       = get_option( 'jjbbq_hero_subhead', '' );
    $catering_cta       = get_option( 'jjbbq_catering_cta_text', '' );

    if ( $hero_headline === '' ) {
        $hero_headline = __( 'Pop-Up BBQ. Sell-Out Quality.', 'jjbbq' );
    }
    if ( $hero_subhead === '' ) {
        $hero_subhead = __( 'Smoked in Omaha. Gone before you know it.', 'jjbbq' );
    }
    if ( $catering_cta === '' ) {
        $catering_cta = __( 'Feed Your Crew', 'jjbbq' );
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'JJBBQ Site Settings', 'jjbbq' ); ?></h1>
        <p class="description"><?php esc_html_e( 'These settings replace the theme Customizer for social links, contact info, and homepage text.', 'jjbbq' ); ?></p>

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <?php wp_nonce_field( 'jjbbq_admin_save', 'jjbbq_admin_nonce' ); ?>
            <input type="hidden" name="action" value="jjbbq_save_settings">
            <input type="hidden" name="jjbbq_admin_page" value="site">

            <h2><?php esc_html_e( 'Social Media', 'jjbbq' ); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="jjbbq_instagram_handle"><?php esc_html_e( 'Instagram handle (without @)', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_instagram_handle" id="jjbbq_instagram_handle" type="text" class="regular-text" value="<?php echo esc_attr( $instagram_handle ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="jjbbq_instagram_url"><?php esc_html_e( 'Instagram URL', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_instagram_url" id="jjbbq_instagram_url" type="url" class="regular-text" value="<?php echo esc_attr( $instagram_url ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="jjbbq_facebook_url"><?php esc_html_e( 'Facebook URL (optional)', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_facebook_url" id="jjbbq_facebook_url" type="url" class="regular-text" value="<?php echo esc_attr( $facebook_url ); ?>"></td>
                </tr>
            </table>

            <h2><?php esc_html_e( 'Contact Info', 'jjbbq' ); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="jjbbq_contact_email"><?php esc_html_e( 'Contact email', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_contact_email" id="jjbbq_contact_email" type="email" class="regular-text" value="<?php echo esc_attr( $contact_email ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="jjbbq_contact_phone"><?php esc_html_e( 'Contact phone (optional)', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_contact_phone" id="jjbbq_contact_phone" type="text" class="regular-text" value="<?php echo esc_attr( $contact_phone ); ?>"></td>
                </tr>
            </table>

            <h2><?php esc_html_e( 'Homepage Text', 'jjbbq' ); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="jjbbq_hero_headline"><?php esc_html_e( 'Hero headline', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_hero_headline" id="jjbbq_hero_headline" type="text" class="large-text" value="<?php echo esc_attr( $hero_headline ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="jjbbq_hero_subhead"><?php esc_html_e( 'Hero subheadline', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_hero_subhead" id="jjbbq_hero_subhead" type="text" class="large-text" value="<?php echo esc_attr( $hero_subhead ); ?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="jjbbq_catering_cta_text"><?php esc_html_e( 'Catering CTA headline (homepage band)', 'jjbbq' ); ?></label></th>
                    <td><input name="jjbbq_catering_cta_text" id="jjbbq_catering_cta_text" type="text" class="large-text" value="<?php echo esc_attr( $catering_cta ); ?>"></td>
                </tr>
            </table>

            <?php submit_button( __( 'Save Settings', 'jjbbq' ) ); ?>
        </form>
    </div>
    <?php
}

/**
 * Menu tab labels screen.
 */
function jjbbq_render_menu_tabs_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $defaults = jjbbq_default_menu_category_labels();
    $saved    = get_option( 'jjbbq_menu_categories', [] );
    if ( ! is_array( $saved ) ) {
        $saved = [];
    }
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Menu Page Tabs', 'jjbbq' ); ?></h1>
        <p class="description">
            <?php esc_html_e( 'These labels appear on the public Menu page tabs. Slugs must match the Category values on menu items (core, specialty, sides, collab).', 'jjbbq' ); ?>
        </p>

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <?php wp_nonce_field( 'jjbbq_admin_save', 'jjbbq_admin_nonce' ); ?>
            <input type="hidden" name="action" value="jjbbq_save_settings">
            <input type="hidden" name="jjbbq_admin_page" value="menu_tabs">

            <table class="form-table" role="presentation">
                <?php foreach ( $defaults as $slug => $label ) : ?>
                    <tr>
                        <th scope="row">
                            <label for="jjbbq_menu_label_<?php echo esc_attr( $slug ); ?>">
                                <code><?php echo esc_html( $slug ); ?></code>
                            </label>
                        </th>
                        <td>
                            <input
                                name="jjbbq_menu_label_<?php echo esc_attr( $slug ); ?>"
                                id="jjbbq_menu_label_<?php echo esc_attr( $slug ); ?>"
                                type="text"
                                class="regular-text"
                                value="<?php echo esc_attr( $saved[ $slug ] ?? $label ); ?>"
                            >
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <?php submit_button( __( 'Save Tab Labels', 'jjbbq' ) ); ?>
        </form>
    </div>
    <?php
}

/**
 * Default menu category labels (for admin + theme fallback).
 *
 * @return array<string, string>
 */
function jjbbq_default_menu_category_labels(): array {
    return [
        'core'      => __( 'Core Menu', 'jjbbq' ),
        'specialty' => __( 'Specialty Items', 'jjbbq' ),
        'sides'     => __( 'Sides', 'jjbbq' ),
        'collab'    => __( 'Collaborations', 'jjbbq' ),
    ];
}

/**
 * Catering / Gravity Forms screen.
 */
function jjbbq_render_catering_settings_page(): void {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $gf_id = (int) get_option( 'jjbbq_catering_gravity_form_id', 0 );
    $forms = class_exists( 'GFAPI' ) ? GFAPI::get_forms() : [];
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Catering Form', 'jjbbq' ); ?></h1>

        <?php if ( ! class_exists( 'GFForms' ) ) : ?>
            <div class="notice notice-warning">
                <p><?php esc_html_e( 'Gravity Forms is not active. The site will use the built-in HTML form and wp_mail until you install Gravity Forms and choose a form below.', 'jjbbq' ); ?></p>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <?php wp_nonce_field( 'jjbbq_admin_save', 'jjbbq_admin_nonce' ); ?>
            <input type="hidden" name="action" value="jjbbq_save_settings">
            <input type="hidden" name="jjbbq_admin_page" value="catering">

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="jjbbq_catering_gravity_form_id"><?php esc_html_e( 'Gravity Form', 'jjbbq' ); ?></label></th>
                    <td>
                        <select name="jjbbq_catering_gravity_form_id" id="jjbbq_catering_gravity_form_id">
                            <option value="0"><?php esc_html_e( '— Use built-in form (wp_mail) —', 'jjbbq' ); ?></option>
                            <?php foreach ( $forms as $form ) : ?>
                                <option value="<?php echo esc_attr( (string) $form['id'] ); ?>" <?php selected( $gf_id, (int) $form['id'] ); ?>>
                                    <?php echo esc_html( $form['title'] . ' (ID ' . $form['id'] . ')' ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="description">
                            <?php esc_html_e( 'When a form is selected, it replaces the built-in catering form on the Catering page. Notifications and confirmations are handled in Gravity Forms.', 'jjbbq' ); ?>
                        </p>
                    </td>
                </tr>
            </table>

            <?php submit_button( __( 'Save', 'jjbbq' ) ); ?>
        </form>

        <hr>

        <h2><?php esc_html_e( 'Matching the site design', 'jjbbq' ); ?></h2>
        <p class="description">
            <?php esc_html_e( 'This site renders the catering form with Gravity Forms “Legacy” theme and without Orbital’s inline blue theme variables, so it aligns with the built-in JJBBQ form.', 'jjbbq' ); ?>
        </p>
        <ol>
            <li>
                <?php esc_html_e( 'Optional: add CSS class', 'jjbbq' ); ?>
                <code>jjbbq-catering-form</code>
                <?php esc_html_e( 'on the form (Form Settings → “CSS Class Name”) for extra styling hooks.', 'jjbbq' ); ?>
            </li>
            <li><?php esc_html_e( 'Theme styles target .jjbbq-gf-catering (red/gold button, black borders, gold focus ring, two-column name row).', 'jjbbq' ); ?></li>
        </ol>
    </div>
    <?php
}
