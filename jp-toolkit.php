<?php

/**
 * Plugin Name:         JP Toolkit for WordPress
 * Plugin URI:          https://github.com/jprieton/jp-toolkit
 * Description:         JP Toolkit for WordPress
 * Tags:                jp-toolkit
 * Version:             1.0.0
 * Requires at least:   5.2
 * Tested up to:        5.7
 * Author:              Javier Prieto
 * Author URI:          https://github.com/jprieton
 * Text Domain:         jp-toolkit
 * Domain Path:         /languages/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 * @package JPToolkit
 */

// If this file is called directly, abort.
defined('ABSPATH') || exit;

// Autoloader
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

// Check if the minimum requirements are met.
if (version_compare(PHP_VERSION, '7.0', '<')) {
    $message = __('JP Toolkit requires PHP version 7.0 or later.', 'jp-toolkit');
    $options = [
        'type' => 'error'
    ];

    // Show notice for minimum PHP version required for JP Toolkit HTML helper for WordPress.
    $notices = new WPTRT\AdminNotices\Notices();
    $notices->add('jp-toolkit-php-warning', '', $message, $options);
    $notices->boot();
} else {
    define('JPTOOLKIT_VERSION', '1.0.0');
    define('JPTOOLKIT_FILENAME', __FILE__);

    // Initialize the plugin
    new JPToolkit\Init();
}
