<div class="col-md-3">
	<aside>
		<div class="aside-top">
			<!--form search-->
			<div class="input-holder">
				<form action="<?php bloginfo('home');?>" method="get">
					<div class="input-group">
						  <input type="text" name="s" class="form-control" placeholder="Search for" >
						  <span class="input-group-btn">
							<button class="btn btn-default" type="submit">Go!</button>
						</span>
					 </div><!-- /input-group -->
				</form>
			</div>
		</div><!--aside top end-->
		<div class="add">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!--End of add-->
		<div class="aside-body"><!--aside body starts-->
			<p> Related posts</p>
			<?php 
				$posts_array = array();
				$posts_array = get_posts(
					array(
						'posts_per_page' => -1,
						'post_type' => 'post',
						'post_status' => 'publish'
					)
				);
			?>
			<ul>
				<?php foreach($posts_array as $ind => $postdata) : ?>
					<li>
						<div class="image-holder">
							<img src="http://1.gravatar.com/avatar/ab7b9b5e27ea106817cfa843cbf7029f?s=96&d=mm&r=g" class="img-circle" width="60px">
						</div>
						<div class="content-li">
							<h4><?php echo $postdata->post_title?></h4>
							<span><?php echo get_the_author($postdata->ID)?></span>
							<h5><?php echo substr($postdata->post_content, 0, 65);?></h5>
							<a href="<?php echo get_permalink( $postdata->ID ); ?>" class="pull-right">Read more...</a>
						 </div>   
						 <div class="clr">
						 </div>
					
					</li>
				<?php endforeach; wp_reset_query();?>
			</ul>
		</div><!--end of aside body-->
	</aside>
</div>