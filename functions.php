<?php
/**
 * Stieller functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Stieller
 */


// useful function for witing to the log.
if ( ! function_exists( 'write_log ' ) ) {
	/**
	 * Useful function for witing to the log..
	 *
	 * @param array $log Array of the CSS classes that are applied to the menu <ul> element.
	 */
	function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
			error_log( print_r( $log, true ) );
		} else {
			error_log( $log );
		}
	}
}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', wp_get_theme()->get( 'Version' ) );
}

if ( ! function_exists( 'stieller_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function stieller_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Stieller, use a find and replace
		 * to change 'stieller' to the name of your theme in all the template files.
		 */
		//load_theme_textdomain( 'stieller', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'stieller' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'stieller_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for custom line heights.
		 *
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#supporting-custom-line-heights
		 */
		add_theme_support( 'custom-line-height' );

		/*
		 * Enable support for Spacing control.
		 *
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#spacing-control
		 */
		add_theme_support( 'custom-spacing' );
	}
endif;
add_action( 'after_setup_theme', 'stieller_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stieller_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'stieller_content_width', 640 );
}
add_action( 'after_setup_theme', 'stieller_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stieller_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'stieller' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'stieller' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'stieller_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function stieller_scripts() {

	wp_enqueue_style(
		'stieller-style',
		get_template_directory_uri() . '/dist/css/style.css',
		array(),
		_S_VERSION
	);

	wp_enqueue_script(
		'stieller-script',
		get_template_directory_uri() . '/dist/js/script.js',
		array(),
		_S_VERSION,
		true
	);


	//wp_enqueue_style( 'stieller-style', get_stylesheet_uri(), array(), _S_VERSION );
	//wp_style_add_data( 'stieller-style', 'rtl', 'replace' );

	//wp_enqueue_script( 'stieller-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	//if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		//wp_enqueue_script( 'comment-reply' );
	//}
}
add_action( 'wp_enqueue_scripts', 'stieller_scripts' );


/**
 * Register and Enqueue Admin Scripts and Styles.
 */
function stieller_admin_scripts() {

	/*
	wp_enqueue_style(
		'zthemename-admin',
		get_template_directory_uri() . '/dist/css/admin.css',
		array(),
		_S_VERSION
	);
	*/

	wp_enqueue_script(
		'stieller-admin',
		get_template_directory_uri() . '/dist/js/admin.js',
		array( 'jquery' ),
		_S_VERSION,
		false
	);
}

add_action( 'admin_enqueue_scripts', 'stieller_admin_scripts' );



/**
 * Enqueue block editor assets.
 */
function stieller_editor_assets() {
	// Enqueue the editor styles.
	wp_enqueue_style(
		'stieller-editor',
		get_template_directory_uri() . '/dist/editor/css/style.css',
		// ["wp-edit-blocks"],.
		array(),
		_S_VERSION
	);

	// Enqueue the editor script.
	wp_enqueue_script(
		'stieller-editor',
		get_template_directory_uri() . '/dist/editor/js/script.js',
		array(
			//'jquery',
			//'underscore',
			'lodash',
			'wp-block-editor',
			'wp-rich-text',
			//'wp-components',
			'wp-i18n',
			//'wp-dom',
			// "wp-primitives",
			'wp-element',
			'wp-data',
			'wp-compose',
			'wp-dom-ready',
			// xxx.
			//'wp-blob',
			//'wp-viewport',
			//'wp-primitives',
			//'wp-blocks',
			//'wp-keycodes',
			//'wp-hooks',
			//'wp-plugins',
			//'wp-edit-post',

			
			/*
			'wp-hooks',
			'wp-element',
			'wp-data',
			'wp-block-editor',
			'wp-rich-text',
			'wp-blocks',
			'wp-i18n',
			'wp-block-editor',
			'wp-components',
			'lodash',
			'wp-plugins',
			'wp-edit-post',
			'wp-compose'
			'jquery',
			'wp-compose',
			'wp-data',
			'wp-editor',
			'wp-element',
			'wp-rich-text',
			*/
		),
		_S_VERSION,
		true
	);

	// load font awesome data to browser...
	/*
	wp_localize_script(
		'zthemename-editor',
		'fa_icons',
		array(
			'data' => get_template_directory_uri() . '/dist/data/icons.json',
		)
	);
	*/
}

add_action( 'enqueue_block_editor_assets', 'stieller_editor_assets' );





/**
 * Implement the Custom Header feature.
 */
////require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
//if ( defined( 'JETPACK__VERSION' ) ) {
	//require get_template_directory() . '/inc/jetpack.php';
//}


// Second Way To Better Apply, If You Can't Change Source Code 
function stieller_get_custom_logo( $html ) {
	return str_replace( 'custom-logo', 'custom-logo img-fluid rounded-circle shadow', $html );
}

add_filter( 'get_custom_logo', 'stieller_get_custom_logo', 10 );

// Custom options class.
require_once get_template_directory() . '/classes/class-stieller-options-page.php';


/*
add_filter( 'https_ssl_verify', '__return_false' );


$ztitle = "today33";

$name = "Stay In Front";

//$date = date("  Y-m-d");

$today = date('F j\<\s\u\p\>S\<\/\s\u\p\> Y');


$content  = '<!-- wp:paragraph --><p>' . $today . '</p><!-- /wp:paragraph -->';
$content .= '<!-- wp:paragraph --><p>Human Resources<br>' . $name . '</p><!-- /wp:paragraph -->';


$page = get_page_by_title( $ztitle, 'OBJECT', 'page' );

//write_log( $page );

if ( ! empty( $page ) )
{
	write_log( "Page already exists:" );
	
	//echo "Page already exists:" . $title_of_the_page . "<br/>";
	//return $objPage->ID;
} else {
	
	write_log( "creating page..." );

	wp_insert_post(
		array(
		'comment_status' => 'close',
		'ping_status'    => 'close',
		'post_author'    => 1,
		'post_title'     => ucwords( $ztitle ),
		'post_name'      => strtolower( str_replace(' ', '-', trim( $ztitle ) ) ),
		'post_status'    => 'publish',
		'post_content'   => $content,
		'post_type'      => 'page',
		//'post_parent'    =>  $parent_id //'id_of_the_parent_page_if_it_available'
		)
	);
}
*/

