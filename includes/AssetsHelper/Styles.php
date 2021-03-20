<?php

/**
 * The Styles class is a helper that extends the way of register and enquque stylesheets
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 */

namespace JPToolkit\AssetsHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\HtmlHelper\Html;

/**
 * The Styles class is a helper that extends the way of register and enquque stylesheets
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 * @since         1.0.0
 * @author        Javier Prieto
 */
class Styles
{
    use TraitAssets;

    /**
     * Default args
     */
    private $defaults = [
        'local'   => null,
        'cdn'     => null,
        'deps'    => [],
        'ver'     => null,
        'media'   => 'all',
        'enqueue' => true,
        'attr'    => null,
    ];

    /**
     * Initialize and add hooks
     *
     * @since   1.0.0
     */
    public function init()
    {
        // Register and enqueue styles
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);

        // Add custom attributes to tag if is needed
        add_action('style_loader_tag', [$this, 'style_loader_tag'], 20, 2);
    }

    /**
     * Register styles
     *
     * @since   1.0.0
     */
    public function enqueue_styles()
    {
        $assets = apply_filters('jp_toolkit_enqueue_styles', self::$assets);
        foreach ($assets as $handle => $asset) {
            $asset = wp_parse_args($asset, $this->defaults);

            $src = $this->get_src($asset);
            if (empty($src)) {
                continue;
            }

            wp_register_style($handle, $src, (array) $asset['deps'], $asset['ver'], $asset['media']);

            if ($asset['enqueue']) {
                wp_enqueue_style($handle);
            }
        }
    }

    /**
     * Register admin styles
     *
     * @since   1.0.0
     */
    public function enqueue_admin_styles()
    {
        $assets = apply_filters('jp_toolkit_enqueue_admin_styles', self::$admin_assets);

        foreach ($assets as $handle => $asset) {
            $asset = wp_parse_args($asset, $this->defaults);

            $src = $this->get_src($asset);
            if (empty($src)) {
                continue;
            }

            wp_register_style($handle, $src, (array) $asset['deps'], $asset['ver'], $asset['media']);

            if ($asset['autoload']) {
                wp_enqueue_style($handle);
            }
        }
    }

    /**
     * Adds custom attributes to tag if is set
     *
     * @since   1.0.0
     *
     * @param   string    $tag
     * @param   string    $handle
     * @return  string
     */
    public function style_loader_tag(string $tag, string $handle)
    {
        $attr = $this->get_attributes($handle);
        if (!empty($attr)) {
            $tag  = str_replace(' />', ' ' . Html::parse_attributes($attr) . ' />', $tag);
        }

        return $tag;
    }
}
