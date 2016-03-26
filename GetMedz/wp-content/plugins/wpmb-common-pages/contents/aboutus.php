<?php global $post;?>
<div class="about_body">
	<h1><?php echo get_the_title( $post->ID);?></h1>
	<p><?php echo get_post_meta($post->ID, 'description', true)?></p>
	<div class="common_bodydiv">
		<div class="col-md-6 commonright">
			<img src="img/about_1.jpg" class="about_1" alt=""/>
		</div>
		<div class="col-md-6 commonleft">
			<h2 class="titletext_two">Vision & Mission</h2>
			<h3>Vision</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
			<h3>Mission</h3>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
			<input value="More Details" id="btnsubmit" class="about_moredetail" type="submit">
		</div>
		<div class="clr"></div>
	</div>
	<div class="common_bodydiv">
		<div class="col-md-6 commonleft">
			<h2 class="titletext_one">Why Us & Some statistics</h2>
			<ul>
				<li>Lorem Ipsum is simply dummy text of the printing</li>
				<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
				<li>Lorem Ipsum is simply dummy text of the printing</li>
				<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
				<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
			</ul>
			<input value="More Details" id="btnsubmit" class="about_moredetail" type="submit">
		</div>
		<div class="col-md-6 commonright">
			<img src="img/about_2.jpg" class="about_1" alt=""/>
		</div>
		<div class="clr"></div>
	</div>
</div>