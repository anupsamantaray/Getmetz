<!--body_content-->	
<style>
	.myclass::-webkit-input-placeholder, .myclass::input-placeholder{ 
		color: #FF0000;
	}
	
	.red-border {
		border: 1px solid #FF0000 !important;
	}
	
	.suc_msg_section {
		color: green;
		margin-bottom: 10px;
	}
</style>
<div class="about_body">
	<h1 class="titletext_three">Contact Info</h1>
	<p>You can contact us any way that is convenient for you. We are available 24/7 via fax, email or telephone. You can also use a quick contact form on the right or visit our office personally.Email us with any questions or inquiries or use our contact data. We would be happy to answer your questions.</p>
	<div class="common_bodydiv">		
		<div class="col-md-6 commonleft">
			<h2>Contact form</h2>
			<div class="contact_from">
				<?php if($_SESSION['sucmsg']) : ?>
					<div class="suc_msg_section">
						<?php  echo $_SESSION['sucmsg']; unset($_SESSION['sucmsg']);?>
					</div>
				<?php endif?>
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
		$("#first_name, #last_name, #email, #phone, #message").removeClass('red-border');
		var fname 	= $("#first_name").val();
		var lname 	= $("#last_name").val();
		var emails 	= $("#email").val();
		var mobile	= $("#phone").val();
		var messag 	= $("#message").val();
		var email 	= document.getElementById('email');
		var filter 	= /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
		var isValid = true;
		if(fname==''){
			$("#first_name").attr('placeholder',"Enter first name.");
			$('#first_name').addClass('myclass');
			$('#first_name').addClass('red-border');
			isValid = false;
		}
		if(messag==''){
			$("#message").attr('placeholder',"Enter message.");
			$('#message').addClass('myclass');
			$('#message').addClass('red-border');
			isValid = false;
		}
		/* if(lname==''){
			$("#last_name").attr('placeholder',"Enter last name.");
			isValid = false;
		} */
		if(emails==''){
			$("#email").attr('placeholder',"Enter email id.");
			$('#email').addClass('myclass');
			$('#email').addClass('red-border');
			isValid = false;
		} else {
			if(!filter.test(email.value)){
				$("#email").val("");
				$("#email").attr('placeholder',"Enter valid  email id.");
				$('#email').addClass('myclass');
				$('#email').addClass('red-border');
				isValid = false;
			}
		}
		
		if(mobile==''){
			$("#phone").attr('placeholder',"Enter mobile no.");
			$('#phone').addClass('myclass');
			$('#phone').addClass('red-border');
			isValid = false;
		} else{
			if(((mobile.length) < 10) || ((mobile.length) > 10) || (isNaN(mobile))){
				$("#phone").val("");
				$("#phone").attr('placeholder',"Enter valid mobile No");
				$('#phone').addClass('myclass');
				$('#phone').addClass('red-border');
				isValid = false;
			}	
		}
		if(isValid) {
			jQuery("#contactus_form").submit();
		}
	});
</script>