<?php
/**
 * Trait to add an option shorthand handler
 *
 * @package       JPToolkit
 * @subpackage    Helpers\Traits
 */

namespace JPToolkit\HtmlHelper\Traits;

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
trait OptionsHandler {

  /**
   * Adds common handler methods
   *
   * @since     1.1.0
   */
  use \JPToolkit\HtmlHelper\Traits\CommonHandler;

  /**
   * Class constructor
   *
   * @since     1.1.0
   */
  public function __construct() {
    // Add shorthands keywords.
    add_filter( 'jp_toolkit_html_helper_form_options_shorthand_handlers', [ $this, 'add_shorthand_handler' ] );

    // Add shorthands filters.
    add_filter( "jp_toolkit_html_helper_form_options_handler_{$this->handler}", [ $this, 'parse_shorthand_handler' ], 10, 2 );
  }

}
