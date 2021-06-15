<?php
/**
 * info functions and definitions.
 *
 * @see https://developer.wordpress.org/themes/basics/theme-functions/
 */
if (!function_exists('info_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function info_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on info, use a find and replace
         * to change 'info' to the name of your theme in all the template files.
         */
        load_theme_textdomain('info', get_template_directory().'/languages');

        // Add default posts and comments RSS feed links to head.
        // add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'info'),
            'menu-2' => esc_html__('Footer', 'info'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        // add_theme_support( 'custom-background', apply_filters( 'info_custom_background_args', array(
        // 	'default-color' => 'ffffff',
        // 	'default-image' => '',
        // ) ) );

        // Add theme support for selective refresh for widgets.
        // add_theme_support( 'customize-selective-refresh-widgets' );

        /*
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        // add_theme_support( 'custom-logo', array(
        // 	'height'      => 250,
        // 	'width'       => 250,
        // 	'flex-width'  => true,
        // 	'flex-height' => true,
        // ) );
    }
endif;
add_action('after_setup_theme', 'info_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function info_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    if (wp_is_mobile()) {
        $GLOBALS['content_width'] = apply_filters('info_content_width', 280);
    } else {
        $GLOBALS['content_width'] = apply_filters('info_content_width', 640);
    }
}
add_action('after_setup_theme', 'info_content_width', 0);

/**
 * Register widget area.
 *
 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
// function info_widgets_init() {
// 	register_sidebar( array(
// 		'name'          => esc_html__( 'Sidebar', 'info' ),
// 		'id'            => 'sidebar-1',
// 		'description'   => esc_html__( 'Add widgets here.', 'info' ),
// 		'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 		'after_widget'  => '</section>',
// 		'before_title'  => '<h2 class="widget-title">',
// 		'after_title'   => '</h2>',
// 	) );
// }
// add_action( 'widgets_init', 'info_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function info_scripts()
{
    /*
     * Disable block editor Gutenberg.
     */
    // wp_deregister_style('wp-block-library');

    // css and js Ver.
    $cssVer = md5(get_template_directory_uri().'/dist/css/style.min.css');
    $jsVer = sha1_file(get_template_directory_uri().'/dist/js/main.min.js');

    wp_enqueue_script('info-modernizr', get_template_directory_uri().'/dist/ajax/libs/modernizr/modernizr-custom.js', array(), '3.6.0', false);

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js', array(), '3.4.1', true);
    wp_enqueue_script('jquery');

    wp_enqueue_script('jsdelivr-script', 'https://cdn.jsdelivr.net/combine/npm/tooltipster@4.2.7,npm/swiper@4.5.1,npm/jquery.qrcode@1.0.3,npm/sweetalert2@11.0.17/dist/sweetalert2.min.js,gh/highlightjs/cdn-release@9.18.1/build/highlight.min.js', array('jquery'), null, true);

    if( is_single() ){
        wp_enqueue_script('fancybox-script', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array('jquery'), null, true);
    }

    wp_enqueue_style('jsdelivr-style', 'https://cdn.jsdelivr.net/combine/npm/normalize.css@8.0.1,npm/purecss@1.0.1/build/tables-min.min.css,npm/swiper@4.5.1/dist/css/swiper.min.css,npm/tooltipster@4.2.7/dist/css/tooltipster.bundle.min.css,npm/sweetalert2@11.0.17/dist/sweetalert2.min.css,npm/highlight.js@9.18.1/styles/github.min.css', array(), null, 'all');

    if( is_single() ){
        wp_enqueue_style('fancybox-style', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', array(), null, 'all');
    }

    wp_enqueue_script('info-script', get_template_directory_uri().'/dist/js/main.min.js', array('jquery'), $jsVer, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        // wp_enqueue_script( 'comment-reply' );
        wp_enqueue_script('comment-reply-jsdelivr', 'https://cdn.jsdelivr.net/gh/WordPress/WordPress/wp-includes/js/comment-reply.min.js', array('jquery'), null, true);
    }

    wp_enqueue_style('info-style', get_template_directory_uri().'/dist/css/style.min.css', array(), $cssVer, 'all');
}
add_action('wp_enqueue_scripts', 'info_scripts');


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/dashboard/TGM-Plugin-Activation-develop/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/dashboard/tgm-plugin-activation-config.php';


/**
 * Codestar Framework
 * A Simple and Lightweight WordPress Option Framework for Themes and Plugins.
 */
require_once get_template_directory() . '/dashboard/csf-config.php';
require_once get_template_directory() . '/dashboard/csf-functions.php';


/**
 * Custom functions.
 */
require_once get_template_directory() . '/dashboard/custom-functions.php';
