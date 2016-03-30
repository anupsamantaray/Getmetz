<?php
if(!session_id()) {
	session_start();
}
function wpmb_init () {
	global $wpdb;
	wpmb_register_post_type();
	$ch = isset($_REQUEST['wpmb_choice']) ? $_REQUEST['wpmb_choice'] : '';
	switch($ch) {
		case "contact_us" :			
			$ctbl = $wpdb->prefix."contactus";
			$data = $_REQUEST['data'];
			$data['create_date'] = date('Y-m-d H:i:s');
			$wpdb->insert($ctbl, $data, array('%s','%s','%s','%s','%s','%s'));
			$to = $admin_email = get_option( 'admin_email' );
			
			//Email send contents
			$searchStr = array('%first_name%', '%last_name%', '%phone%', '%email%', '%message%');
			$replaceStr = array($data['first_name'],$data['last_name'],$data['phone'],$data['email'],$data['message']);
			$options = get_option('wpmb_save_options');
			$formatSubject = ($options['subject']) ? $options['subject'] : "Contact Us : %first_name%";
			$formatMessage = ($options['message']) ? $options['message'] : '<table><tr><td colspan="2"><h2>Message Details</h2></td></tr><tr><td>Name : </td><td>%first_name%' .  ' ' . '%last_name%</td></tr><tr><td>Phone: </td><td>%phone%</td></tr><tr><td>Email: </td><td>%email%</td></tr><tr><td>Message: </td><td>%message%</td></tr></table>';
			
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: '.$data['first_name'].' <'.$data['email'].'>';
			$headers[] = 'To: Admin <'.$admin_email.'>';
			$subject = str_replace($searchStr, $replaceStr, $formatSubject);
			$message = str_replace($searchStr, $replaceStr, $formatMessage);
			#echo "<hr>  : To :: $to <hr> Subject :: $subject <hr> Messgae :: $message <hr> Header :: $headers : <hr>";exit;
			wp_mail($to, $subject, $message, $headers);
			$_SESSION['sucmsg'] = "Mail sent successfully. Please wait administrator will contact you soon!";
			header("Location:".wpmb_cur_url());exit;
			break;
		case 'delete' : 
			if($_GET['id'] > 0) {
				global $wpdb;
				$tbl = $wpdb->prefix.'contactus';
				$sql = "DELETE FROM $tbl WHERE id='".$_GET['id']."'";       
				$wpdb->query($sql); 
				$_SESSION['msg'] = "<div  style='color:green; font-weight:bold;'>Record deleted successfully!</div>";
				wp_redirect(wpmb_cur_url());
			}
			break;
	}
}

function wpmb_contactus_manage() {
	include "contents/contactus-list.php";
}

function wpmb_cur_url() {
	$curl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$curl_arr = split('[?]',$curl);
	$curl = $curl_arr[0]; 
	
	//Admin page option
	if(!empty($_GET['page'])) {
		$curl = add_query_arg( 'page', $_GET['page'],$curl);
	}

	//If permalink set as default
	if(!empty($_GET['page_id'])) {
		$curl = add_query_arg( 'page_id', $_GET['page_id'],$curl);
	}
	return $curl;
}

function wpmb_custom_title_filter ($str) {
	if(is_search() ) {
		return "Search Results for : ". $_GET['s'];
	} else {
		if($str)
			return $str;
		global $post;
		return get_the_title( $post->ID);
	}
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

function wpmb_settings_page() {
	include "contents/settings.php";
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

function wpmb_footermenu() {
	$menu_name = 'footer';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_list = '<ul>';
		foreach ( (array) $menu_items as $key => $menu_item ) {
			$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<li><a href="' . $url . '">' . $title . '</a>';
			$menu_list .= ($key < count($menu_items)-1) ? '|' : '';
			$menu_list .= '</li>';
		}
	}
	return $menu_list.'</ul>';
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
function wpmb_create_table() {
	global $wpdb;
	$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."contactus` (
		  `id` int(11) NOT NULL auto_increment,
		  `first_name` varchar(255) default NULL,
		  `last_name` varchar(255) default NULL,
		  `phone` varchar(255) default NULL,
		  `email` varchar(255) default NULL,
		  `message` text default NULL,
		  is_deleted varchar(1) default 0,
		  `create_date` datetime,
		  PRIMARY KEY (`id`)
		)"
	);
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

	/*
	* @Home bottom post type
	*/
	register_post_type( 'homeother',
		array(
			'labels' => array(
				'name' => __( 'Home Bottom' ),
				'singular_name' => __( 'homeother' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'thumbnail' ),
		'rewrite' => true
		)
	);

	/*
	* @Customer Feedback post type
	*/
	register_post_type( 'custfeedback',
		array(
			'labels' => array(
				'name' => __( 'Customer Feedback' ),
				'singular_name' => __( 'custfeedback' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'thumbnail' ),
		'rewrite' => true
		)
	);

	/*
	* @How It Works post type
	*/
	register_post_type( 'howitworks',
		array(
			'labels' => array(
				'name' => __( 'How It Works' ),
				'singular_name' => __( 'howitworks' )
			),
		'public' => true,
		'has_archive' => true,
		'supports' => array( 'title', 'editor', 'author', 'excerpt', 'custom-fields', 'thumbnail' ),
		'rewrite' => true
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

##################################################################################
    ######################  PAGINATION SCRIPTS START  ################################
    ##################################################################################
    //Split page data for pagination
    if(!function_exists('wpmb_pagedata')) {
        function wpmb_pagedata($sql,$rows,$page_rows) {
            global $wpdb;
            if (!(isset($_REQUEST['pagenum']))){
                $pagenum = 1;
            } else {
                $pagenum = $_REQUEST['pagenum'];
            }
            $last = ceil($rows/$page_rows);
            if ($pagenum < 1){
                $pagenum = 1;
            }else if ($pagenum > $last){
                if($last > 0)
                    $pagenum = $last;
            }
            $stlimit = ($pagenum - 1) * $page_rows;
            $sql = $sql." LIMIT $stlimit,$page_rows";
            $ret[0] = $wpdb->get_results($sql,ARRAY_A);
            $ret[1] = $last;
            $ret[2] = $pagenum;
            return $ret;
        }
    }

    //Page refresh pagination html
    function wpmb_pagination($page,$page_nos,$path,$nodigit='',$choice='',$container='') {
        $str .= "<div class='Pagination'><ul>";
        if ($page[2] == 1){
        }else{
            //$url = add_query_arg( 'pagenum',1,$path);
            //$str .= "<a href='$url'>First </a> ";
            $previous = $page[2]-1;
            $url = add_query_arg( 'pagenum',$previous,$path);
            $str .= "<li><a href='$url'  class='black'> Previous </a></li>";
        }
        $min = max(1,$page[2]-$page_nos);
        $max = min($page[2]+$page_nos, $page[1]);
        
        if(!$nodigit) {
            for($i=$min;$i<=$max;$i++){
                $url = add_query_arg('pagenum',$i,$path);
                if ($i==$page[2]) {
                    $str .= '<input type="hidden" name="pagenum" value="'.$i.'" />';
                    $str .= "<li><a href='";
                    $str .= "$url' class='gray'> ".$i." </a></li>";
                } else {
                    $str .= "<li><a href='";
                    $str .= "$url'> ".$i." </a></li>";
                }
            }
        }
        
        if ($page[2] == $page[1]){
        }else{
            $next = $page[2]+1;
            $url = add_query_arg( 'pagenum',$next,$path);
            $str .= "<li><a href='$url' class='black'> Next </a></li>";
            //$url = add_query_arg( 'pagenum',$page[1],$path);
            //$str .= " <a href='$url'> Last</a> ";
        }
        $str .= "</ul></div>";
        return $str;
    }
?>