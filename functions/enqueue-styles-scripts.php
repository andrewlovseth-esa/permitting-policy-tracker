<?php

/*
	Enqueue Styles & Scripts
*/


// Enqueue custom styles and scripts
function bearsmith_enqueue_styles_and_scripts() {
    $css_version = filemtime(get_stylesheet_directory() . '/style.css');
    $js_version = filemtime(get_stylesheet_directory() . '/js/main.js');

    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/style.css', array(), $css_version );
    wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', array(), $js_version );

}
add_action('wp_enqueue_scripts', 'bearsmith_enqueue_styles_and_scripts');

add_filter('script_loader_tag', 'add_module_to_my_script', 10, 3);
function add_module_to_my_script($tag, $handle, $src) {
    if ('main-js' === $handle) {
        $tag = '<script type="module" src="' . esc_url($src) . '"></script>';
    }

    return $tag;
}