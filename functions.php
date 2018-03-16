<?php

require_once 'includes/sidebar_menu.php';
require_once 'includes/bootstrap_menu.php';
require_once 'includes/breadcrumbs.php';
require_once 'includes/posts_setup.php';

//wp setup
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
show_admin_bar( false );
//register css|js
function registerThemeStyles() {
	wp_register_style( 'main', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'main' );
}

add_action( 'wp_print_styles', 'registerThemeStyles' );
function registerThemeJs() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' );
	wp_enqueue_script( 'popper' );
	wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap' );
	wp_register_script( 'fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js' );
	wp_enqueue_script( 'fancybox' );
	wp_register_script( 'main', get_template_directory_uri() . '/ES6/main.js' );
	wp_enqueue_script( 'main' );
}

add_action( 'wp_enqueue_scripts', 'registerThemeJs' );
//speed
function footer_enqueue_scripts() {
	remove_action( 'wp_head', 'wp_print_scripts' );
	remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
	remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
	add_action( 'wp_footer', 'wp_print_scripts', 5 );
	add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
	add_action( 'wp_footer', 'wp_print_head_scripts', 5 );
}

add_action( 'after_setup_theme', 'footer_enqueue_scripts' );
function cubiq_setup() {
	remove_action( 'wp_head', 'wp_generator' );                // #1
	remove_action( 'wp_head', 'wlwmanifest_link' );            // #2
	remove_action( 'wp_head', 'rsd_link' );                    // #3
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );        // #4
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );    // #5
	add_filter( 'the_generator', '__return_false' );            // #6
	add_filter( 'show_admin_bar', '__return_false' );            // #7
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // #8
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}

add_action( 'after_setup_theme', 'cubiq_setup' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
add_filter( 'wpcf7_form_elements', function ( $content ) {
	$content = preg_replace( '/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content );

	return $content;
} );
//end speed
// remove admin-menu links
function remove_menus() {
	remove_menu_page( 'edit-comments.php' );
	remove_menu_page( 'edit.php' );
}

add_action( 'admin_menu', 'remove_menus' );
//menu active class
add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );

function special_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active ';
	}

	return $classes;
}

remove_filter( 'the_content', 'wpautop' );
//end active class
//cool functions for development
function path() {
	return get_template_directory_uri() . '/';
}

function phoneLink( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9]/', '', $phone );
}

function the_image( $name, $id ) {
	echo 'src="' . get_field( $name, $id )['url'] . '" ';
	echo 'alt="' . get_field( $name, $id )['alt'] . '" ';
}

function repeater_image( $name ) {
	echo 'src="' . get_sub_field( $name )['url'] . '" ';
	echo 'alt="' . get_sub_field( $name )['alt'] . '" ';
}

function pre( $array ) {
	echo "<pre>";
	print_r( $array );
	echo "</pre>";
}

//options page
if ( function_exists( 'acf_add_options_page' ) ) {
	$main = acf_add_options_page( [
		'page_title' => 'Настройки темы',
		'menu_title' => 'Настройки темы',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
		'position'   => 2,
		'icon_url'   => 'dashicons-admin-customizer',
	] );
}

add_action('wp_enqueue_scripts', 'wpmidia_enqueue_masked_input');
function wpmidia_enqueue_masked_input(){
	wp_enqueue_script('masked-input', get_template_directory_uri().'/js/jquery.maskedinput.min.js', array('jquery'));
}
add_action('wp_footer', 'wpmidia_activate_masked_input');
function wpmidia_activate_masked_input(){
	?>
	<script type="text/javascript">
        jQuery( function($){
            $(".data").mask("99/99/9999");
            $("input[type=tel]").mask("+7 (999) 999-99-99");
            $(".cpf").mask("999.999.999-99");
            $(".cnpj").mask("99.999.999/9999-99");
        });
	</script>
	<?php
}