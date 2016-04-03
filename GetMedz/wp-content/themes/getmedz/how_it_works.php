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
	<ul id="news">
		<?php foreach($posts_array as $ind => $postdata) : 
			if (has_post_thumbnail( $postdata->ID ) ):
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $postdata->ID ), array(190, 330) );
			endif;
			?>
			<li>
				<div class="blog_body featuresDiv<?php echo $ind;?>">
					<div class="common_bodydiv">
						<div class="col-md-6 blogleft blogleftfeat">
							<h2 class="getapp"><?php echo $postdata->post_title?></h2>
							<?php echo $postdata->post_content?>
						</div>
						<div class="col-md-6 workright1 blogleftfeat">
							<div class="mobcontent">
								<img src="<?php echo $image[0];?>" width="190" height="330">
							</div>
						</div>
						<div class="clr"></div>
					</div>
				</div>
			</li>
		<?php endforeach; wp_reset_query();?>
	</ul>
</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/js/jquery.mousewheel.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/js/slider.js"></script>
<script>	
	jQuery(document).ready(function(){
		$('#news').mbvslider();
		var mouseWheelEvent = (navigator.userAgent.indexOf("Firefox") != -1) ? "DOMMouseScroll" : "mousewheel";
		$('.newAllfeatures').on(mouseWheelEvent, mouseScrollHowitwork);
		$(document).keypress(function(e) {
			var code = (e.keyCode ? e.keyCode : e.which);
			if (code == 40) {
				jQuery('.btn-next').trigger("click");
			} else if (code == 38) {
				jQuery('.btn-pre').trigger("click");
			}
		});
		function mouseScrollHowitwork(e) {
			e.preventDefault();
			$('.newAllfeatures').off(mouseWheelEvent);
			setTimeout(function(){
				$('.newAllfeatures').on(mouseWheelEvent, mouseScrollHowitwork);
			}, 500);
			var direction = (function () {
				var delta = (e.type === 'DOMMouseScroll' ? e.originalEvent.detail * -40 : e.originalEvent.wheelDelta);
				return delta > 0 ? 0 : 1;
			}());
			if(direction === 1) {
				jQuery('.btn-next').trigger("click");
				//console.log('down');
			}
			if(direction === 0) {
				jQuery('.btn-pre').trigger("click");
				//console.log('up');
			}
			
		}
	});
</script>
<?php get_footer();?>