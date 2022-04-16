<?php

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Framework\Schedule
 */

namespace JPToolkit\Framework\Schedule;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

use JPToolkit\Ajax\AbstractAjax;

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Framework\Schedule
 */
abstract class AbstractScheduleEvent
{
	/**
	 * Action hook
	 *
	 * @since {VERSION}
	 * @var string
	 */
	protected $action = '';

	/**
	 * Interval to schedule cron task
	 *
	 * @since {VERSION}
	 * @var string
	 */
	protected $interval = 'daily';

	/**
	 * Class constructor
	 *
	 * @since {VERSION}
	 */
	public function __construct()
	{
		// Add the action hook
		$this->schedule_event();
	}

	/**
	 * Add cron task to update pageviews
	 *
	 * @since  {VERSION}
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
