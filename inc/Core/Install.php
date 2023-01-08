<?php

/**
 * Installation related functions and actions.
 *
 * @package     JPToolkit
 * @subpackage  Core
 * @version 	2.0.1
 */


namespace JPToolkit\Core;

/**
 * Installation related functions and actions.
 *
 * @package     JPToolkit
 * @subpackage  Core
 * @version 	2.0.1
 */
class Install
{
	const PREFIX = 'jptoolkit';

	/**
	 * DB updates and callbacks that need to be run per version.
	 *
	 * Please note that these functions are invoked when is updated from a previous version,
	 * but NOT when is newly installed.

	 * @var array
	 */
	private static $db_updates = [
		'1.1.2' => [
			''
		]
	];

	/**
	 * Hook in tabs.
	 *
	 * @return void
	 */
	public static function init(): void
	{
		add_action('init', array(__CLASS__, 'check_version'), 5);
	}

	/**
	 * Check current version and run the updater is required.
	 *
	 * This check is done on all requests and runs if the versions do not match.
	 *
	 * @return void
	 */
	public static function check_version(): void
	{
		if (self::needs_db_update()) {
			self::install();
		}
	}

	/**
	 * Get list of DB update callbacks.
	 *
	 * @return array
	 */
	private static function get_db_update_callbacks()
	{
		return self::$db_updates;
	}

	/**
	 * Is a DB update needed?
	 *
	 * @return boolean
	 */
	public static function needs_db_update(): bool
	{
		$current_db_version = get_option(self::PREFIX . '_db_version', null);
		if (null == $current_db_version) {
			return true;
		}

		$updates         = self::get_db_update_callbacks();
		$update_versions = array_keys($updates);
		usort($update_versions, 'version_compare');

		return version_compare($current_db_version, end($update_versions), '<');
	}

	/**
	 * Returns true if we're installing.
	 *
	 * @return bool
	 */
	private static function is_installing()
	{
		return 'yes' === get_transient(self::PREFIX . '_installing');
	}

	/**
	 * Install JP Toolkit.
	 *
	 * @return void
	 */
	public static function install(): void
	{
		// Check if we are not already running this routine.
		if (self::is_installing()) {
			return;
		}

		// If we made it till here nothing is running yet, lets set the transient now.
		set_transient(self::PREFIX . '_installing', 'yes', MINUTE_IN_SECONDS * 10);

		self::maybe_update_db_version();

		// Done with the routine, delete the transient.
		delete_transient(self::PREFIX . '_installing');

		// Run after DomiPress has been installed or updated.
		do_action(self::PREFIX . '_installed');
	}

	/**
	 * Push all needed DB updates to the queue for processing.
	 *
	 * @return void
	 */
	private static function update()
	{
		// Get current DB version.
		$current_db_version = get_option(self::PREFIX . '_db_version', null);

		// Loop over the updates and run them.
		foreach (self::get_db_update_callbacks() as $version => $callback) {
			// TODO: Move to a scheduled action
			if (version_compare($current_db_version, $version, '<')) {
				self::do_callback($callback, $current_db_version);
			}
		}
	}

	/**
	 * Run a callback if it exists.
	 *
	 * @param string|array $callback
	 * @param string $version
	 * @return void
	 */
	private static function do_callback($callback, $version): void
	{
		if (is_array($callback)) {
			foreach ($callback as $cb) {
				self::do_callback($cb, $version);
			}
		} elseif (is_callable($callback)) {
			call_user_func($callback, $version);
		}
	}


	/**
	 * See if we need to show or run database updates during install.
	 *
	 * @return void
	 */
	private static function maybe_update_db_version(): void
	{
		if (self::needs_db_update()) {
			self::update();
		}
	}
}
