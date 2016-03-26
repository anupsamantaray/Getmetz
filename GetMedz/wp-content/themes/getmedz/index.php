<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
		<!--notification-->

		<div class="notification">
			<div class="container">
				<div class="row">
					<div class="col-md-12 sub_notification">
						<h1>Customer Feedback </h1>
						<div class="sub_notification2">
							<div class="child_notification">
								<div class="text_notification">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nopic.png" class="nopic" alt=""/>
									<h3>
										<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/left.png" class="" alt=""/></span>Amarjit Jha
										<span><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/right.png" class="" alt=""/></span>
									</h3>
									<p>Amazing service. I was able to save more than 10% on my order and it was delivered to my doorstep in quick time.</p>
								</div>
							</div>
						<div class="next_prv">
							<a href="" class="next_arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/next.png" class="" alt=""/></a>
							<a href="" class="prv_arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/prv.png" class="" alt=""/></a>
							<div class="clr"></div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<!--body_content-->
		
		<div class="body_content">
			<?php 
			$posts_array = array();
			$posts_array = get_posts(
				array(
					'posts_per_page' => 4,
					'post_type' => 'homeother',
					'post_status' => 'publish'
				)
			);
			?>
			<?php foreach($posts_array as $pind => $postdata) : ?>
				<div class="col-md-6 rightbody">
					<div class="farmacy">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/body_bg.jpg" class="bodybg" alt=""/>
						<a href="javaScript:void(0);" class="hover_bodybg">
							<div class="subhover_bodybg">
								<center><img src="<?php echo get_post_meta($postdata->ID, 'posticon', true); ?>" class="" alt=""/></center>
								<h2><?php echo $postdata->post_title?></h2>
								<p><?php echo $postdata->post_content?></p>
								<input value="More Details" id="btnsubmit" type="button" class="footer_moredetail" onclick="location.href='<?php echo get_permalink( $postdata->ID ); ?>'">
								<div class="clr"></div>
							</div>
						</a>
					</div>
				</div>
			<?php endforeach;wp_reset_query();?>
			<div class="clr"></div>
		</div>	

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
