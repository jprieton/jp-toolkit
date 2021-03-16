<?php
/**
 * An Interface to add an image shorthand handler
 *
 * @package       JPToolkit
 * @subpackage    Interfaces
 */

namespace JPToolkit\HtmlHelper\Interfaces;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * An Interface to add an image shorthand
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper\Interfaces
 * @since         1.1.0
 * @author        Javier Prieto
 */
interface ImgHandler {

  /**
   * Parse the shorthand
   *
   * @since   1.1.0
   *
   * @param array  $attributes An array of html attributes.
   * @param string $src The img handler.
   * @return  array
   */
  public function parse_shorthand_handler( $attributes, $src );
}
