<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    JPToolkit
 */

namespace JPToolkit;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\HtmlHelper\Init as HtmlHelperInit;
use JPToolkit\AssetsHelper\Init as AssetsHelperInit;
use JPToolkit\Admin\Init as AdminInit;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
class JPToolkit
{
  /**
   * Constructor class
   *
   * @since         1.1.0
   */
  public function init()
  {
    // Initialize admin
    new AdminInit();

    // Initialize helpers
    new HtmlHelperInit();
    new AssetsHelperInit();

    // Adds non-default cron schedules
    add_filter('cron_schedules', [$this, 'add_cron_schedules'], 999);
  }

  /**
   * Adds non-default cron schedules
   *
   * @since     1.0.0
   * @param     array     $schedules
   * @return    array
   */
  public function add_cron_schedules(array $schedules = [])
  {
    if (!isset($schedules['twicemonthly'])) {
      $schedules['twicemonthly'] = [
        'interval' => MONTH_IN_SECONDS / 2,
        'display'  => __('Twice monthly', 'jp-toolkit'),
      ];
    }

    if (!isset($schedules['monthly'])) {
      $schedules['monthly'] = [
        'interval' => MONTH_IN_SECONDS,
        'display'  => __('Once monthly', 'jp-toolkit'),
      ];
    }

    return $schedules;
  }
}
