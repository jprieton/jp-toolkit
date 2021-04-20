<?php

/**
 * User Capabilities
 *
 * @package        JPToolkit
 * @subpackage     User
 */

namespace JPToolkit\Tools;

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die('Direct access is forbidden.');
}

use WP_User;

/**
 * User Capabilities
 *
 * @package        JPToolkit
 * @subpackage     User
 * @since          1.0.0
 * @author         Javier Prieto
 */
class Capabilities
{
    /**
     * Check if the user has roles assigned
     * 
     * @since          1.0.0
     * 
     * @param string|array $roles
     * @param int $user_id
     * @return bool
     */
    public static function has_role($roles, $user_id = null)
    {
        if (null == $user_id) {
            if (!is_user_logged_in()) {
                return false;
            }

            $user = wp_get_current_user();
        } else {
            $user = new WP_User($user_id);
        }

        return (bool) array_intersect((array) $roles, $user->roles ?? []);
    }
}
