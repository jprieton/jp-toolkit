<?php

/**
 * This class adds adds non-default cron schedules.
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */

namespace JPToolkit;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * This class adds adds non-default cron schedules.
 *
 * @package       JPToolkit
 * @author        Javier Prieto
 * @since         1.0.0
 */
class Schedule
{
	private static $instance = null;

	/**
	 * Constructor class
	 *
	 * @since         1.1.0
	 */
	private function __construct()
	{
		// Adds non-default cron schedules
		add_filter('cron_schedules', [$this, 'add_cron_schedules'], 999);
	}

	/**
	 * Initialize the schedule module.
	 *
	 * @since     1.0.0
	 * @return	  Schedule
	 */
	public static function init(): Schedule
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Adds non-default cron schedules
	 *
	 * @since     1.0.0
	 * @param     array     $schedules
	 * @return    array
	 */
	public function add_cron_schedules(array $schedules = []): array
	{
		if (!isset($schedules['twicemonthly'])) {
			$schedules['twicemonthly'] = [
				'interval' => MONTH_IN_SECONDS / 2,
				'display'  => __('Twice monthly', 'jp-toolkit'),
			];
		}

		if (!isset($schedules['monthly'])) {
			$schedules['monthly'] = [
				'interval' => MONTH_IN_SECONDS,
				'display'  => __('Once monthly', 'jp-toolkit'),
			];
		}

		return $schedules;
	}
}
