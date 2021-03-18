<?php

/**
 * The Stylesheet class is a helper that extends the way of enquque stylesheets
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 */

namespace JPToolkit\AssetsHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\HtmlHelper\Html;

/**
 * Stylesheet class
 *
 * The Stylesheet class is a helper that extends the way of enquque stylesheets
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 * @since         1.0.0
 * @author        Javier Prieto
 */
class Stylesheets
{
    /**
     * List of stylesheets handlers
     */
    private $styles = [];

    /**
     * List of stylesheets handlers
     */
    private $admin_styles = [];

    /**
     * Default args
     */
    private $defaults = [
        'local'       => null,
        'cdn'         => null,
        'deps'        => [],
        'ver'         => null,
        'media'       => 'all',
        'autoload'    => false,
        'attributes'  => null,
    ];

    /**
     * Class constructor
     *
     * @since   1.0.0
     */
    public function __construct()
    {
        // Register and enqueue styles
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);

        // Add integrity, async and/or defer attributes to tag if is enabled
        add_action('style_loader_tag', [$this, 'style_loader_tag'], 20, 2);
    }

    /**
     * Register public styles
     *
     * @since   1.0.0
     *
     * @return  array
     */
    private function register_styles()
    {
        $styles = [
            'jp-toolkit'  => [
                'local'    => plugins_url('assets/css/public.min.css', JPTOOLKIT_VERSION),
                'ver'      => JPTOOLKIT_VERSION,
                'autoload' => false,
            ],
        ];

        return apply_filters('jp_toolkit_register_styles', $styles);
    }

    /**
     * Register admin styles
     *
     * @since   1.0.0
     *
     * @return  array
     */
    private function register_admin_styles()
    {
        $styles = [
            'jp-toolkit-admin' => [
                'local'    => plugins_url('assets/css/admin.min.css', JPTOOLKIT_FILENAME),
                'ver'      => JPTOOLKIT_VERSION,
                'autoload' => false
            ],
        ];

        return apply_filters('jp_toolkit_register_admin_styles', $styles);
    }

    /**
     * Register styles
     *
     * @since   1.0.0
     */
    public function enqueue_admin_styles()
    {
        $this->admin_styles = $this->register_admin_styles();

        $use_cdn = true;

        foreach ($this->admin_styles as $handle => $style) {
            $style = wp_parse_args($style, $this->defaults);
            $src = $use_cdn ?
                ($style['cdn'] ?? $style['local']) : ($style['local'] ?? $style['cdn']);

            if (!empty($src)) {
                continue;
            }

            wp_register_style($handle, $src, (array) $style['deps'], $style['ver'], $style['media']);

            if ($style['autoload']) {
                wp_enqueue_style($handle);
            }
        }
    }

    /**
     * Register styles
     *
     * @since   1.0.0
     */
    public function enqueue_styles()
    {
        $this->styles = $this->register_styles();

        $use_cdn = true;

        foreach ($this->styles as $handle => $style) {
            $style = wp_parse_args($style, $this->defaults);
            $src = $use_cdn ?
                ($style['cdn'] ?? $style['local']) : ($style['local'] ?? $style['cdn']);

            if (empty($src)) {
                continue;
            }

            wp_register_style($handle, $src, (array) $style['deps'], $style['ver'], $style['media']);

            if ($style['autoload']) {
                wp_enqueue_style($handle);
            }
        }
    }

    /**
     * Adds custom attributes to tag if is enabled
     *
     * @since   1.0.0
     *
     * @param   string    $tag
     * @param   string    $handle
     * @return  string
     */
    public function style_loader_tag(string $tag, string $handle)
    {
        // No needed to modify the tag
        if (empty($this->admin_styles[$handle]) || empty($this->styles[$handle])) {
            return $tag;
        }

        if (is_admin()) {
            $attr = $this->admin_styles[$handle]['attribute'] ?? [];
        } else {
            $attr = $this->styles[$handle]['attribute'] ?? [];
        }

        if (!empty($attr)) {
            $tag  = str_replace(' />', ' ' . Html::parse_attributes($attr) . ' />', $tag);
        }

        return $tag;
    }
}
