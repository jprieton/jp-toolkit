<?php

/**
 * Remove the orphan data from the database
 *
 * @package        JPToolkit
 * @subpackage     Tools
 */

namespace JPToolkit\Tools;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
  die('Direct access is forbidden.');
}

use wpdb;

/**
 * Remove the orphan data from the database
 *
 * @package        JPToolkit
 * @subpackage     Tools
 * @since          1.0.0
 * @author         Javier Prieto
 */
class CleanDB
{

  /**
   * Schedule clean orphan data from the database
   */
  public function add_cron_schedules()
  {
    if (!get_option('jp_toolkit_clean_orphan_data', false)) {
      return;
    }
    
    // Delete all non-linked metadata from post, terms and comments
    add_action('jp_toolkit_cleandb_delete_orphan_metadata', [$this, 'delete_orphan_metadata']);

    // Delete all non-linked comments 
    add_action('jp_toolkit_cleandb_delete_orphan_comments', [$this, 'delete_orphan_comments']);

    $current_timestamp = current_time('timestamp');
    if (!wp_next_scheduled('jp_toolkit_delete_orphan_metadata')) {
      wp_schedule_event($current_timestamp, 'monthly', 'jp_toolkit_cleandb_delete_orphan_metadata');
    }
    if (!wp_next_scheduled('jp_toolkit_delete_orphan_comments')) {
      wp_schedule_event($current_timestamp, 'monthly', 'jp_toolkit_cleandb_delete_orphan_comments');
    }
  }

  /**
   * Delete all non-linked metadata from post, terms and comments
   *
   * @since   1.0.0
   * @global  wpdb    $wpdb
   */
  public static function delete_orphan_metadata()
  {
    global $wpdb;

    // postmeta
    $wpdb->query("DELETE FROM `{$wpdb->postmeta}` WHERE `post_id` NOT IN ( SELECT `ID` AS `post_id` FROM `{$wpdb->posts}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->postmeta}`");

    // usermeta
    $wpdb->query("DELETE FROM `{$wpdb->usermeta}` WHERE `user_id` NOT IN ( SELECT `ID` AS `user_id` FROM `{$wpdb->users}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->usermeta}`");

    // termmeta
    $wpdb->query("DELETE FROM `{$wpdb->termmeta}` WHERE `term_id` NOT IN ( SELECT `term_id` FROM `{$wpdb->terms}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->termmeta}`");

    // commentmeta
    $wpdb->query("DELETE FROM `{$wpdb->commentmeta}` WHERE `comment_id` NOT IN ( SELECT `comment_ID` AS `comment_id` FROM `{$wpdb->comments}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->commentmeta}`");
  }

  /**
   * Delete all non-linked comments
   *
   * @since   1.0.0
   * @global  wpdb    $wpdb
   */
  public static function delete_orphan_comments()
  {
    global $wpdb;

    // comments
    $wpdb->query("DELETE FROM `{$wpdb->comments}` WHERE `comment_post_ID` NOT IN ( SELECT `ID` AS `comment_post_ID` FROM `{$wpdb->posts}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->comments}`");

    // commentmeta
    $wpdb->query("DELETE FROM `{$wpdb->commentmeta}` WHERE `comment_id` NOT IN ( SELECT `comment_ID` as `comment_id` FROM `{$wpdb->comments}` )");
    $wpdb->query("OPTIMIZE TABLE `{$wpdb->commentmeta}`");
  }
}
