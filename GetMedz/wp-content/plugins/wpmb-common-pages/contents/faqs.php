<?php global $post;?>
<!--body_content-->
<section class="faq-des text-center">
	<div class="faq-top">
		<h1 class="border"><?php echo get_the_title( $post->ID);?></h1>
	</div>
	<div class="faq-body">
		<p><?php echo get_post_meta($post->ID, 'description', true)?></p>
	</div>
</section>
<?php 
	$cats = get_categories('taxonomy=category_faqs&type=faqs'); 
?>
<!--faq description section end-->
<div class="blog_body">
	<div class="common_bodydiv">
	<?php foreach($cats as $ind => $cat) : ?>
		<?php 
		$posts_array = array();
		$posts_array = get_posts(
			array(
				'posts_per_page' => -1,
				'post_type' => 'faqs',
				'tax_query' => array(
					array(
						'taxonomy' => 'category_faqs',
						'field' => 'term_id',
						'terms' => $cat->term_id,
					)
				)
			)
		);
		?>
		<?php if(($ind % 2) == 0) : ?><div class="section-2"><?php endif;?>
			<div class="col-md-6 newcommonright">					
				<div class="panel-wrapper">
					<h1><?php echo $cat->name?></h1>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<?php foreach($posts_array as $pind => $postdata) : ?>
							<div class="panel">
								<div class="panel-heading" role="tab" id="heading_<?php echo $ind?>_<?php echo $pind?>">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $ind?>_<?php echo $pind?>" aria-expanded="true" aria-controls="collapse_<?php echo $ind?>_<?php echo $pind?>"><?php echo $postdata->post_title?>?</a>
									</h4>
								</div>
								<div id="collapse_<?php echo $ind?>_<?php echo $pind?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $ind?>_<?php echo $pind?>">
									<div class="panel-body panel-sub">
										<p><?php echo $postdata->post_content?></p>
									</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>						
					<!--end of panel-->
				</div>
			</div>
			<?php if((($ind % 2) != 0) || count($cats)-1 == $ind) : ?></div><div class="clr"></div><?php endif;?>
		<?php endforeach;?>
	</div>
</div>