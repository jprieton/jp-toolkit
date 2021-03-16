<?php
/**
 * Add the weekdays shorthand to the Form:.options method
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Filters
 */

namespace JPToolkit\HtmlHelper\Handlers;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\HtmlHelper\Interfaces\OptionsHandler as InterfaceOptionsHandler;

/**
 * Add the weekdays shorthand to the Form:.options method
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Filters
 * @since         1.1.0
 * @author        Javier Prieto
 */
class OptionsWeekdaysHandler implements InterfaceOptionsHandler {

  /**
   * Adds OptionsHandler methods
   *
   * @since     1.1.0
   */
  use \JPToolkit\HtmlHelper\Traits\OptionsHandler;

  /**
   * The options handler name
   *
   * @var     string
   * @since   1.1.0
   */
  private $handler = 'weekdays';

  /**
   * Parse the shorthand
   *
   * @since   1.1.0
   *
   * @global  WP_Locale   $wp_locale
   *
   * @param   string $options The options handler.
   * @return  array
   */
  public function parse_shorthand_handler( $options ) {
    global $wp_locale;

    $options = array_map( 'ucfirst', $wp_locale->weekday );

    return $options;
  }

}
