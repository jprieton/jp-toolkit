<?php

/**
 * Allow customize the admin login page.
 *
 * @package       JPToolkit
 * @subpackage    Admin
 */

namespace JPToolkit\Admin;

// Exit if accessed directly.
defined('ABSPATH') || exit;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use WP_Customize_Image_Control;

/**
 * LoginPageCustomizer class
 *
 * @package        JPToolkit
 * @subpackage     Admin
 * @since          1.1.0
 * @author         Javier Prieto
 */
class LoginPageCustomizer
{

    private $stylesheet = '';

    public function init()
    {
        // admin customizer
        add_action('customize_register', [$this, 'login_page']);

        // login page
        add_filter('login_headerurl', [$this, 'login_header_url'], 99);
        add_filter('login_headertext', [$this, 'login_header_title'], 99);
        add_action('login_enqueue_scripts', [$this, 'render_stylesheet'], 99);
    }
    /**
     * Adds the login page menu to theme customizer
     *
     * @since   1.1.0
     *
     * @param WP_Customize_Manager $wp_customize
     */
    public function login_page($wp_customize)
    {
        $section_id = 'jp_toolkit_login_page_customizer_section';

        $wp_customize->add_section($section_id, [
            'title'    => __('Login Page', 'jp-toolkit'),
            'priority' => 1000,
        ]);

        // Page background color
        $wp_customize->add_setting('jp_toolkit_login_page_background_color', ['default' => '#f1f1f1',]);
        $wp_customize->add_control(
            new WP_Customize_Color_Control($wp_customize, 'jp_toolkit_login_page_background_color', [
                'label'    => __('Background color', 'jp-toolkit'),
                'section'  => $section_id,
                'settings' => 'jp_toolkit_login_page_background_color',
            ])
        );

        // Page background image
        $wp_customize->add_setting('jp_toolkit_login_page_background_image');
        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'jp_toolkit_login_page_background_image', [
                'label'    => __('Background image', 'jp-toolkit'),
                'section'  => $section_id,
                'settings' => 'jp_toolkit_login_page_background_image',
            ])
        );

        // Page background image position
        $wp_customize->add_setting('jp_toolkit_login_page_background_position');
        $wp_customize->add_control('jp_toolkit_login_page_background_position', [
            'label'    => __('Background position', 'jp-toolkit'),
            'section'  => $section_id,
            'settings' => 'jp_toolkit_login_page_background_position',
            'type'     => 'select',
            'choices'  => [
                ''        => 'Auto',
                'contain' => 'Contain',
                'cover'   => 'Cover',
                'repeat'  => 'Repeat',
            ]
        ]);

        // Page font color
        $wp_customize->add_setting('jp_toolkit_login_page_font_color', ['default' => '#555d66',]);
        $wp_customize->add_control(
            new WP_Customize_Color_Control($wp_customize, 'jp_toolkit_login_page_font_color', [
                'label'    => __('Font color', 'jp-toolkit'),
                'section'  => $section_id,
                'settings' => 'jp_toolkit_login_page_font_color',
            ])
        );

        // Header image
        $wp_customize->add_setting('jp_toolkit_login_page_header_image');
        $wp_customize->add_control(
            new WP_Customize_Image_Control($wp_customize, 'jp_toolkit_login_page_header_image', [
                'label'       => __('Header image', 'jp-toolkit'),
                'section'     => $section_id,
                'settings'    => 'jp_toolkit_login_page_header_image',
                'description' => __('The custom header is centered and contained in a 320 x 84 pixels block', 'jp-toolkit'),
            ])
        );

        $wp_customize->add_setting('jp_toolkit_login_page_header_url');
        $wp_customize->add_control('jp_toolkit_login_page_header_url', [
            'label'    => __('Header URL', 'jp-toolkit'),
            'section'  => $section_id,
            'settings' => 'jp_toolkit_login_page_header_url',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('jp_toolkit_login_page_header_title');
        $wp_customize->add_control('jp_toolkit_login_page_header_title', [
            'label'    => __('Header Title', 'jp-toolkit'),
            'section'  => $section_id,
            'settings' => 'jp_toolkit_login_page_header_title',
            'type'     => 'text',
        ]);
    }

    /**
     * Replace the header url with custom url
     *
     * @since   1.1.0
     *
     * @param   string $url
     * @return  string
     */
    public function login_header_url($url)
    {
        $custom_url = get_theme_mod('jp_toolkit_login_page_header_url');
        return $custom_url ?: $url;
    }

    /**
     * Replace the header title with custom string
     *
     * @since   1.1.0
     *
     * @param   string $title
     * @return  string
     */
    public function login_header_title($title)
    {
        $custom_title = get_theme_mod('jp_toolkit_login_page_header_title');
        return $custom_title ?: $title;
    }

    /**
     * Replace the header WordPress logo with custom image
     *
     * @since   1.1.0
     */
    public function set_header_image()
    {
        $image = get_theme_mod('jp_toolkit_login_page_header_image');
        if (!empty($image)) {
            return;
        }

        $this->stylesheet .= "
        #login h1 a {
            background-image: url({$image});
            background-position: center;
            background-size: contain;
            height: 84px;
            width: 320px;
        }
        ";
    }

    /**
     * Replace the font color of WordPress login page
     *
     * @since   1.1.0
     */
    public function set_font_color()
    {
        $color = get_theme_mod('jp_toolkit_login_page_font_color');
        if (empty($color)) {
            return;
        }

        $this->stylesheet .= "
        body.login #backtoblog a,
        body.login #nav a {
            color: {$color};
        }
        ";
    }

    /**
     * Set the background color of WordPress login page
     *
     * @since   1.1.0
     */
    public function set_background_color()
    {
        $color = get_theme_mod('jp_toolkit_login_page_background_color');
        if (empty($color)) {
            return;
        }

        $this->stylesheet .= "
        body.login {
            background-color: {$color};
        }
        ";
    }

    /**
     * Sets the background position of WordPress login page
     *
     * @since   1.1.0
     */
    private function set_background_image()
    {
        $image    = get_theme_mod('jp_toolkit_login_page_background_image');
        if (empty($image)) {
            return;
        }

        $position = get_theme_mod('login_page_background_position', 'center');
        $size     = 'auto';
        $repeat   = 'no-repeat';

        switch ($position) {
            case 'contain':
                $size = 'contain';
                break;

            case 'cover':
                $size = 'cover';
                break;

            case 'repeat':
                $repeat = 'repeat';
                break;
        }

        $this->stylesheet .= "
        body.login {
            background-image: url({$image});
            background-position: {$position};
            background-size: {$size};
            background-repeat: {$repeat};
        }
        ";
    }

    /**
     * Shows the custom stylesheet
     * 
     * @since 1.1.0
     */
    public function render_stylesheet()
    {
        $this->set_font_color();
        $this->set_header_image();
        $this->set_background_image();
        $this->set_background_color();

        echo "
        <style type='text/css> 
        {$this->stylesheet}
        </style>
        ";
    }
}
