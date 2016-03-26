<?php 
function wpmb_init () {
	wpmb_register_post_type();
}
function wpmb_custom_title_filter ($str) {
	if($str)
		return $str;
	global $post;
	return get_the_title( $post->ID);
}

function wpmb_aboutus() {
	ob_start();
	include "contents/aboutus.php";
	$str = ob_get_contents();
	ob_clean();
	return $str;
}

function wpmb_blog() {
	ob_start();
	include "contents/blog.php";
	$str = ob_get_contents();
	ob_clean();
	return $str;
}

function wpmb_contactus() {
	ob_start();
	include "contents/contact-us.php";
	$str = ob_get_contents();
	ob_clean();
	return $str;
}

function wpmb_faqs() {
	ob_start();
	include "contents/faqs.php";
	$str = ob_get_contents();
	ob_clean();
	return $str;
}

// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
// This code based on wp_nav_menu's code to get Menu ID from menu slug
function wpmb_navmenu() {
	$menu_name = 'primary';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<div class="col-md-6 comon_nav"><a href="' . $url . '">' . $title . '</a></div>';
		}
	}
	return $menu_list;
}

function wpmb_homeslider () {
	$posts_array = array();
	$posts_array = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'homeslider',
			'post_status' => 'publish'
		)
	);
	$str = '';
	if(!empty($posts_array)) {
		foreach($posts_array as $ind => $postdata) {
			if($ind < 3) {
				if (has_post_thumbnail( $postdata->ID ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postdata->ID ), 'single-post-thumbnail' );				
					$str .= '<div class="slidingDiv">
						<img val="'.$ind.'" alt="" class="slidpic" src="'.$image[0].'">
					</div>';
				}
			}
		}
	}
	return $str;
}

function wpmb_register_post_type() {
	/*
	* @Faqs Post type
	*/
	register_post_type( 'faqs',
		array(
			'labels' => array(
				'name' => __( 'Faqs' ),
				'singular_name' => __( 'faqs' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields' )
		)
	);
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Faqs Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'Faqs Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Faqs Category' ),
		'all_items'         => __( 'All Faqs Category' ),
		'parent_item'       => __( 'Parent Faqs Category' ),
		'parent_item_colon' => __( 'Parent Faqs Category:' ),
		'edit_item'         => __( 'Edit Faqs Category' ),
		'update_item'       => __( 'Update Faqs Category' ),
		'add_new_item'      => __( 'Add New Faqs Category' ),
		'new_item_name'     => __( 'New Faqs Category Name' ),
		'menu_name'         => __( 'Faqs Category' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'category_portfolio' ),
	);

	register_taxonomy( 'category_faqs', array( 'faqs' ), $args );
	############################################################
	
	/*
	* @Home slider post type
	*/
	register_post_type( 'homeslider',
		array(
			'labels' => array(
				'name' => __( 'Homeslider' ),
				'singular_name' => __( 'homeslider' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'thumbnail' )
		)
	);

}

function wpmb_includejs() {
	?>
	<script>
		var width_menu_nav = 0;
		var sliderArray = [];
		var currentIndex = 0;
		var index = 0;
		var callFlag = false;
		var i=0;
		$(document).ready(function(){
			$('.slidingDiv').each(function(i,item){
				sliderArray.push(item);
			});
			$('.wholeSlider').empty();
			$('.wholeSlider').append($(sliderArray[index]));
			setInterval(
				function(){
					rightClickHandler();
				},
				3000
			);
			
			width_menu_nav = $('.menu_nav').width();		
			$(".menu_nav").css({"left":-width_menu_nav+"px","z-index":"9999"});
			$('.menuicon').bind('click',showMenuOption);
			$('.slide_cross').bind('click',hideMenuOption);
			
			$('.circle').bind('click',selectedCircle);
			$($( ".circle" ).eq(0)).addClass("active");
			
		});
		
		function showMenuOption(){	
			$(".menu_nav").animate(
				{'left': '0px'},
				500
			);		
		}		
		function hideMenuOption(){
			$(".menu_nav").animate(
				{'left':-width_menu_nav},
				500
			);		
		}
		
		function leftClickHandler(){
			$item = $(sliderArray[index1]);
			itemClass = $item.attr('class');
			leftIndent = $('.'+itemClass).width();
			$item.css({'left':'-'+leftIndent+'px'});
			$('.wholeSlider').prepend($item);
			
			$currentItem = $item.next('div');
			currentItemClass = $currentItem.attr('class');
			currentItemleftIndent = $('.'+currentItemClass).width();
			$currentItem.animate(
				{
					'left':'+='+currentItemleftIndent+'px'
				},
				1000,
				function(){
					$currentItem.remove();
				}
			);
			$item.animate(
				{
					'left':'+='+leftIndent+'px'
				},
				1000,
				function(){
					
				}
			);
			
		}
		
		function rightClickHandler(){
			currentIndex = index;
			index++;
			if(index==(sliderArray.length)){
				index = 0;
			}		
			$item = $(sliderArray[index]);
			itemClass = $item.attr('class');
			leftIndent = $('.'+itemClass).width();
			$item.css({'left':leftIndent+'px'});
			$('.wholeSlider').append($item);
			
			$currentItem = $item.prev('div');
			currentItemClass = $currentItem.attr('class');
			currentItemleftIndent = $('.'+currentItemClass).width();
			$currentItem.animate(
				{
					'left':'-='+currentItemleftIndent+'px'
				},
				1000,
				function(){
					$currentItem.remove();
				}
			);
			$item.animate(
				{
					'left':'-='+leftIndent+'px'
				},
				1000,
				function(){
					
				}
			);
			callFlag = true;
			
			var i =$('.slidpic').attr('val');		
			$($( ".circle" ).eq(index)).addClass("active");
			$($( ".circle" ).eq(index-1)).removeClass("active");
		}
		
		
		function selectedCircle(e){
			$('.circle').removeClass("active");
			$(e.currentTarget).addClass("active");
			var index1 = $(e.currentTarget).attr('index');
			if(index1>index){
				var difference = index1 - index;
				for(i=0;i<difference;i++){
					rightClickHandler();
				}
			}else{
				var difference = index - index1;
				for(i=0;i<difference;i++){
					leftClickHandler();
				}
			}			
		}
	</script>
<?php } 
?>