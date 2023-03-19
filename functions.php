<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {


	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);

	wp_enqueue_style( 'normalize',  get_stylesheet_directory_uri(). '/assets/css/normalize.min.css', array(), '1.0' );
	wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '1.0' );
	wp_enqueue_style( 'vite', get_stylesheet_directory_uri() . '/dev/dist/index.css', array(), '1.0' );

	wp_enqueue_script( 'js-from-old-theme', get_stylesheet_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true );

	wp_enqueue_script( 'slicknav', get_stylesheet_directory_uri() . '/inc/slicknav.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );


add_action('init','register_my_menus');
function register_my_menus(){
	register_nav_menus(
		array(
			'main-menu' => __('Main Menu')
		)
	);
}


add_action( 'init', 'cp_change_post_object' );

function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Portfolio';
        $labels->singular_name = 'Projekt';
        $labels->add_new = 'Dodaj projekt';
        $labels->add_new_item = 'Add news';
        $labels->edit_item = 'Edytuj projekt';
        $labels->new_item = 'Projekt';
        $labels->view_item = 'Zobacz projekt';
        $labels->search_items = 'Szukaj projektu';
        $labels->not_found = 'Nie znaleziono';
        $labels->not_found_in_trash = 'Nie znaleziono w koszu';
        $labels->all_items = 'Wszystkie projekty';
        $labels->menu_name = 'Portfolio';
        $labels->name_admin_bar = 'Portfolio';
}

// ta funkcja za bardzo spowalnia działanie tego loopa ponieważ musi generować
// w locie miniaturki

function grab_vimeo_thumbnail($vimeo_url){
	if(!$vimeo_url) return false;
	$data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $vimeo_url ) );
	if(!$data) return false;
	$data = $data->thumbnail_url;
	$data = substr($data, strrpos($data, '/') + 1);
	$data = substr($data, 0, strrpos($data, '_'));
	$data = 'https://i.vimeocdn.com/video/' . $data . '.jpg';
	
	return $data;
}