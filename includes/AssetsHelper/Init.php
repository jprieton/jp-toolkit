<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    JPToolkit
 */

namespace JPToolkit\AssetsHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * This class is required to initialize the assets
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
class Init
{

    /**
     * Additional hint list to add to the header
     */
    private $hints = [
        'dns-prefetch' => [],
        'preconnect'   => [],
        'prefetch'     => [],
        'prerender'    => [],
    ];

    /**
     * Constructor class
     *
     * @since         1.1.0
     */
    public function __construct()
    {
        // Initialize Stylesheets
        new Stylesheets();

        // Add preconnect tags
        add_filter('wp_resource_hints', [$this, 'resource_hints'], 99, 2);
    }

    /**
     * Add resource hints to header
     * 
     * @since         1.1.0
     */
    public function resource_hints(array $urls, string $relation_type)
    {

        foreach ($urls as $url) {
            switch ($url) {
                case 'fonts.googleapis.com': // Google Fonts
                    $this->add_hint('preconnect', 'https://fonts.gstatic.com');
                    break;
            }
        }

        return array_merge($urls, $this->hints[$relation_type] ?? []);
    }

    /**
     * Add resource hints to list
     * 
     * @since         1.1.0
     */
    private function add_hint(string $relation_type, string $url)
    {
        if (!in_array($url, $this->hints[$relation_type])) {
            $this->hints[$relation_type][] = $url;
        }
    }
}
