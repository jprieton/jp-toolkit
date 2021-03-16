<?php
/**
 * Trait to add common methods to handlers
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Traits
 */

namespace JPToolkit\HtmlHelper\Traits;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * CommonHandler trait
 *
 * @property      string $handler Shorthand handler
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Traits
 * @since         1.1.0
 * @author        Javier Prieto
 */
trait CommonHandler {

  /**
   * Adds the shorthand handler
   *
   * @since   1.1.0
   *
   * @param   array $handlers An array with the img shorthand handlers.
   * @return  array
   */
  public function add_shorthand_handler( $handlers = [] ) {
    $handlers[] = $this->handler;
    return $handlers;
  }

}
