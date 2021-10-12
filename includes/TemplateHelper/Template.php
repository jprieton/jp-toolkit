<?php

/**
 * The Template allows to user custom paths to retrieve templates
 * commonly used HTML form tags.
 *
 * @package       JPToolkit
 * @subpackage    TemplateHelper
 */

namespace JPToolkit\TemplateHelper;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * This class is required to initialize TemplateHelper options
 *
 * @package       JPToolkit
 * @subpackage    TemplateHelper
 * @since         1.2.0
 * @author        Javier Prieto
 */
class Template
{
    /**
     * Path of template folder in the plugin
     *
     * @var string
     */
    private $template_path   = '';

    /**
     * Path of template folder in the theme, this allow override plugins template
     *
     * @var string
     */
    private $stylesheet_path = '';

    /**
     * Slug to allow fire custom actions 
     *
     * @var string
     */
    private $namespace       = '';

    /**
     * Class Constructor
     *
     * @param string $template_path     Absolute path of your template folder in your plugin
     * @param string $stylesheet_path   Relative path of your template folder in your theme
     * @param string $namespace         Optional, this is used to prefix actions
     */
    public function __construct($template_path, $stylesheet_path, $namespace = '')
    {
        $this->template_path = $template_path;
        $this->stylesheet_path = STYLESHEETPATH . '/' . $stylesheet_path;
        $this->namespace = $namespace;
    }

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
     * @since 1.2.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array  $args Optional. Additional arguments passed to the template.
     *                     Default empty array.
     * @return void|false Void on success, false if the template does not exist.
     */
    public function get_template_part($slug, $name = null, $args = [])
    {
        $templates = [];
        $name      = (string) $name;
        if ('' !== $name) {
            $templates[] = "{$slug}-{$name}.php";
        }

        $templates[] = "{$slug}.php";


        if (!empty($this->namespace)) {
            /**
             * Fires before a template part is loaded.
             *
             * @since 1.2.0
             *
             * @param string   $slug      The slug name for the generic template.
             * @param string   $name      The name of the specialized template.
             * @param string[] $templates Array of template files to search for, in order.
             * @param array    $args      Additional arguments passed to the template.
             */
            do_action("{$this->namespace}_get_template_part", $slug, $name, $templates, $args);
        }

        if (!$this->locate_template($templates, true, false, $args)) {
            return false;
        }
    }

    /**
     * Retrieve the name of the highest priority template file that exists.
     *
     * Searches in the $stylesheet_path before $template_path and wp-includes/theme-compat
     * so that themes which inherit from a parent theme can just overload one file.
     *
     * @since 1.2.0
     *
     * @param string|array $templates      Template file(s) to search for, in order.
     * @param bool         $load           If true the template file will be loaded if it is found.
     * @param bool         $require_once   Whether to require_once or require. Has no effect if `$load` is false.
     *                                     Default true.
     * @param array        $args           Optional. Additional arguments passed to the template.
     *                                     Default empty array.
     * @return string The template filename if one is located.
     */
    public function locate_template($templates, $load = false, $require_once = true, $args = [])
    {

        $located = '';
        foreach ((array) $templates as $template) {
            if (!$template) {
                continue;
            }

            if (file_exists($this->stylesheet_path . '/' . $template)) {
                $located = $this->stylesheet_path . '/' . $template;
                break;
            } elseif (file_exists($this->template_path . '/' . $template)) {
                $located = $this->template_path . '/' . $template;
                break;
            }
        }

        if ($load && '' !== $located) {
            load_template($located, $require_once, $args);
        }

        return $located;
    }
}
