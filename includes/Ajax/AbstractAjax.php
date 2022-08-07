<?php

/**
 * Abstract class to handle AJAX requests.
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Ajax
 */

namespace JPToolkit\Ajax;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Abstract class to handle AJAX requests.
 *
 * @author      Javier Prieto
 * @since       {VERSION}
 * @package     JPToolkit
 * @subpackage  Ajax
 */
abstract class AbstractAjax
{

	/**
	 * AJAX endpoint
	 *
	 * @var		string
	 * @since 	{VERSION}
	 */
	protected string $ajax_action;

	/**
	 * Enable/disable public access to the AJAX endpoint.
	 *
	 * @var 	boolean
	 * @since 	{VERSION}
	 */
	protected bool $allow_public = false;

	/**
	 * Enable/disable private access to the AJAX endpoint.
	 *
	 * @var 	boolean
	 * @since 	{VERSION}
	 */
	protected bool $allow_private = false;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->add_ajax_hooks();
	}

	/**
	 * Add Ajax hooks
	 *
	 * @since 	{VERSION}
	 * @return 	void
	 */
	protected function add_ajax_hooks()
	{
		// If the AJAX endpoint is public, add it to the public AJAX actions.
		if ($this->allow_public && !empty($this->ajax_action)) {
			add_action('wp_ajax_nopriv_' . $this->ajax_action, [$this, 'ajax_handler']);
		}

		// If the AJAX endpoint is private, add it to the private AJAX actions.
		if ($this->allow_private && !empty($this->ajax_action)) {
			add_action('wp_ajax_' . $this->ajax_action, [$this, 'ajax_handler']);
		}
	}
}
