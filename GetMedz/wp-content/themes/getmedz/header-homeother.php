<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--meta name="viewport" content="width=device-width, initial-scale=1.0" --/>

<!--link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.png" type="image/png"-->
<title><?php wp_title();?></title>

<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/style_sheet.css" rel="stylesheet" type="text/css" />
<!--link href="css/responsive.css" rel="stylesheet" type="text/css" /-->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="<?php echo get_stylesheet_directory_uri(); ?>/bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<?php wp_head()?>
</head>

<body>
<div class="wraperr">
<!--body-->
	<div class="bodycon">
		<div class="menu_nav" style="z-index:9999;">
			<div class="second_logo">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/slide_menulogo.png" class="" alt=""/>
				<div class="slide_cross">
					<a href="javaScript:void(0);"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cross_icon.png" class="" alt=""/></a>
				</div>
			</div>
			<div class="navisation">
				<?php echo wpmb_navmenu();?>
				<div class="clr"></div>
			</div>
		</div>
				
		<div class="iner_hader">	
			<div class="col-md-6 sub_hader">
				<a href="javaScript:void(0);" style="margin-right:50px;">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/menuicon.png" class="menuicon" alt=""/>
				</a>
				<a href="<?php bloginfo('home');?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" class="" alt=""/>
				</a>
			</div>
			<div class="col-md-6 sub_hader2">
				<h1>Details</h1>
			</div>
			<div class="clr"></div>
		</div>