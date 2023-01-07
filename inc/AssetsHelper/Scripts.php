<?php

/**
 * The Scripts class is a helper that extends the way of register and enquque scripts
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 */

namespace JPToolkit\AssetsHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\HtmlHelper\Html;

/**
 * The Scripts class is a helper that extends the way of register and enquque scripts
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 * @since         1.0.0
 * @author        Javier Prieto
 */
class Scripts
{
    use TraitAssets;

    /**
     * Default args
     */
    private $defaults = [
        'local'     => null,
        'cdn'       => null,
        'deps'      => [],
        'ver'       => null,
        'enqueue'   => true,
        'attr'      => null,
        'in_footer' => true,
    ];

    /**
     * Initialize and add hooks
     *
     * @since   1.0.0
     */
    public function init()
    {
        // Register and enqueue scripts
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);

        // Add custom attributes to tag if is needed
        add_action('script_loader_tag', [$this, 'script_loader_tag'], 20, 2);
    }

    /**
     * Enqueue scripts
     *
     * @since   1.0.0
     */
    public function enqueue_scripts()
    {
        $assets = apply_filters('jp_toolkit_enqueue_scripts', self::$assets);

        foreach ($assets as $handle => $asset) {
            $asset = wp_parse_args($asset, $this->defaults);

            $src = $this->get_src($asset);
            if (empty($src)) {
                continue;
            }

            wp_register_script($handle, $src, (array) $asset['deps'], $asset['ver'], $asset['in_footer']);

            if ($asset['enqueue']) {
                wp_enqueue_script($handle);
            }
        }
    }

    /**
     * Enquque scripts
     *
     * @since   1.0.0
     */
    public function enqueue_admin_scripts()
    {
        $assets = apply_filters('jp_toolkit_enqueue_admin_scripts', self::$admin_assets);

        foreach ($assets as $handle => $asset) {
            $asset = wp_parse_args($asset, $this->defaults);

            $src = $this->get_src($asset);
            if (empty($src)) {
                continue;
            }

            wp_register_script($handle, $src, (array) $asset['deps'], $asset['ver'], $asset['in_footer']);

            if ($asset['enqueue']) {
                wp_enqueue_script($handle);
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
    public function script_loader_tag(string $tag, string $handle)
    {
        $attr = $this->get_attributes($handle);
        if (!empty($attr)) {
            $tag  = str_replace('></script>', ' ' . Html::parse_attributes($attr) . '></script>', $tag);
        }

        return $tag;
    }
}
