<?php

/**
 * The Init class initializes the Html Helper plugin
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    JPToolkit
 */

namespace JPToolkit;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * This class is required to initialize the shorthands bundled in this plugin
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
final class JPToolkit
{
	/**
	 * Get trait of single
	 */
	use Core\Traits\Singleton;

	/**
	 * Constructor class
	 *
	 * @since 1.1.0
	 */
	protected function __construct()
	{
		// Run the updater/installer.
		Core\Install::init();

		// Add non-default cron schedules
		Schedule::init();

		// Initialize html handlers.
		Template\Init::init();

		// Initialize Assets helpers
		//new AssetsHelper\Init();

		// Initialize admin
		new Admin\Init();

		// Init sanitize presets
		new Framework\Sanitize\SanitizePresets;
	}
}
