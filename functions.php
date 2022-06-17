<?php

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here
add_theme_support( 'title-tag' );
if (function_exists('add_theme_support')) {

	add_theme_support( 'automatic-feed-links' );
	
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

    add_theme_support( 'custom-logo' );

    add_image_size( 'custom-image', 570, 260, true );
	add_image_size( 'custom-image', 570, 260, array( 'left', 'top' ) );


    // Localisation Support
    //load_theme_textdomain('bs', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/


// Load scripts (header.php)
function enqueue_script() {

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		
		wp_enqueue_script( 'jquery' );

        //wp_register_script('triviasharp-master', get_template_directory_uri() . '/js/master.js', array(), rand(111,9999)); // Custom scripts
        //wp_enqueue_script('triviasharp-master'); // Enqueue it!
		
		//wp_register_script('sb-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js' );
		
		wp_enqueue_script('jquery-migrate');

    }
	
	if( is_admin() ) {
		wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_register_script('sb', get_template_directory_uri() . '/admin/js/ts-scripts.js', array('jquery','jquery-migrate'), '1.0.0');
        wp_enqueue_script('sb');
		//wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );
		//wp_enqueue_style( 'jquery-ui' ); 
    }
	
}

// Load HTML5 Blank conditional scripts
function conditional_scripts() {

    if (is_page('pagenamehere')) {
        //wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
       // wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// enqueue_styles
function enqueue_styles() {
	
	//wp_register_style('sb-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-aos', get_template_directory_uri() . '/css/aos.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-bootstrap-icons', get_template_directory_uri() . '/css/bootstrap-icons.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-boxicons', get_template_directory_uri() . '/css/boxicons.min.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-glightbox', get_template_directory_uri() . '/css/glightbox.min.css', array(), '1.0', 'all');
    wp_enqueue_style('interview-swiper-bundle', get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), '1.0', 'all');

    wp_register_style('interview', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('interview'); // Enqueue it!

}

/**
 * 
*/
add_action( 'wp_footer', 'footer_scripts' );
function footer_scripts() {

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        //wp_enqueue_script('interview-verta', get_template_directory_uri() . '/lib/verta/assets/js/scripts20b9.js', array(), '1.0','all');
		wp_register_script('interview', get_template_directory_uri() . '/js/scripts.js', array('jquery','jquery-effects-core', 'jquery-ui-core','jquery-ui-tabs'), '1.0','all'); // Custom scripts
		  
		 wp_localize_script( 'interview', 'interview', array(
			'ajaxurl' 	=> admin_url( 'admin-ajax.php' ),
			'noposts' 	=> __('No older posts found', 'sb'),
			'post_name'	=> get_query_var('ts_post_title'),
			'login'		=> is_user_logged_in()?'yes':'no'
		));
		
		 wp_enqueue_script('interview'); // Enqueue it!
		 
	}

}

// Register HTML5 Blank Navigation
function register_menu() {

    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu'   => __('Header Menu', 'triviasharp'), // Main Navigation
		'header-menu-mb'   => __('Header Menu moblie', 'triviasharp'),
        'sidebar-menu'  => __('Sidebar Menu', 'triviasharp'), // Sidebar Navigation
        'footer-menu'   => __('Footer Menu', 'triviasharp'),
		'footer-category-menu'   => __('Footer Category Menu', 'triviasharp')
    ));
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name'          => __('Widget Area 1', 'triviasharp'),
        'description'   => __('Description for this widget-area...', 'triviasharp'),
        'id'            => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name'          => __('Widget Area 2', 'triviasharp'),
        'description'   => __('Description for this widget-area...', 'triviasharp'),
        'id'            => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));

    register_sidebar(array(
        'name'          => __('ADS', 'triviasharp'),
        'description'   => __('Display ads', 'triviasharp'),
        'id'            => 'ads-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ));
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('after_setup_theme', 'remove_admin_bar');
add_action('init', 'enqueue_script'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'conditional_scripts'); // Add Conditional Page Scripts
add_action('wp_enqueue_scripts', 'enqueue_styles'); // Add Theme Stylesheet
add_action('init', 'register_menu'); // Add Menu
//add_filter( 'nav_menu_link_attributes', 'nav_menu_link_attributes', 10, 3 );
//add_action('wp_ajax_loadmore', 'ts_loadmore_ajax_handler'); // wp_ajax_{action}
//add_action('wp_ajax_nopriv_loadmore', 'ts_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
add_action('wp_logout', 'logout_redirect');

//add_shortcode('question_related_more', 'ts_question_related_more_post' );

// Add Filters
//add_filter( 'image_size_names_choose', 'wp_custom_image_sizes' );
//add_filter('wp_authenticate_user', 'check_user_activation_status', 10, 2);


function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

function logout_redirect( $redirect_to) {
    wp_redirect( home_url() );
    exit;
}

?>