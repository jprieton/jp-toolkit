<?php
/**
 * Trait to add Img shorthand handlers
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper\Traits
 */

namespace JPToolkit\HtmlHelper\Traits;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Img_Shorthand trait
 *
 * @property      string $name Shorthand name
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper\Traits
 * @since         1.1.0
 * @author        Javier Prieto
 */
trait ImgHandler {

  /**
   * Adds CommonHandler methods
   *
   * @since     1.1.0
   */
  use \JPToolkit\HtmlHelper\Traits\CommonHandler;

  /**
   * Array with the WordPress image sizes
   *
   * @var     array List of image sizes.
   * @since   1.1.0
   */
  protected $image_sizes = [];

  /**
   * Class constructor
   *
   * @since     1.1.0
   */
  public function __construct() {
    if ( empty( $this->image_sizes ) ) {
      $this->image_sizes = get_intermediate_image_sizes();
    }

    // Add shorthands keywords.
    add_filter( 'jp_toolkit_html_helper_html_img_shorthand_handlers', [ $this, 'add_shorthand_handler' ] );

    // add image shorthands filters.
    add_filter( "jp_toolkit_html_helper_html_img_shorthand_{$this->handler}", [ $this, 'parse_shorthand_handler' ], 10, 2 );
  }

}
