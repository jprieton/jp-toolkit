<?php

/**
 * Class SampleTest
 *
 * @package JPToolkit
 */

use JPToolkit\Settings\SettingsGroup;

/**
 * Check if constants are defined.
 */
class SettingsGroupTest extends WP_UnitTestCase
{

	/**
	 * Check if constants are defined.
	 */
	function test_not_existing_settings()
	{
		// Chech
		$settings = new SettingsGroup('not_existing_group');
		$this->assertEquals(false, $settings->get_option('not_existing_field'));
		$this->assertEquals('default', $settings->get_option('not_existing_field', 'default'));
	}


	/**
	 * Check if constants are defined.
	 */
	function test_add_settings()
	{
		// Check
		$settings = new SettingsGroup('test_settings');
		$settings->set_option('test_field', 'test_value');

		// The settings should be saved in the database
		$expected_option = [
			'test_field' => 'test_value',
		];
		$diff = array_diff(get_option('test_settings'), $expected_option);

		// The difference should be empty
		$this->assertTrue(empty($diff));

		// Must be the setted value
		$this->assertEquals('test_value', $settings->get_option('test_field'));

		// The option is set, must ignore the default value
		$this->assertEquals('test_value', $settings->get_option('test_field', 'default'));
	}
}
