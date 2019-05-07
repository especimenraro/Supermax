<?php $options = BeRocket_Compare_Products::get_compare_products_option ( 'br_compare_products_javascript_settings' ); ?>
<input name="br_compare_products_javascript_settings[settings_name]" type="hidden" value="br_compare_products_javascript_settings">
<table class="form-table">
    <tr>
        <th scope="row"><?php _e('Disable Font Awesome', 'BeRocket_Compare_Products_domain') ?></th>
        <td>
            <label>
                <input name="br_compare_products_javascript_settings[fontawesome_frontend_disable]" value="1" type="checkbox"<?php echo ($options['fontawesome_frontend_disable'] ? ' checked' : ''); ?>>
                <?php _e('Don\'t loading css file for Font Awesome on site front end. Use it only if you doesn\'t uses Font Awesome icons in widgets or you have Font Awesome in your theme.', 'BeRocket_Compare_Products_domain') ?>
            </label>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Font Awesome Version', 'BeRocket_Compare_Products_domain') ?></th>
        <td>
            <select name="br_compare_products_javascript_settings[fontawesome_frontend_version]">
                <option value=""<?php if(isset($options['fontawesome_frontend_version']) && $options['fontawesome_frontend_version'] == '') echo ' selected'; ?>><?php _e('Font Awesome 4', 'BeRocket_Compare_Products_domain') ?></option>
                <option value="fontawesome5"<?php if(isset($options['fontawesome_frontend_version']) && $options['fontawesome_frontend_version'] == 'fontawesome5') echo ' selected'; ?>><?php _e('Font Awesome 5', 'BeRocket_Compare_Products_domain') ?></option>
            </select>
            <?php _e('Version of Font Awesome that will be used on front end. Please select version that you have in your theme', 'BeRocket_Compare_Products_domain'); ?>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'Before products load', 'BeRocket_Compare_Products_domain' ) ?></th>
        <td>
            <textarea name="br_compare_products_javascript_settings[before_load]"><?php echo @ $options['before_load']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'After products load', 'BeRocket_Compare_Products_domain' ) ?></th>
        <td>
            <textarea name="br_compare_products_javascript_settings[after_load]"><?php echo @ $options['after_load']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'Before remove product', 'BeRocket_Compare_Products_domain' ) ?></th>
        <td>
            <textarea name="br_compare_products_javascript_settings[before_load]"><?php echo @ $options['before_remove']; ?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php _e( 'After remove product', 'BeRocket_Compare_Products_domain' ) ?></th>
        <td>
            <textarea name="br_compare_products_javascript_settings[after_load]"><?php echo @ $options['after_remove']; ?></textarea>
        </td>
    </tr>
</table>
