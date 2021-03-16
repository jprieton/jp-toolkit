<?php
/**
 * Shortcode class.
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper
 */

namespace JPToolkit\HtmlHelper;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\HtmlHelper\Html;

/**
 * Shortcode class
 *
 * A collection of template shortcodes.
 *
 * @package Template
 *
 * @since   1.3.0
 * @see     https://codex.wordpress.org/Shortcode_API
 *
 * @author  Javier Prieto
 */
class Shortcodes {

  public function __construct() {
    // Add an ofuscate mailto shortcode to prevent spam-bots from sniffing it.
    add_shortcode( 'mailto', [ $this, 'mailto' ] );
  }

  /**
   * Add an ofuscate mailto link to prevent spam-bots from sniffing it.
   *
   * @since 1.3.0
   *
   * @param  array      $attributes
   * @param  string     $content
   * @return string
   */
  public function mailto( $attributes, $content = null ) {
    $defaults   = [ 'href' => '' ];
    $attributes = wp_parse_args( $attributes, $defaults );

    if ( is_email( $content ) ) {
      $attributes['href'] = $content;
    }

    if ( empty( $attributes['href'] ) ) {
      return '';
    } else {
      $email = $attributes['href'];
      unset( $attributes['href'] );
    }

    return Html::mailto( $email, $content, $attributes );
  }

}
