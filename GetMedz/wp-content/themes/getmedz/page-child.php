<?php
/*
Template Name: Child Page Template
*/

get_header('inner'); ?>
<section class="section-1">
	<div class="container">
		<div class="col-md-9">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="section-top">
					<h2 class="titletext_two"><?php the_title()?></h2>
				</div>
				<div class="clr"><br></div>
				<div class="section-content text-justify">
					<?php the_content();?>
				</div>
			<?php endwhile;?>
		</div>
	</div>
</section>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>