<?php

/**
 * Interface to add scheduled events
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
 * Interface to add scheduled events
 *
 * @author      Javier Prieto
 * @since       2.0.1
 * @package     JPToolkit
 * @subpackage  Schedule
 */
interface ScheduleEventInterface
{
	/**
	 * Shcedule event handler
	 *
	 * @since   2.0.1
	 * @return  void
	 */
	public function event_handler();
}
