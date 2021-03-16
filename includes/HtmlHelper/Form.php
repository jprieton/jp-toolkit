<?php
/**
 * The Form class is a helper that provides a set of static methods for generating
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    RequestHelper
 */

namespace JPToolkit\HtmlHelper;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use JPToolkit\HtmlHelper\Html;

/**
 * Form class
 *
 * A collection of static methods to generate form elements markup.
 *
 * @see         https://laravelcollective.com/docs/6.0/html
 * @see         http://www.yiiframework.com/doc-2.0/yii-helpers-basehtml.html
 * @see         https://docs.phalconphp.com/en/latest/reference/tags.html#tag-service
 *
 * @package       JPToolkit
 * @subpackage    HtmlHelper
 * @author        Javier Prieto
 * @since         0.3.0
 */
class Form {

  /**
   * Create a input label.
   *
   * @since 0.3.0
   *
   * @param   string       $label      Text that will be placed inner label tag.
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function label( $label, $attributes = [] ) {
    return Html::label( $label, $attributes );
  }

  /**
   * Create a form input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function input( $attributes = [] ) {
    $defaults   = [
        'value' => '',
        'type'  => 'text'
    ];
    $attributes = wp_parse_args( $attributes, $defaults );

    return Html::input( null, $attributes );
  }

  /**
   * Create a textarea input field.
   *
   * @since 0.3.0
   *
   * @param   string       $content    Content that will be placed inner textarea tag.
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function textarea( $content = '', $attributes = [] ) {
    return Html::textarea( esc_textarea( $content ), $attributes );
  }

  /**
   * Create a button element.
   *
   * @param   string       $label      A label for the button element.
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function button( $label, $attributes = [] ) {
    $defaults   = [
        'type' => 'button',
    ];
    $attributes = wp_parse_args( $attributes, $defaults );

    return Html::button( $label, $attributes );
  }

  /**
   * Shorthand for hidden input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function hidden( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'hidden' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for text input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function text( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'text' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for email input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function email( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'email' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for email input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function url( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'url' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for password input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function password( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'password' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for number input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function number( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'number' ] );
    return self::input( $attributes );
  }

  /**
   * Shorthand for file input field.
   *
   * @since 0.3.0
   *
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function file( $attributes = [] ) {
    $attributes = array_merge( $attributes, [ 'type' => 'file', 'value' => null ] );
    return self::input( $attributes );
  }

  /**
   * Create a dropdown list.
   *
   * @since 0.3.0
   *
   * @param   array|string $options    An key=>label array of options.
   * @param   array|string $attributes An array of html attributes.
   * @return  string
   */
  public static function select( $options = [], $attributes = [] ) {
    $placeholder = $attributes['placeholder'] ?? '';
    $required    = false;
    $selected    = '';

    if ( !empty( $attributes['required'] ) && is_bool( $attributes['required'] ) && $attributes['required'] ) {
      $required = true;
    }

    if ( !empty( $attributes['selected'] ) ) {
      $selected = $attributes['selected'];
    }

    if ( !empty( $placeholder ) ) {
      $atts        = [
          'selected' => ($selected == ''),
          'value'    => '',
          'disabled' => $required,
      ];
      $placeholder = Html::option( $placeholder, $atts );
    }

    unset( $attributes['placeholder'], $attributes['selected'], $attributes['required'] );

    return Html::select( $placeholder . self::options( $options, $selected ), $attributes );
  }

  /**
   * Create a list of option tags from array.
   *
   * @since 0.3.0
   *
   * @param  array|string $options    An key=>label array of options.
   * @param  array        $selected   The value which will be marked as 'selected'.
   * @return string
   */
  public static function options( $options, $selected = '' ) {
    // Filter to allow add shorthands.
    $shorthands = apply_filters( 'jp_toolkit_html_helper_form_options_shorthand_handlers', [] );

    if ( is_string( $options ) && in_array( $options, $shorthands ) ) {
      $options = apply_filters( "jp_toolkit_html_helper_form_options_handler_{$options}", $options );
    }

    $options = apply_filters( 'jp_toolkit_html_helper_form_options', $options );

    if ( empty( $options ) ) {
      return '';
    } elseif ( is_string( $options ) ) {
      return self::option( $options, null, compact( 'selected' ) );
    }

    $html = '';

    foreach ( $options as $key => $value ) {
      if ( is_array( $value ) ) {
        $html .= Html::optgroup( self::options( $value, $selected ), [ 'label' => $key ] );
      } else {
        $html .= self::option( $key, $value, compact( 'selected' ) );
      }
    }

    return $html;
  }

  /**
   * Generates a single option tag
   *
   * @since 0.3.0
   *
   * @param   string  $label The label of the option.
   * @param   array   $attr An array of HTML attributes.
   * @return  string
   */
  public static function option( $value, $label = null, $attr = [] ) {
    $attr['value'] = $value ?? $attr['value'] ?? '';
    $label         = $label ?? $attr['value'];

    if ( empty( $attr['value'] ) && empty( $label ) ) {
      return '';
    }

    if ( isset( $attr['selected'] ) ) {
      $attr['selected'] = ($attr['selected'] === true) ?:
              ( (string) $attr['selected'] === (string) $attr['value'] );
    } else {
      $attr['selected'] = false;
    }

    $option = Html::option( $label, $attr );

    return $option;
  }

}
