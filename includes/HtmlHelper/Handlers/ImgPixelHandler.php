<?php
/**
 * Add the pixel shorthand to Html::img method
 *
 * @package       JPToolkit
 * @subpackage    Filter
 */

namespace JPToolkit\HtmlHelper\Handlers;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\HtmlHelper\Interfaces\ImgHandler as InterfaceImgHandler;
use JPToolkit\HtmlHelper\Abstracts\ImgHandler as AbstractImgHandler;

/**
 * Add the pixel shorthand to Html::img() method
 * Some examples of shorthands are pixel, pixel:200, pixel:300x150, pixel:none, pixel:medium
 *
 * @package       JPToolkit
 * @subpackage    Filter
 * @since         1.1.0
 * @author        Javier Prieto
 */
class ImgPixelHandler extends AbstractImgHandler implements InterfaceImgHandler {

  /**
   * Adds Img_Shorthand methods and properties
   *
   * @since     1.1.0
   */
  use \JPToolkit\HtmlHelper\Traits\ImgHandler;

  /**
   * Shorthand handler
   *
   * @var     string
   * @since   1.1.0
   */
  protected $handler = 'pixel';

  /**
   * Parse the shorthand
   *
   * @since   1.1.0
   *
   * @param array  $attributes An array of html attributes.
   * @param string $src The img handler.
   */
  public function parse_shorthand_handler( $attributes, $src ) {
    if ( !isset( $attributes['width'] ) && !isset( $attributes['height'] ) ) {
      $attributes['size'] = '1x1';
    }

    $attributes = $this->get_image_size_attributes( $src, $attributes );

    // Set src of the image.
    $attributes['src'] = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';

    // Update css classes.
    $attributes['class'] = empty( $attributes['class'] ) ?
            'image-pixel' : $attributes['class'] . ' image-pixel';

    // Updtate alt value.
    $attributes['alt'] = empty( $attributes['alt'] ) ?
            __( 'Pixel image', 'jp-toolkit' ) : $attributes['alt'];

    // Allow filter all attributes.
    $attributes = apply_filters( "jp_toolkit_helpers_html_img_{$this->handler}_attributes", $attributes );

    return $attributes;
  }

}
