<?php

use JPToolkit\Template\Loader as TemplateLoader;

/**
 * Loads a template part into a template.
 *
 * Provides a simple mechanism for child themes to overload reusable sections of code
 * in the theme.
 *
 * Includes the named template part for a theme or if a name is specified then a
 * specialised part will be included. If the theme contains no {slug}.php file
 * then no template will be included.
 *
 * The template is included using require, not require_once, so you may include the
 * same template part multiple times.
 *
 * For the $name parameter, if the file is called "{slug}-special.php" then specify
 * "special".
 *
 * @since 2.0.1
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array  $args Optional. Additional arguments passed to the template.
 *                     Default empty array.
 * @return void|false Void on success, false if the template does not exist.
 */
function jp_toolkit_get_template_part($slug, $name = null, $args = array())
{
	/**
	 * Fires before the specified template part file is loaded.
	 *
	 * The dynamic portion of the hook name, `$slug`, refers to the slug name
	 * for the generic template part.
	 *
	 * @since 2.0.1
	 *
	 * @param string      $slug The slug name for the generic template.
	 * @param string|null $name The name of the specialized template.
	 * @param array       $args Additional arguments passed to the template.
	 */
	do_action("get_template_part_{$slug}", $slug, $name, $args);

	static $template_loader;

	// If the template loader is not set, create it.
	if (empty($template_loader)) {
		$plugin_template_path = plugin_dir_path(JPTOOLKIT_FILENAME) . 'templates/';
		$theme_template_path  = get_template_directory() . '/jp-toolkit/';
		$template_loader      = new TemplateLoader($plugin_template_path, $theme_template_path, 'jp_toolkit');
	}

	return $template_loader->get_template_part($slug, $name, $args);
}
