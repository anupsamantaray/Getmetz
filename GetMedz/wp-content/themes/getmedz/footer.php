	</div>	
	<!--footer-->
    <div class="footer">
    	<div class="container">
			<div class="row">
				<div class="col-md-12 sub_footer">
					<div class="col-md-5">
						<?php echo wpmb_footermenu()?>
						<p>Powered by Prochnost’ Technologies Pvt Ltd</p>
					</div>
					<div class="col-md-5">
						<h3>Get Medz Ltd.</h3>
						<p>XX Your Street, City, State/Province, PIN : xxxxxxx <br/> info@getmedz.com <br/>+xx (x) xxxx xxx xxx</p>
					</div>
					<div class="col-md-2">
						<a href="" class=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_logo.png" class="" alt=""/></a>
						
						
						<div class="social_div">
							<?php
								$rs = mysql_query("SELECT * FROM  wp_sociallink ORDER BY image_id ASC");
								while($RESULT=mysql_fetch_assoc($rs)){
							?>
							<a href="//<?php echo $RESULT['image_link']?>" target="_blank"><img src="<?php echo WP_CONTENT_URL ?>/uploads/images/<?php echo $RESULT['image_mouse_over']; ?>" class="" title="<?php echo $RESULT['image_title']?>" /></a>
							<?php }?>
						</div>
						<!--div class="social_div">
							<a href="" class=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/fb.png" class="" alt=""/></a>
							<a href="" class=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/google.png" class="" alt=""/></a>
							<a href="" class=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/mail.png" class="" alt=""/></a>
						</div-->
						<div class="clr"></div>
					</div>
				</div>
			</div>
		</div>
    </div> 
</div>
<?php wp_footer(); ?>
</body>
</html>