
<?php
/**
 * Plugin Name: Advanced Color Customizer
 * Description: Customize primary, button, link, background, and hover colors from the admin panel with live preview.
 * Version: 2.0
 * Author: Your Name
 */

// Add admin menu
add_action('admin_menu', function () {
    add_menu_page('Color Customizer', 'Color Customizer', 'manage_options', 'advanced-color-customizer', 'acc_settings_page');
});

// Register settings
add_action('admin_init', function () {
    $settings = ['acc_primary_color', 'acc_button_color', 'acc_hover_color', 'acc_link_color', 'acc_bg_color'];
    foreach ($settings as $setting) {
        register_setting('acc_settings_group', $setting);
    }
});

// Settings page
function acc_settings_page() {
    ?>
    <div class="wrap">
        <h1>Advanced Color Customizer</h1>
        <form method="post" action="options.php">
            <?php settings_fields('acc_settings_group'); ?>
            <?php do_settings_sections('acc_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Primary Text Color</th>
                    <td><input type="color" name="acc_primary_color" value="<?php echo esc_attr(get_option('acc_primary_color', '#000000')); ?>"></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Button Background Color</th>
                    <td><input type="color" name="acc_button_color" value="<?php echo esc_attr(get_option('acc_button_color', '#000000')); ?>"></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Hover Color</th>
                    <td><input type="color" name="acc_hover_color" value="<?php echo esc_attr(get_option('acc_hover_color', '#000000')); ?>"></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Link Color</th>
                    <td><input type="color" name="acc_link_color" value="<?php echo esc_attr(get_option('acc_link_color', '#0000EE')); ?>"></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Background Color</th>
                    <td><input type="color" name="acc_bg_color" value="<?php echo esc_attr(get_option('acc_bg_color', '#ffffff')); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Apply selected styles to front-end
add_action('wp_head', function () {
    $primary = esc_attr(get_option('acc_primary_color', '#000'));
    $button = esc_attr(get_option('acc_button_color', '#000'));
    $hover = esc_attr(get_option('acc_hover_color', '#000'));
    $link = esc_attr(get_option('acc_link_color', '#00f'));
    $bg = esc_attr(get_option('acc_bg_color', '#fff'));

    echo "
    <style>
        body { background-color: $bg; color: $primary; }
        a { color: $link; }
        a:hover { color: $hover; }
        button, .btn { background-color: $button; color: #fff; }
        button:hover, .btn:hover { background-color: $hover; }
    </style>
    ";
});
