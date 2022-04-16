<?php

/**
 * Interface to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */

namespace JPToolkit\Framework\Schedule;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Interface to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */
interface ScheduleEventInterface
{
	/**
	 * Shcedule event handler
	 *
	 * @since   {VERSION}
	 * @return  void
	 */
	public function event_handler();
}
