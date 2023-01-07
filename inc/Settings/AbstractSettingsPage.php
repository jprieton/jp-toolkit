<?php

/**
 * Settings_Page abstract class
 *
 * @package       JPToolkit
 * @subpackage    Abstracts
 * @since         1.0.0
 * @author        Javier Prieto
 */

namespace JPToolkit\Settings;

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Settings_Page abstract class
 *
 * @package       JPToolkit
 * @subpackage    Abstracts
 * @since         1.0.0
 * @author        Javier Prieto
 */
abstract class AbstractSettingsPage
{

	/**
	 * Page title
	 * @since   1.0.0
	 * @var     string
	 */
	protected $page_title;

	/**
	 * Page description
	 * @since   1.0.0
	 * @var     string
	 */
	protected $page_description;

	/**
	 * Option name
	 * @since   1.0.0
	 * @var     string
	 */
	protected $option_name;

	/**
	 * Option group
	 * @since   1.0.0
	 * @var     string
	 */
	protected $option_group;

	/**
	 * Option page
	 * @since   1.0.0
	 * @var     string
	 */
	protected $option_page;

	/**
	 * Page menu slug
	 * @since   1.0.0
	 * @var     string
	 */
	protected $menu_slug;

	/**
	 * Page submenu slug
	 * @since   1.0.0
	 * @var     string
	 */
	protected $submenu_slug;

	/**
	 * Array of setting sections in current page
	 * @since   1.0.0
	 * @var     array
	 */
	protected $sections = [];

	/**
	 * Constructor
	 *
	 * @since   1.0.0
	 *
	 * @param   string      $menu_slug
	 * @param   string      $submenu_slug
	 */
	public function __construct($menu_slug = '', $submenu_slug = '')
	{
		$this->menu_slug    = $menu_slug ?: $this->menu_slug;
		$this->submenu_slug = $submenu_slug ?: $this->menu_slug;
		if (!empty($this->option_group) && !empty($this->option_name)) {
			register_setting($this->option_group, $this->option_name);
		}
	}

	/**
	 * Add a top-level menu page.
	 *
	 * @since   1.0.0
	 *
	 * @param   string      $page_title
	 * @param   string      $menu_title
	 * @param   string      $capability
	 * @param   string      $icon_url
	 * @param   int         $position
	 */
	public function add_menu_page($page_title, $menu_title, $capability, $icon_url = 'dashicons-admin-generic', $position = null)
	{
		$this->page_title = $page_title;
		add_menu_page($page_title, $menu_title, $capability, $this->menu_slug, [$this, 'render_menu_page'], $icon_url, $position);
	}

	/**
	 * Add a submenu page.
	 *
	 * @since   1.0.0
	 *
	 * @param   string      $page_title
	 * @param   string      $menu_title
	 * @param   string      $capability
	 */
	public function add_submenu_page($page_title, $menu_title, $capability)
	{
		$this->page_title = $page_title;
		add_submenu_page($this->menu_slug, $page_title, $menu_title, $capability, $this->submenu_slug, [$this, 'render_menu_page']);
	}

	/**
	 * Add a new section to a settings page.
	 *
	 * @since   1.0.0
	 *
	 * @param   string         $id
	 * @param   string         $title
	 */
	public function add_settings_section($id, $title = '')
	{
		$this->sections[] = $id;
		add_settings_section($id, $title, '__return_null', $this->submenu_slug);
	}

	/**
	 * Render setting page
	 *
	 * @since 1.0.0
	 */
	public function render_menu_page()
	{
		// Get the default settings page template.
		jp_toolkit_get_template_part('admin/settings/page', null, [
			'page_title' => $this->page_title,
			'page_description' => $this->page_description,
			'submenu_slug' => $this->submenu_slug,
			'sections' => $this->sections,
		]);
	}
}
