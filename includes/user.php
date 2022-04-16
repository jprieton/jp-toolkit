<?php

// If this file is called directly, abort.
defined('ABSPATH') || exit;

/**
 * Check if the user has any of roles specified in the parameter.
 *
 * @since	{VERSION}
 *
 * @param 	string|array 	$roles		Array of roles
 * @param	int 			$user_id 	User ID, if null current user ID is used
 * @return 	bool
 */
function jp_toolkit_user_has_role(array $roles, $user_id = null): bool
{
	// No user is provided, get the current user ID
	if (null == $user_id) {

		// No user is logged in, return false
		if (!is_user_logged_in()) {
			return false;
		}

		// Get user data
		$user_id = get_current_user_id();
	}

	// Get user data
	$user = new WP_User($user_id);


	return (bool) array_intersect($roles, $user->roles ?? []);
}
