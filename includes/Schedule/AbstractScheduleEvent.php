<?php

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {SINCE_VERSION}
 * @version     {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */

namespace JPToolkit\Schedule;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

use JPToolkit\Ajax\AbstractAjax;

/**
 * Class to add scheduled events
 *
 * @author      Javier Prieto
 * @since       {SINCE_VERSION}
 * @version     {VERSION}
 * @package     JPToolkit
 * @subpackage  Schedule
 */
abstract class AbstractScheduleEvent extends AbstractAjax
{
  /**
   * Action hook
   * 
   * @since {SINCE_VERSION}
   * @var string
   */
  protected $action = '';

  /**
   * Interval to schedule cron task
   *
   * @since {SINCE_VERSION}
   * @var string
   */
  protected $interval = 'daily';

  /**
   * Class constructor
   *
   * @since {SINCE_VERSION}
   */
  public function __construct()
  {
    // Add the action hook
    $this->schedule_event();
    
    // If the AJAX endpoint is enabled, add the AJAX hooks
    $this->add_ajax_hooks();
  }

  /**
   * Add cron task to update pageviews
   *
   * @since  {SINCE_VERSION}
   * @return void
   */
  public function schedule_event()
  {
    // Add schedule event
    add_action($this->action, [$this, 'do_event']);
    if (!wp_next_scheduled($this->action)) {
      wp_schedule_event(time(), $this->interval, $this->action);
    }
  }

  /**
   * When Ajax is enabled and the endpoint is called, do the event
   *
   * @since  {SINCE_VERSION}
   * @return void
   */
  public function ajax_handler() {
    do_action($this->action);
  }
}
