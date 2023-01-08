<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    Template
 */

namespace JPToolkit\Core\Traits;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @subpackage    Template
 * @author        Javier Prieto
 * @since         1.1.0
 */
trait Singleton
{
	/**
	 * Self instance
	 *
	 * @var Init
	 */
	protected static $instance = null;

	/**
	 * Constructor class
	 *
	 * @since         1.1.0
	 */
	protected function __construct()
	{
		// Add handlers
	}

	/**
	 * Initialize the class.
	 *
	 * @since 	2.0.1
	 * @author 	Javier Prieto
	 * @return  self
	 */
	public static function init()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Aliases for the init method
	 *
	 * @since 	2.0.1
	 * @author 	Javier Prieto
	 * @return  self
	 */
	public static function get_instance()
	{
		return self::init();
	}
}
