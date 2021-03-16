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

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
class Init
{
  /**
   * Constructor class
   *
   * @since         1.1.0
   */
  public function __construct() {
        // Initialize helpers
        new HtmlHelperInit();
    }
}
