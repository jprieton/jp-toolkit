<?php
/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper
 */

namespace JPToolkit\HtmlHelper;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\HtmlHelper\Handlers\OptionsMonthsHandler;
use JPToolkit\HtmlHelper\Handlers\OptionsWeekdaysHandler;
use JPToolkit\HtmlHelper\Handlers\ImgPixelHandler;
use JPToolkit\HtmlHelper\Shortcodes;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper
 * @author        Javier Prieto
 * @since         1.1.0
 */
class Init {

  /**
   * Constructor class
   *
   * @since         1.1.0
   */
  public function __construct() {
    // Add handlers
    add_action( 'init', [ $this, 'add_html_img_handlers' ] );
    add_action( 'init', [ $this, 'add_form_options_handlers' ] );

    // Add texdomain
    add_action( 'init', [ $this, 'load_textdomain' ] );
  }

  /**
   * Adds Html::img handlers
   *
   * @since         1.1.0
   */
  public function add_html_img_handlers() {
    new ImgPixelHandler();
  }

  /**
   * Adds Form::options handlers
   *
   * @since         1.1.0
   */
  public function add_form_options_handlers() {
    new OptionsMonthsHandler();
    new OptionsWeekdaysHandler();
  }

  /**
   * Adds shortcodess
   *
   * @since         1.3.0
   */
  public function add_shortcodes_handlers() {
    new Shortcodes();
  }

  /**
   * Load plugin texdomain
   *
   * @since         1.3.1
   */
  public function load_textdomain() {
    load_plugin_textdomain( 'jp-toolkit', false, dirname( plugin_basename( __DIR__ ) ) . '/languages' );
  }

}
