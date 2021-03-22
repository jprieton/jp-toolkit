<?php

/**
 * Class SampleTest
 *
 * @package SourceFramework
 */

/**
 * Check if constants are defined.
 */
class ConstantsTest extends WP_UnitTestCase {

  /**
   * Check if constants are defined.
   */
  function test_constants_defined() {
    // 9 tests
    $items = [
        'JPTOOLKIT_VERSION',
        'JPTOOLKIT_FILENAME',
    ];

    foreach ( $items as $item ) {
      $this->assertTrue( defined( $item ) );
    }
  }

}
