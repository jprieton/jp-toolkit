<?php

namespace JPToolkit\Admin;

defined('ABSPATH') || exit;

use JPToolkit\Settings\AbstractSettingsPage;
use JPToolkit\Settings\SettingsGroupField;

/**
 * Advanced_Page class
 *
 * @package        JPToolkit
 * @subpackage     Admin
 * @since          2.0.0
 * @author         Javier Prieto
 */
final class AdvancedPage extends AbstractSettingsPage
{

	/**
	 * Option group
	 * @since   1.0.0
	 * @var     string
	 */
	protected $option_group = 'jptoolkit-advanced-settings';

	/**
	 * Option page slug
	 * @since   1.0.0
	 * @var     string
	 */
	protected $option_page = 'jptoolkit-advanced-settings';

	/**
	 *
	 * @var SettingsGroupField
	 */
	private $settings_group_field;

	/**
	 * Constructor
	 *
	 * @since 2.0.0
	 */
	public function __construct()
	{
		$this->option_name          = 'jptoolkit-advanced_settings';
		$this->settings_group_field = new SettingsGroupField($this->option_name);

		// Append to the Settings menu
		parent::__construct('options-general.php', $this->option_page);

		// Initialize menus
		add_action('admin_menu', [$this, 'add_advanced_page']);
		// Initialize settings
		add_action('admin_init', [$this, 'add_cdn_settings_section']);
	}

	/**
	 * Add Advanced page to Settings menu
	 *
	 * @since 2.0.0
	 */
	public function add_advanced_page()
	{
		parent::add_submenu_page(__('Advanced Settings', 'jp-toolkit'), __('Advanced', 'jp-toolkit'), 'activate_plugins');
	}

	/**
	 *
	 * @since 2.0.0
	 */
	public function add_cdn_settings_section()
	{
		$this->add_settings_section('section-advanced-cdn');

		$fields = [
			'title'   => __('CDN', 'jp-toolkit'),
			'type'    => 'checkbox',
			'options' => [
				[
					'id'    => 'cdn-enabled',
					'desc'  => __('Enables the <strong>Content Distribution Network (CDN)</strong> for scripts/styles registered with <code>remote</code> attribute defined.', 'jp-toolkit') . ' ' .
						sprintf(__('<a href="%s" target="_blank">Learn more</a>.', 'jp-toolkit'), '#'),
					'label' => __('Enable CDN', 'jp-toolkit'),
				],
			],
		];

		$this->settings_group_field->add_settings_field($this->submenu_slug, 'section-advanced-cdn', $fields);
	}

	/**
	 *
	 * @since 2.0.0
	 */
	public function add_post_settings_section()
	{
		$this->add_settings_section('section-advanced-post');

		$fields = [
			'title'   => __('Featured', 'jp-toolkit'),
			'type'    => 'checkbox',
			'options' => [
				[
					'id'    => 'featured-posts-enabled',
					'label' => __('Enable the featured capability for post, pages and custom post types', 'jp-toolkit'),
				],
			],
		];

		$this->settings_group_field->add_settings_field($this->submenu_slug, 'section-advanced-post', $fields);

		$post_types = get_post_types_by_support(['excerpt']);

		if (empty($post_types)) {
			return;
		}

		global $wp_post_types;

		$options = [];

		foreach ($post_types as $post_type) {
			$options[] = [
				'value' => $post_type,
				'label' => $wp_post_types[$post_type]->labels->singular_name
			];
		}

		$fields = [
			'title'    => __('WYSIWYG Excerpt', 'jp-toolkit'),
			'id'       => 'wysiwyg_excerpt',
			'type'     => 'checkbox',
			'multiple' => true,
			'options'  => $options
		];

		$this->settings_group_field->add_settings_field($this->submenu_slug, 'section-advanced-post', $fields);
	}
}
