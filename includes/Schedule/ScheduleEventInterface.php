<?php

/**
 * Interface to add scheduled events
 * 
 * @since       {SINCE_VERSION}
 * @version     {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */

namespace JPToolkit\Schedule;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Interface to add scheduled events
 * 
 * @since       {SINCE_VERSION}
 * @version     {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */
interface ScheduleEventInterface
{
    public function do_event();
}
