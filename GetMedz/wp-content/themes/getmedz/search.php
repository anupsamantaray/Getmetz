<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header('inner'); ?>

	<!--body_content-->
	<?php 
		$posts_array = array();
		$posts_array = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type' => 'post',
				'post_status' => 'publish',
				"s" => $_GET['s']
			)
		);
	?>
	<!--faq description section end-->
	<div class="blog_body">
		<?php if(!empty($posts_array)) : ?>
			<?php foreach($posts_array as $ind => $postdata) : ?>
				<?php
					if (has_post_thumbnail( $postdata->ID ) ):
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postdata->ID ), 'single-post-thumbnail' );
					endif;
					$comments_count = wp_count_comments( $postdata->ID );
					if($comments_count->total_comments == 0) {
						$chtml = "0 Comment";
					} else if($comments_count->total_comments == 1) {
						$chtml = "1 Comment";
					} else if($comments_count->total_comments > 1) {
						$chtml = $comments_count->total_comments." Comments";
					}
				?>
				<div class="common_bodydiv">
					
					<?php if(($ind % 2) == 0) : ?>
						<div class="col-md-6 commonright">
							<img src="<?php echo $image[0]; ?>" class="about_1" alt=""/>
						</div>
					<?php else : ?>
						<div class="col-md-6 blogleft">
							<h2><?php echo $postdata->post_title?></h2>
							<h3>
								<i><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/time_icon.png" class="" alt=""/></i> <?php echo get_the_time('M n, Y', $postdata->ID); ?>
								<span><i><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/chat_icon.png" class="" alt=""/></i> <?php echo $chtml; ?> </span>
							</h3>
							<p><?php echo $postdata->post_content?></p>
							<input value="More Details" id="btnsubmit" class="about_moredetail" type="button" onclick="location.href='<?php echo get_permalink( $postdata->ID ); ?>'">
						</div>
					<?php endif;?>
					<?php if(($ind % 2) == 0) : ?>
						<div class="col-md-6 blogleft">
							<h2><?php echo $postdata->post_title?></h2>
							<h3>
								<i><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/time_icon.png" class="" alt=""/></i> <?php echo get_the_time('M n, Y', $postdata->ID); ?>
								<span><i><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/chat_icon.png" class="" alt=""/></i> <?php echo $chtml; ?></span>
							</h3>
							<p><?php echo $postdata->post_content?></p>
							<input value="More Details" id="btnsubmit" class="about_moredetail" type="button" onclick="location.href='<?php echo get_permalink( $postdata->ID ); ?>'">
						</div>
					<?php else : ?>
						<div class="col-md-6 commonright">
							<img src="<?php echo $image[0]; ?>" class="about_1" alt=""/>					
						</div>
					<?php endif;?>
				</div>
				<div class="clr"></div>
			<?php endforeach; wp_reset_query();?>
		<?php else : ?>
			<!--form search-->
			<br><br>
			<center><div class="input-holder">
				<form action="<?php bloginfo('home');?>" method="get">
					<div class="input-group">
						  <input type="text" name="s" class="form-control" placeholder="Search for" >
						  <span class="input-group-btn">
							<button class="btn btn-default" type="submit">Go!</button>
						</span>
					 </div><!-- /input-group -->
				</form>
			</div></center>
			<br><br>
		<?php endif;?>
	</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>