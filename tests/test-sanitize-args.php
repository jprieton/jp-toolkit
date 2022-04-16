<?php

use JPToolkit\Framework\Sanitize\Sanitize;


class Test_Sanitize_Args extends WP_UnitTestCase
{

	public function test_sanitize_callback()
	{
		$tests = [
			// Test chained callback
			[
				'test'     => [' hello ', 'hello ', ' hello', 'hello'],
				'expected' => 'HELLO',
				'args'     => [
					'callback' => ['trim', 'strtoupper'],
				],
			],

			// Test default value
			[
				'test'     => ['', null],
				'expected' => 'Hello',
				'args'     => [
					'default' => 'Hello',
				],
			],

			// Test preset
			[
				'test'     => ['yes', 'true', '1', true, 1],
				'expected' => 'yes',
				'args'     => [
					'preset' => 'yes_no',
				],
			],

			// Test preset shorthand
			[
				'test'     => ['no', 'false', '0', false, 0],
				'expected' => 'no',
				'args'     => 'yes_no',
			],

			// Test no args
			[
				'test'     => ['Hello world! '],
				'expected' => 'Hello world! ',
				'args'     => null,
			],
		];

		foreach ($tests as $item) {
			foreach ($item['test'] as $value) {
				$this->assertEquals(
					$item['expected'],
					Sanitize::sanitize($value, $item['args'])
				);
			}
		}
	}
}
