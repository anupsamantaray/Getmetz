<?php 
/*
Plugin Name: WPMB Common Pages
Description: WPMB Common Pages
*/

include "functions.php";

//Add filters and actions
add_filter('wpmb_custom_title', 'wpmb_custom_title_filter',10,3);
add_action('init','wpmb_init');
add_action('wp_head', 'wpmb_includejs');
add_action('plugins_loaded', 'wpmb_create_table');

/*Shortcodes */
add_shortcode('WPMB_BLOG', 'wpmb_blog');
add_shortcode('WPMB_CONTACTUS', 'wpmb_contactus');
add_shortcode('WPMB_FAQS', 'wpmb_faqs');
add_shortcode('WPMB_ABOUTUS', 'wpmb_aboutus');
?>