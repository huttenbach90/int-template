<?php
/**
 * Plugin Name: Own admin footer
 * Version: 1.0
 * Network: true
 * Author: Integromat
 * Author URI: https://integromat.com
 * Description: Replaces the "Thank you for creating with WordPress" message in admin area.
 */

 // Own footer in admin
function remove_footer_admin () {
    echo '<span id="footer-thankyou">In case of problems send details to <a href="mailto:medard.huttenbach@integromat.com" target="_blank">medard.huttenbach@integromat.com</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');