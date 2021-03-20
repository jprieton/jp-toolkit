<?php

/**
 * Abstract class to extends the way of register and/or enquque styles and scripts 
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 */

namespace JPToolkit\AssetsHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Abstract class to extends the way of register and/or enquque styles and scripts 
 *
 * @package       JPToolkit
 * @subpackage    AssetsHelper
 * @since         1.0.0
 * @author        Javier Prieto
 */
trait TraitAssets
{
    /**
     * List of assets handlers
     */
    private static $assets = [];

    /**
     * List of admin assets handlers
     */
    private static $admin_assets = [];

    /**
     * Register asset
     * 
     * @since 1.0.0
     * 
     * @param string $handle
     * @param array $data
     */
    public static function register_asset(string $handle, array $data)
    {
        if (!isset(self::$assets[$handle])) {
            self::$assets[$handle] = $data;
        }
    }

    /**
     * Register admin asset
     * 
     * @since 1.0.0
     * 
     * @param string $handle
     * @param array $data
     */
    public static function register_admin_asset(string $handle, array $data)
    {
        if (!isset(self::$admin_assets[$handle])) {
            self::$admin_assets[$handle] = $data;
        }
    }

    /**
     * Register admin asset
     * 
     * @since 1.0.0
     * 
     * @param string $handle
     * @return array
     */
    private function get_attributes(string $handle)
    {
        $attr = [];
       
        if (is_admin() && !empty(self::$admin_assets[$handle])) {
            $attr = self::$admin_assets[$handle]['attr'] ?? [];
        } elseif (!is_admin() && !empty(self::$assets[$handle])) {
            $attr = self::$assets[$handle]['attr'] ?? [];
        }
        
        return $attr;
    }

    /**
     * Return the asset src
     * 
     * @since 1.0.0
     * 
     * @param array $asset
     * @return string
     */
    private function get_src(array $asset)
    {
        $use_cdn = true; // TODO: Get setting from options
        if ($use_cdn) {
            $src = $asset['cdn'] ?? $asset['local'] ?? null;
        } else {
            $src = $asset['local'] ?? $asset['cdn'] ?? null;
        }

        return $src;
    }
}
