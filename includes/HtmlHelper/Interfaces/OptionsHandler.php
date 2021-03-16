<?php
/**
 * Trait to add an option shorthand handler
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Interfaces
 */

namespace JPToolkit\HtmlHelper\Interfaces;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * OptionsHandler trait
 *
 * @property      string $handler Shorthand handler
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Interfaces
 * @since         1.1.0
 * @author        Javier Prieto
 */
interface OptionsHandler {

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
  public function parse_shorthand_handler( $options );
}
