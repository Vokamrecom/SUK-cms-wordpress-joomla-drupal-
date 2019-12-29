<?php

/* add css*/
function register_styles() {
    wp_register_style('nav-bar', get_template_directory_uri() . 
    './libs/css/nav-bar.css');
    wp_enqueue_style('nav-bar');

    wp_register_style('style', get_template_directory_uri() . 
    './style.css');
    wp_enqueue_style('style');
}

add_action('wp_enqueue_scripts', 'register_styles');

/* add menu*/ 
function theme_register_nav_menu() {
    register_nav_menu ('menu', 'Main menu');
}

add_action( 'after_setup_theme', 'theme_register_nav_menu' );