<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header('blog'); 
?>

<section class="section-1">
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
			$comments_count = wp_count_comments( get_the_ID() );
			if($comments_count->total_comments == 0) {
				$chtml = "0 Comment";
			} else if($comments_count->total_comments == 1) {
				$chtml = "1 Comment";
			} else if($comments_count->total_comments > 1) {
				$chtml = $comments_count->total_comments." Comments";
			}?>
			<div class="col-md-9">
				<div class="section-top-image">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/blogdetail_top.png" />
				</div>
				<div class="section-top">
					<h1><?php the_title()?></h1>
					<ul class="list-inline">
						<li><p><?php the_time('d M Y')?>, Posted by <span><?php the_author()?></span></p></li>
						<li><p><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/time_icon.png"/> <?php the_time('M d, Y')?></p></li>
						<!--li> <p><img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/chat_icon.png"/> <?php //echo $chtml?></p></li-->
					</ul>                           
				</div> <!--End of top section-->
				<div class="clr"></div>
				<div class="image-body">
					<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );?>
						<img src="<?php echo $image[0];?>" class="body-image"/>
					<?php endif;?>
					
					<div class="social">               
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/share.png"/> 
						<ul><!--social ul-->
							<li><a href="https://www.facebook.com/sharer.php?u=<?php echo get_page_link($_GET['p']);?>?postId=<?=$post->ID;?>&postDate=<?=$postDate;?>&postDay=<?=$postDay;?>&postYear=<?=$postYear;?>&author=<?=$author;?>&title=<?=$title;?>&content=<?=$c;?>&t=<?php echo urlencode($post->post_title); ?>" target="_blank"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/facebook.png" alt="Facebook"/></a></li>
							
							<li><a href="http://twitter.com/share?text=<?php echo urlencode($post->post_title); ?>&url=<?php echo get_page_link($_GET['p']);?>?postId=<?=$post->ID;?>&postDate=<?=$postDate;?>&postDay=<?=$postDay;?>&postYear=<?=$postYear;?>&author=<?=$author;?>&title=<?=$title;?>&content=<?=$c;?>" target="_blank"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/twitter.png" alt="Twitter"/></a></li>
							
							<li><a href="https://plus.google.com/share?url=<?php echo get_page_link($_GET['p']);?>?postId=<?=$post->ID;?>&postDate=<?=$postDate;?>&postDay=<?=$postDay;?>&postYear=<?=$postYear;?>&author=<?=$author;?>&title=<?=$title;?>&content=<?=$c;?>" target="_blank"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/google-plus.png" alt="Google plus"/></a></li>
							
							<li><a href="#"> <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/in.png" alt="In"/></a></li>
						</ul><!--social ul end-->                 
					</div>
				</div>
				 <div class="section-content text-justify">
					<p><?php the_content()?></p>
				 </div>
			</div>			
		<?php endwhile; ?>
		<?php get_sidebar( 'blog' ); ?>
	</div>
</section> 
<?php get_footer(); ?>
