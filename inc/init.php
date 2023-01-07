<?php

/**
 * These functions are needed to load JP Toolkit.
 *
 * @package JP Toolkit
 */

/**
 * Initialize the plugin.
 *
 * @since 	{VERSION}
 * @author 	Javier Prieto
 * @return  void
 */
function jp_toolkit_init(): void
{
	// Run the updater/installer.
	JPToolkit\Core\Install::init();

	// Add non-default cron schedules
	JPToolkit\Schedule::init();

	// Initialize html handlers.
	JPToolkit\Template\Init::init();

	// Initialize admin
	JPToolkit\Admin::init();

	// Init sanitize presets
	new JPToolkit\Framework\Sanitize\SanitizePresets;
}
