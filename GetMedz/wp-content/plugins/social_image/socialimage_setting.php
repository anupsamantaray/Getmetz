<?php
/*
Plugin Name: Footer Social Plugin
Description: Can be used for dynamic contents in footer social link
Version: 1.0
Author: Anup Prasad Samantaray
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}
add_action( 'admin_menu', 'employee_plugin_menu' );

function employee_plugin_menu() {
	add_menu_page( 'Social Links', 'Social Links', '8', 'social_links', 'social_links_plugin' );
	}

	function social_links_plugin(){
//	print_r($_REQUEST);
	
	if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_image' ){ 
		include 'pages/add_social_link_image.php';
		}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_image'){
		include 'pages/edit_social_link_image.php';
	}	
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete_image' ){ 
				if(isset($_REQUEST['image_id'])){
					$delId=$_REQUEST['image_id'];
					mysql_query("DELETE FROM wp_sociallink WHERE image_id='".$delId."'");
					//echo "Request deleted successfully";
					print("<script>window.location='". get_bloginfo('home')."/wp-admin/admin.php?page=social_links&pqr=1'</script>");	
				}
			}
			else{
				include 'pages/social_link_details.php';
				}
		}
		

?>