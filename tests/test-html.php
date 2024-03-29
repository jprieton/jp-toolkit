<?php

use JPToolkit\Template\Html;

/**
 * Sample test case.
 */
class TestHtml extends WP_UnitTestCase {

  /**
   * A single example test.
   */
  function test_html() {
    // Test shorhands
    $shorthands = [
        'div'                  => '<div></div>',
        'div.class1'           => '<div class="class1"></div>',
        'div.class1#id'        => '<div id="id" class="class1"></div>',
        '.class1'              => '<div class="class1"></div>',
        '.class1#id'           => '<div id="id" class="class1"></div>',
        'div.class1.class2'    => '<div class="class1 class2"></div>',
        'div.class1.class2#id' => '<div id="id" class="class1 class2"></div>',
        '.class1.class2'       => '<div class="class1 class2"></div>',
        '.class1.class2#id'    => '<div id="id" class="class1 class2"></div>',
    ];

    foreach ( $shorthands as $shorthand => $result ) {
      $this->assertEquals( $result, Html::tag( $shorthand ) );
    }

    // Test empty tags
    $empty_tags = [
        'img'  => '<img />',
        'br'   => '<br />',
        'hr'   => '<hr />',
        'link' => '<link />',
    ];

    foreach ( $empty_tags as $tag => $result ) {
      $this->assertEquals( $result, Html::tag( $tag ) );
    }

    // Test open tags
    $open_tags = [
        'img'                  => '<img />',
        'img.class1'           => '<img class="class1" />',
        'img.class1#id1'       => '<img id="id1" class="class1" />',
        'br'                   => '<br />',
        'hr'                   => '<hr />',
        'div'                  => '<div>',
        'div.class1'           => '<div class="class1">',
        'div.class1#id'        => '<div id="id" class="class1">',
        '.class1'              => '<div class="class1">',
        '.class1#id'           => '<div id="id" class="class1">',
        'div.class1.class2'    => '<div class="class1 class2">',
        'div.class1.class2#id' => '<div id="id" class="class1 class2">',
        '.class1.class2'       => '<div class="class1 class2">',
        '.class1.class2#id'    => '<div id="id" class="class1 class2">',
    ];

    foreach ( $open_tags as $tag => $result ) {
      $this->assertEquals( $result, Html::open( $tag ) );
    }

    // Test close tags
    $close_tags = [
        'img' => '',
        'br'  => '',
        'div' => '</div>',
        'p'   => '</p>',
    ];

    foreach ( $close_tags as $tag => $result ) {
      $this->assertEquals( $result, Html::close( $tag ) );
    }

    // test magic methods
    $this->assertEquals( Html::br(), '<br />' );
    $this->assertEquals( Html::br( 'content' ), '<br />' );
    $this->assertEquals( Html::div(), '<div></div>' );
    $this->assertEquals( Html::div( 'content' ), '<div>content</div>' );
    $this->assertEquals( Html::div( 'content', [ 'class' => 'class1', 'id' => 'id1' ] ), '<div class="class1" id="id1">content</div>' );

    $simple_list = [ 'red', 'blue', 'green', 'yellow' ];
    $nested_list = [
        'colors'  => [ 'red', 'blue', 'green', 'yellow' ],
        'numbers' => [ 'one', 'two', 'three', 'four', ]
    ];
    $attributes  = [ 'class' => 'class1', 'id' => 'id1' ];

    // Test simple lists
    $this->assertEquals( Html::ul( $simple_list ), '<ul><li>red</li><li>blue</li><li>green</li><li>yellow</li></ul>' );
    $this->assertEquals( Html::ul( $simple_list, $attributes ), '<ul class="class1" id="id1"><li>red</li><li>blue</li><li>green</li><li>yellow</li></ul>' );
    $this->assertEquals( Html::ol( $simple_list ), '<ol><li>red</li><li>blue</li><li>green</li><li>yellow</li></ol>' );
    $this->assertEquals( Html::ol( $simple_list, $attributes ), '<ol class="class1" id="id1"><li>red</li><li>blue</li><li>green</li><li>yellow</li></ol>' );

    // Test nested lists
    $this->assertEquals( Html::ul( $nested_list ), '<ul><li>colors<ul><li>red</li><li>blue</li><li>green</li><li>yellow</li></ul></li><li>numbers<ul><li>one</li><li>two</li><li>three</li><li>four</li></ul></li></ul>' );
    $this->assertEquals( Html::ul( $nested_list, $attributes ), '<ul class="class1" id="id1"><li>colors<ul><li>red</li><li>blue</li><li>green</li><li>yellow</li></ul></li><li>numbers<ul><li>one</li><li>two</li><li>three</li><li>four</li></ul></li></ul>' );
    $this->assertEquals( Html::ol( $nested_list ), '<ol><li>colors<ol><li>red</li><li>blue</li><li>green</li><li>yellow</li></ol></li><li>numbers<ol><li>one</li><li>two</li><li>three</li><li>four</li></ol></li></ol>' );
    $this->assertEquals( Html::ol( $nested_list, $attributes ), '<ol class="class1" id="id1"><li>colors<ol><li>red</li><li>blue</li><li>green</li><li>yellow</li></ol></li><li>numbers<ol><li>one</li><li>two</li><li>three</li><li>four</li></ol></li></ol>' );
  }

  /**
   * Tests img tags and shorthands
   *
   * @since 1.1.0
   */
  public function test_img() {
    // Default
    $this->assertEquals( Html::img( 'http://path.to/image.jpg' ), '<img src="http://path.to/image.jpg" />' );
    $this->assertEquals( Html::img( '', [ 'src' => 'http://path.to/image.jpg' ] ), '<img src="http://path.to/image.jpg" />' );
    $this->assertEquals( Html::img( 'http://path.to/image-a.jpg', [ 'src' => 'http://path.to/image-b.jpg' ] ), '<img src="http://path.to/image-a.jpg" />' );

    // Pixel shorthand
    $result = '<img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" '
            . 'height="1" width="1" class="image-size-custom image-pixel" alt="Pixel image" />';
    $this->assertEquals( Html::img( 'pixel' ), $result );
    $this->assertEquals( Html::img( null, [ 'src' => 'pixel' ] ), $result );
    $this->assertEquals( Html::img( 'pixel', [ 'src' => 'http://path.to/image.jpg' ] ), $result );
  }

}
