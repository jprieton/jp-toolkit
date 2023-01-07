<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    Admin
 */

namespace JPToolkit;

use JPToolkit\Admin\AdvancedPage;

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
class Admin
{
	/**
	 * Self instance
	 *
	 * @var Admin
	 */
	private static $instance = null;

	/**
	 * Class constructor
	 *
	 * @since 1.1.0
	 */
	private function __construct()
	{
		//$this->init_theme_customizer();
		new AdvancedPage;
	}

	public static function init(): Admin
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initialize theme customizer
	 *
	 * @since 1.1.0
	 */
	public function init_theme_customizer()
	{
		// $login_page = new LoginPageCustomizer();
		// $login_page->init();
	}
}
