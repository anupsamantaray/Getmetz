<?php
/**
 Template Name: How It Works
*/
get_header('inner');
?>
<!--body_content-->
<div class="newAllfeatures">
	<div class="commonmobile">
		<img src="<?php bloginfo( 'template_url' );?>/img/mobile_pic.png" class="mobilpic" alt=""/>
	</div>
	<?php 
	$posts_array = array();
	$posts_array = get_posts(
		array(
			'posts_per_page' => -1,
			'post_type' => 'howitworks',
			'post_status' => 'publish'
		)
	);
	?>
	<?php foreach($posts_array as $ind => $postdata) : ?>
		<div class="blog_body featuresDiv<?php echo $ind;?>">
			<div class="common_bodydiv">
				<div class="col-md-6 blogleft blogleftfeat">
					<h2 class="getapp"><?php echo $postdata->post_title?></h2>
					<?php echo $postdata->post_content?>
				</div>
				<div class="col-md-6 workright<?php echo $ind+1;?> blogleftfeat">
					<div class="mobcontent">
					</div>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	<?php endforeach; wp_reset_query();?>
</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/js/jquery.mousewheel.js"></script>
<script>	
	jQuery(document).ready(function(){
		var h_slides = jQuery('.newAllfeatures').find('.blog_body').length;
		var slideContent = ["", "featuresDiv2", "featuresDiv1", "featuresDiv0" ];
		var h_current_slide = 0;
		var h_prev_slide = 0;		
		jQuery('.newAllfeatures').bind('mousewheel', function(e){
			jQuery('.newAllfeatures .blog_body').fadeOut('slow');
			if(e.originalEvent.wheelDelta / 120 > 0) {
				h_prev_slide = h_current_slide;
				h_current_slide = (h_current_slide === 0) ? h_slides-1 : h_current_slide-1;
				jQuery('.featuresDiv'+ h_prev_slide).fadeOut('slow');
				jQuery('.featuresDiv'+ h_current_slide).fadeIn('slow');
			} else {
				h_prev_slide = h_current_slide;
				h_current_slide = (h_current_slide === h_slides-1) ? 0 : h_current_slide+1;
				jQuery('.featuresDiv'+ h_prev_slide).fadeOut('slow');
				jQuery('.featuresDiv'+ h_current_slide).fadeIn('slow');
			}
		});
	});
</script>
<?php get_footer();?>