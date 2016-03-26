<?php global $post;?>
<div class="about_body">
	<h1><?php echo get_the_title( $post->ID);?></h1>
	<p><?php echo get_post_meta($post->ID, 'description', true)?></p>

	<?php 
		$subs = new WP_Query( array( 'post_parent' => $post->ID, 'post_type' => 'page', 'meta_key' => '_thumbnail_id' ));
		if( $subs->have_posts() ) : 
			$ind = 0;
			while( $subs->have_posts() ) : $subs->the_post(); 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );?>
				<div class="common_bodydiv">
					<?php if(($ind % 2) == 0) : ?>
						<div class="col-md-6 commonright">
							<img src="<?php echo $image[0];?>" class="about_1" alt=""/>
						</div>
					<?php else : ?>
						<div class="col-md-6 commonleft">
							<h2 class="titletext_two"><?php the_title()?></h2>
							<?php the_content();?>
							<input value="More Details" id="btnsubmit" class="about_moredetail" type="button" onclick="location.href='<?php echo get_permalink( get_the_ID()); ?>'">
						</div>
					<?php endif;?>
					<?php if(($ind % 2) == 0) : ?>
						<div class="col-md-6 commonleft">
							<h2 class="titletext_two"><?php the_title()?></h2>
							<?php the_content();?>
							<input value="More Details" id="btnsubmit" class="about_moredetail" type="button" onclick="location.href='<?php echo get_permalink( get_the_ID()); ?>'">
						</div>
					<?php else : ?>
						<div class="col-md-6 commonright">
							<img src="<?php echo $image[0];?>" class="about_1" alt=""/>
						</div>
						<div class="clr"></div>
					<?php endif;?>
				</div>
			<?php
			$ind++;
			endwhile; 
		endif; wp_reset_postdata(); ?>
</div>