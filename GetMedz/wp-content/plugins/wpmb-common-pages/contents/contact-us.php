<!--body_content-->	
<div class="about_body">
	<h1 class="titletext_three">Contact Info</h1>
	<p>You can contact us any way that is convenient for you. We are available 24/7 via fax, email or telephone. You can also use a quick contact form on the right or visit our office personally.Email us with any questions or inquiries or use our contact data. We would be happy to answer your questions.</p>
	<div class="common_bodydiv">
		<?php if($_SESSION['sucmsg']) : ?>
			<div>
				<?php  echo $_SESSION['sucmsg']; unset($_SESSION['sucmsg']);?>
			</div>
		<?php endif?>
		<div class="col-md-6 commonleft">
			<h2>Contact form</h2>
			<div class="contact_from">
				<form action="" method="post" id="contactus_form">
					<div class="col-sm-6 fronLeft">
						<input class="inputfrom" id="first_name" placeholder="Fast Name" type="text" name="data[first_name]">
					</div>
					<div class="col-sm-6 fronLeft">
						<input class="inputfrom" id="last_name" placeholder="Last Name" type="text" name="data[last_name]">
					</div>
					<div class="col-sm-6 fronLeft">
						<input class="inputfrom" id="email" placeholder="Email" type="text" name="data[email]">
					</div>
					<div class="col-sm-6 fronLeft">
						<input class="inputfrom" id="phone" placeholder="Phone no." type="text" name="data[phone]">
					</div>
					<div class="col-sm-12 fronLeft">
						<textarea id="message" rows="4" class="inputfrom" placeholder="Your Message..." name="data[message]"></textarea>
						<input value="SEND" class="send_button" type="button" id="send_quote_btn">
					</div>
					<input type="hidden" value="contact_us" name="wpmb_choice">
				</form>
				<div class="clr"></div>
			</div>
		</div>
		<div class="col-md-6 commonright">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.0990546558182!2d88.42704031448146!3d22.612775937194638!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89e278c331ced%3A0xce09876e8a92eac8!2sBaguihati+Jora+Mandir!5e0!3m2!1sen!2sin!4v1454170642729" width="100%" height="482" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="clr"></div>
	</div>
</div>
<script>
	jQuery("#send_quote_btn").bind('click', function() {
		var isValid = true;
		var msg = '';
		var first_name = jQuery("#first_name").val();
		var last_name = jQuery("#last_name").val();
		var email = jQuery("#email").val();
		var phone = jQuery("#phone").val();
		var message = jQuery("#message").val();
		if(first_name == '') {
			msg += 'Enter First Name' + "\n";
			isValid = false;
		}
		if(last_name == '') {
			msg += 'Enter Lat Name' + "\n";
			isValid = false;
		}
		if(email == '') {
			msg += 'Enter email' + "\n";
			isValid = false;
		}if(phone == '') {
			msg += 'Enter phone' + "\n";
			isValid = false;
		}
		if(message == '') {
			msg += 'Enter message' + "\n";
			isValid = false;
		}
		if(isValid) {
			jQuery("#contactus_form").submit();
		} else {
			alert(msg);
		}
	});
</script>