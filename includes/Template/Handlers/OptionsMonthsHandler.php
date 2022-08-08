<?php
/**
 * Add the months shorthand to the Form:.options method
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Filters
 */

namespace JPToolkit\Template\Handlers;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\Template\Interfaces\OptionsHandler as InterfaceOptionsHandler;

/**
 * Add the months shorthand to the Form:.options method
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Filters
 * @since         1.1.0
 * @author        Javier Prieto
 */
class OptionsMonthsHandler implements InterfaceOptionsHandler {

  /**
   * Adds OptionsHandler methods
   *
   * @since     1.1.0
   */
  use \JPToolkit\Template\Traits\OptionsHandler;

  /**
   * The options handler name
   *
   * @var     string
   * @since   1.1.0
   */
  private $handler = 'months';

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

    $options = array_map( 'ucfirst', $wp_locale->month );

    return $options;
  }

}
