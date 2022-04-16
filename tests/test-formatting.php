<?php

class TestFormatting extends WP_UnitTestCase
{

	public function test_sanitize_yes_no()
	{
		$tests = [
			// Empty values
			[
				'test'     => ['', null],
				'expected' => 'no',
			],
			// Boolean values
			[
				'test'     => [true],
				'expected' => 'yes',
			],
			[
				'test'     => [false],
				'expected' => 'no',
			],
			// String values
			[
				'test'     => ['yes', 'Yes', 'YES', 'yEs', 'YeS', 'y', 'Y', ' Y '],
				'expected' => 'yes',
			],
			[
				'test'     => ['no', 'No', 'NO', 'nO', 'n', 'N', ' N '],
				'expected' => 'no',
			],
			// Numeric values
			[
				'test'     => [1, 2, -1, '1'],
				'expected' => 'yes',
			],
			[
				'test'     => [0, '0'],
				'expected' => 'no',
			],
			// Invalid values
			[
				'test'     => [new stdClass(), [], 'hello'],
				'expected' => 'no',
			],
		];

		foreach ($tests as $item) {
			foreach ($item['test'] as $value) {
				$this->assertEquals($item['expected'], jp_toolkit_sanitize_yes_no_field($value));
			}
		}
	}
}
