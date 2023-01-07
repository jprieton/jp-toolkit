<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    Template
 */

namespace JPToolkit\Template;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use JPToolkit\Template\Handlers\OptionsMonthsHandler;
use JPToolkit\Template\Handlers\OptionsWeekdaysHandler;
use JPToolkit\Template\Handlers\ImgPixelHandler;
use JPToolkit\Template\Shortcodes;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @subpackage    Template
 * @author        Javier Prieto
 * @since         1.1.0
 */
class Init
{
	/**
	 * Self instance
	 *
	 * @var Init
	 */
	private static $instance = null;

	/**
	 * Constructor class
	 *
	 * @since         1.1.0
	 */
	private function __construct()
	{
		// Add handlers
		add_action('init', [$this, 'add_html_img_handlers']);
		add_action('init', [$this, 'add_form_options_handlers']);
	}

	/**
	 * Initialize the class.
	 *
	 * @since 	{VERSION}
	 * @author 	Javier Prieto
	 * @return  void
	 */
	public static function init(): Init
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Adds Html::img handlers
	 *
	 * @since         1.1.0
	 */
	public function add_html_img_handlers()
	{
		new ImgPixelHandler();
	}

	/**
	 * Adds Form::options handlers
	 *
	 * @since         1.1.0
	 */
	public function add_form_options_handlers()
	{
		new OptionsMonthsHandler();
		new OptionsWeekdaysHandler();
	}

	/**
	 * Adds shortcodess
	 *
	 * @since         1.3.0
	 */
	public function add_shortcodes_handlers()
	{
		new Shortcodes();
	}
}
