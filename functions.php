<?php
/**
 * My Custom Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package My_Custom_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_custom_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on My Custom Theme, use a find and replace
		* to change 'my-custom-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'my-custom-theme', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'my-custom-theme' ),
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
			'my_custom_theme_custom_background_args',
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
}
add_action( 'after_setup_theme', 'my_custom_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_custom_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'my_custom_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'my_custom_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_custom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'my-custom-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'my-custom-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'my_custom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function my_custom_theme_scripts() {
	wp_enqueue_style( 'my-custom-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'my-custom-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'my-custom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'my_custom_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/*Navigation Menus*/
function register_my_menu() {
	register_nav_menu('header-menu',__( 'Header Menu' ));
  }
add_action( 'init', 'register_my_menu' );
/*End*/

function footer_widgets_init() {
 
    // First footer widget area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area - 1', 'my_footer_widget_area' ),
        'id' => 'first-footer-widget-area',
        'description' => __( 'The first footer widget area', 'my_footer_widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Second Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area - 2', 'my_footer_widget_area' ),
        'id' => 'second-footer-widget-area',
        'description' => __( 'The second footer widget area', 'my_footer_widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Third Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area - 3', 'my_footer_widget_area' ),
        'id' => 'third-footer-widget-area',
        'description' => __( 'The third footer widget area', 'my_footer_widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
 
    // Fourth Footer Widget Area, located in the footer. Empty by default.
    register_sidebar( array(
        'name' => __( 'Footer Widget Area - 4', 'my_footer_widget_area' ),
        'id' => 'fourth-footer-widget-area',
        'description' => __( 'The fourth footer widget area', 'my_footer_widget_area' ),
        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
         
}
 
// Register sidebars by running my_footer_widget_area_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'footer_widgets_init' );


//Breadcrumps Function
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title();
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

//Add Scripts to header
add_action('wp_head', 'header_scripts');
function header_scripts(){
?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
<?php
}


add_action('wp_footer', 'footer_scripts');

function footer_scripts(){
	?>
	<!-- Compiled and minified CSS -->
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
	<!-- Compiled and minified JavaScript -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
	<!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
      });
      var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        thumbs: {
          swiper: swiper,
        },
      });
    </script>
	<script>
		jQuery(function($) {
            $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if (scroll >= 60) {
        $('.my-header').addClass("sticky");
        
    } else {
        $('.my-header').removeClass("sticky");
    }
});


		 });
		 $('.dropdown-menu-filter .dropdown-toggle').on('click', '.allow-focus', function (e) {
  e.stopPropagation();
});




</script>
<?php
}

function my_wp_custom_breadcrumbs() {

    $separator              = '>';
    $breadcrumbs_id         = 'my_breadcrumbs';
    $breadcrumbs_class      = 'my_breadcrumbs';
    $home_title             = esc_html__('Home', 'my-custom-theme');

    // Add here you custom post taxonomies
    $my_custom_taxonomy    = 'product_cat';

    global $post,$wp_query;
       
    // Hide from front page
    if ( !is_front_page() ) {
       
        echo '<ul id="' . $breadcrumbs_id . '" class="' . $breadcrumbs_class . '">';
           
        // Home
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title('', false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // For Custom post type
            $post_type = get_post_type();
              
            // Custom post type name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            $post_type = get_post_type();

            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Last category post is in
                $last_category = $category[count($category) - 1];
                  
                // Parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }

            $taxonomy_exists = taxonomy_exists($my_custom_taxonomy);
            if(empty($last_category) && !empty($my_custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $my_custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $my_custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // If the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // Get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents order
                $anc = array_reverse($anc);
                   
                // Parent pages
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Render parent pages
                echo $parents;
                   
                // Active page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display active page if not parents pages
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) { // Tag page
               
            // Tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Return tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) { // Day archive page
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) { // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) { // Display year archive

            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) { // Author archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }

        echo '</ul>';  
    }
	

}
add_shortcode('breadcrumbs', 'my_wp_custom_breadcrumbs');

function weather_report_func(){
	//$response = wp_remote_get( '' );
	//$body     = wp_remote_retrieve_body( $response );

	//print_r($body);
	$key    = 'gKGrFc'; // Add your own key value
    
    $url = "https://api.data.gov.sg/v1/environment/2-hour-weather-forecast";

    $args = array(
        'headers' => array(
            'Content-Type' => 'application/json',
        ),
        'body'    => array(),
    );

    $response = wp_remote_get( $url, $args );

    $response_code = wp_remote_retrieve_response_code( $response );
    $body         = wp_remote_retrieve_body( $response );

    //var_dump($response);
	$data =  json_decode($body,true);
	//print_r($data);

    if ( 401 === $response_code ) {
        return "Unauthorized access";
    }

    if ( 200 !== $response_code ) {
        return "Error in pinging API";
    }

    if ( 200 === $response_code ) {
       // return $body;
    //    echo '<pre>';
    //   var_dump( $data );
    //    echo '</pre>';
	   
    //    foreach ($data as $key=>$val) {
    //     var_dump($key);
    //    //echo $key['items']['update_timestamp'] ."-".$val['items']['update_timestamp'];
    // }
    ?>
    <div class='row'>
<table class="table">
<!-- <tr>
    <th>City</th>
    <th>Latitude</th>
    <th>Langtitude</th>
  </tr> -->
    <?php
    foreach ($data['area_metadata'] as $key => $value) {
        // echo '<tr>';
        // echo '<td>'.$value['name'].'</td>';
        // echo '<td>'.$value['label_location']["latitude"].'</td>';
        // echo '<td>'.$value['label_location']["longitude"].'</td>';
        // echo '</tr>';

    }
?>
<tr>
    <th>Area</th>
    <th>Forecast</th>
</tr>
<tbody>
<?php
    foreach ($data['items'] as $items) {
       
        foreach ($items['forecasts'] as $key => $value){
        echo '<tr>';
        echo '<td>'.$value["area"].'</td>';
        echo '<td>'.$value["forecast"].'</td>';
        echo '</tr>';
       }
       //echo '</tr>';
        echo str_replace("T"," ",'<div class="row">Last Updated:  '.$items["update_timestamp"].'</div>');
        

    }
    
?>
</tbody>
    </table>
</div>

<?php
}
?>

<?php

}
add_shortcode('weather_report', 'weather_report_func');


/*
 ==================
 Ajax Search
======================	 
*/
// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetch(){
    var shop_cat = [];
    jQuery('.shop_cat:checkbox:checked').each(function() {
            shop_cat.push($(this).val());
        });
    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val(), shop_cat:shop_cat  },
        success: function(data) {
            //alert(data);
			jQuery('.shop_archive').html();
            jQuery('.shop_archive').html( data );
        }
    });

}
</script>

<?php
}
// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){
	if ($_POST['keyword'] != "" && $_POST['shop_cat'] == "") {
    $the_query = new WP_Query( array( 'posts_per_page' =>8, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'shops','order'  => 'ASC','orderby'  => 'name', ) );
    if( $the_query->have_posts() ) :
       // echo '<ul>';
       while($the_query->have_posts() ): $the_query->the_post(); 

       get_template_part('template-parts/card', 'shops');

    endwhile;
      // echo '</ul>';
        wp_reset_postdata();  
    endif;

    die();
}

elseif ($_POST['keyword'] == "" && $_POST['shop_cat'] == "") {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    
	$the_query = new WP_Query( array( 
		'posts_per_page' =>8,  
		'post_type' => 'shops', 
		'order'  => 'ASC',
	'orderby'  => 'name',
	'posts_per_page'      => '8', //how many posts you need
	'paged'  => $paged //add the 'paged' parameter 
	) );
    if( $the_query->have_posts() ) :
       // echo '<ul>';
       while($the_query->have_posts() ): $the_query->the_post(); 

       get_template_part('template-parts/card', 'shops');

        endwhile;
      // echo '</ul>';
        wp_reset_postdata();  
    endif;

    die();
}

elseif ($_POST['keyword'] != "" && $_POST['shop_cat'] != "")  {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    

    $shop_cat =$_POST['shop_cat'];
    $meta_query = array('relation' => 'AND');
    foreach($choices as $Key=>$Value){

        if(count($shop_cat)){
            foreach ($shop_cat as $Inkey => $Invalue) {
                $meta_query[] = array( 'key' => $InKey, 'value' => $Invalue, 'compare' => '=' );
            }
        }
    }
// /////

$tax_query = array( 'relation' => 'AND' );

foreach ($shop_cat as $key){
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' =>  $key
    );
}

$args = array(
       
    'posts_per_page' => 8,  
    'post_type' => 'shops', 
    'order'  => 'ASC',
'orderby'  => 'name',
'posts_per_page'      => '8', //how many posts you need
'paged'  => $paged, //add the 'paged' parameter 
'cat' => $shop_cat,
's' => esc_attr( $_POST['keyword'] ),
//'tax_query'      => $tax_query
);


// for taxonomies / categories
    // $args['tax_query'][] = array(
    // // 'relation' => 'AND',

    //     array(
    //         'taxonomy' => 'category',
    //         'field' => 'id',
    //         'terms' => $_POST['shop_cat']
    //     )
    // );




///////////
//	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    

    
	$the_query = new WP_Query($args);


    //$the_query = new WP_Query();
   // $the_query = array_merge( $the_query->posts, $the_query_2->posts );

    if($the_query->have_posts() ) :
       // echo '<ul>';
        while($the_query->have_posts() ): $the_query->the_post(); 

            get_template_part('template-parts/card', 'shops');

         endwhile;
      // echo '</ul>';
        wp_reset_postdata();  
    endif;

    die();
    
}
elseif ($_POST['keyword'] == "" && $_POST['shop_cat'] != "")  {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    

    $shop_cat =$_POST['shop_cat'];
    $meta_query = array('relation' => 'AND');
    foreach($choices as $Key=>$Value){

        if(count($shop_cat)){
            foreach ($shop_cat as $Inkey => $Invalue) {
                $meta_query[] = array( 'key' => $InKey, 'value' => $Invalue, 'compare' => '=' );
            }
        }
    }
// /////

$tax_query = array( 'relation' => 'AND' );

foreach ($shop_cat as $key){
    $tax_query[] = array(
        'taxonomy' => 'category',
        'field' => 'id',
        'terms' =>  $key
    );
}

$args = array(
       
    'posts_per_page' => 8,  
    'post_type' => 'shops', 
    'order'  => 'ASC',
'orderby'  => 'name',
'posts_per_page'      => '8', //how many posts you need
'paged'  => $paged, //add the 'paged' parameter 
'cat' => $shop_cat,
//'s' => esc_attr( $_POST['keyword'] ),
//'tax_query'      => $tax_query
);


// for taxonomies / categories
    // $args['tax_query'][] = array(
    // // 'relation' => 'AND',

    //     array(
    //         'taxonomy' => 'category',
    //         'field' => 'id',
    //         'terms' => $_POST['shop_cat']
    //     )
    // );




///////////
//	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;    

    
	$the_query = new WP_Query($args);


    //$the_query = new WP_Query();
   // $the_query = array_merge( $the_query->posts, $the_query_2->posts );

    if($the_query->have_posts() ) :
       // echo '<ul>';
        while($the_query->have_posts() ): $the_query->the_post(); 

            get_template_part('template-parts/card', 'shops');

         endwhile;
      // echo '</ul>';
        wp_reset_postdata();  
    endif;

    die();
    
}
else{
	echo "<h4 style='text-align:center;'>No results Found</h4>";
}
}


add_action( 'wp_enqueue_scripts', 'shop_script_and_styles');

function shop_script_and_styles() {
	// absolutely need it, because we will get $wp_query->query_vars and $wp_query->max_num_pages from it.
	//global $wp_query;
    $args = array(
        'paged' => 1,
        'post_status' => 'publish',
        //'posts_per_page' => 8,
        'post_type' => 'shops', 
        'order' => 'ASC',
        'orderby' => 'title'
      );
         // it is always better to use WP_Query but not here
         $wp_query = new wp_query( $args );

	// when you use wp_localize_script(), do not enqueue the target script immediately
	wp_register_script( 'shop_scripts', get_stylesheet_directory_uri() . '/script.js', array('jquery') );
 
	// passing parameters here
	// actually the <script> tag will be created and the object "shop_loadmore_params" will be inside it 
	wp_localize_script( 'shop_scripts', 'shop_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	) );
    wp_enqueue_script( 'shop_scripts' );
    }
 	

add_action('wp_ajax_loadmorebutton', 'shop_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'shop_loadmore_ajax_handler');
 
function shop_loadmore_ajax_handler(){

 $arg = array(
   'paged' => $_POST['page'] + 1,
   'post_status' => 'publish',
   'posts_per_page' => 4,
   'post_type' => 'shops', 
   'order' => 'ASC',
   'orderby' => 'title'
 );
    $qyery = new wp_query( $arg );
 
    if( $qyery->have_posts() ) :
   // run the loop
   while( $qyery->have_posts() ): $qyery->the_post();
  
  get_template_part('template-parts/card', 'shops');

   endwhile;
    endif;
    wp_reset_query();
    die; // here we exit the script and even no wp_reset_query() required!
}
      