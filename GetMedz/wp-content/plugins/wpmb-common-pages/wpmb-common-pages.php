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
add_action("admin_menu","wpmb_admin_menu");

/*Shortcodes */
add_shortcode('WPMB_BLOG', 'wpmb_blog');
add_shortcode('WPMB_CONTACTUS', 'wpmb_contactus');
add_shortcode('WPMB_FAQS', 'wpmb_faqs');
add_shortcode('WPMB_ABOUTUS', 'wpmb_aboutus');

function wpmb_admin_menu() {
	add_menu_page("Contact Us","Contact Us",8,basename(__FILE__),"wpmb_contactus_manage");	
}

?>