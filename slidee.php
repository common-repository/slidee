<?php
/*
	Plugin Name: Slidee
	Plugin URI: slidee.kirillbdev.pro
	Description: Fast and minimalistic SEO friendly slider with pure code.
	Version: 1.1.0
	Author: Kirill Babinec
	License URI: license.txt
	Author URI: http://kirillbdev.pro
	Tested up to: 5.0.0
*/

add_action( 'plugins_loaded', 'slidee_init' );
function slidee_init() {
	define( 'SLIDEE_DIR_URL',  plugin_dir_url(__FILE__) );
	define( 'SLIDEE_PLUGIN_DIR', plugin_dir_path(__FILE__) );
	define( 'SLIDEE_POST_TYPE',  'slidee_slider' );

	include_once 'inc/SlideeView.php';
	include_once 'inc/Slidee.php';
	include_once 'inc/meta-slider-settings.php';
	include_once 'inc/slider-front-end.php';
	include_once 'inc/initializer.php';
}