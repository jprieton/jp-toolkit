<?php

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Schedule
 */

namespace JPToolkit\Schedule;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Schedule
 */
abstract class AbstractScheduleEvent
{
	/**
	 * Action hook
	 *
	 * @since 2.0.1
	 * @var string
	 */
	protected $action = '';

	/**
	 * Interval to schedule cron task
	 *
	 * @since 2.0.1
	 * @var string
	 */
	protected $interval = 'daily';

	/**
	 * Class constructor
	 *
	 * @since 2.0.1
	 */
	public function __construct()
	{
		// Add the action hook
		$this->schedule_event();
	}

	/**
	 * Add cron task to update pageviews
	 *
	 * @since  2.0.1
	 * @return void
	 */
	public function schedule_event()
	{
		// Add schedule event
		add_action($this->action, [$this, 'event_handler']);
		if (!wp_next_scheduled($this->action)) {
			wp_schedule_event(time(), $this->interval, $this->action);
		}
	}
}
