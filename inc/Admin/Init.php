<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    Admin
 */

namespace JPToolkit\Admin;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * This class is required to initialize admin options
 *
 * @package       JPToolkit
 * @subpackage    Admin
 * @since         1.1.0
 * @author        Javier Prieto
 */
class Init
{
    /**
     * Class constructor
     * 
     * @since 1.1.0
     */
    public function __construct()
    {
        $this->init_theme_customizer();
    }

    /**
     * Initialize theme customizer
     * 
     * @since 1.1.0
     */
    public function init_theme_customizer()
    {
        $login_page = new LoginPageCustomizer();
        $login_page->init();
    }
}
