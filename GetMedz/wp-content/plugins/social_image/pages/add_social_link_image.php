<?PHP
	//compact($_POST);

	if( $_POST ) {
	
		$imagetitle			= $_POST["name"];
		$first_image		= $_FILES["firstimage"]["name"];
		#$second_image		= $_FILES["secondimage"]["name"];
		$image_link			= $_POST["imagelink"];
			
		
			
				//image upload..
				$fileName=time().$_FILES["firstimage"]["name"];
				
				if(move_uploaded_file($_FILES["firstimage"]["tmp_name"], WP_CONTENT_DIR."/uploads/images/".$fileName)){
		
				//	$pic=new Thumbnail();
					$pic->filename	= WP_CONTENT_DIR."/uploads/images/".$fileName;
					$pic->filename2	= WP_CONTENT_DIR.'/uploads/images/photo/photo_'.$fileName;
					/*  $pic->maxW=400;
					$pic->SetNewWH();
					$pic->MakeNew();
					$pic->FinirPImage() */; 
					
				}
				
				/* $feName=time().$_FILES["secondimage"]["name"];
					if(move_uploaded_file($_FILES["secondimage"]["tmp_name"],WP_CONTENT_DIR."/uploads/images/image/".$feName)){
		
					//$pic=new Thumbnail();
					
					$pic->filename	= WP_CONTENT_DIR.'/uploads/images/image/'.$feName;
					$pic->filename2	= WP_CONTENT_DIR.'/uploads/images/image/photo/photo_'.$feName;
					 
					  $pic->maxW=400;
					$pic->SetNewWH();
					$pic->MakeNew();
					$pic->FinirPImage(); 
				} */
				
				$sql="INSERT INTO wp_sociallink(image_title,image_mouse_over,image_link) VALUES('".$imagetitle."','".$fileName."','".$image_link."')";
				mysql_query($sql) or die('mysql error');
				
				print("<script>window.location='". get_bloginfo('home')."/wp-admin/admin.php?page=social_links&action=add_image&sv=1'</script>");
			}			
			if( isset($_REQUEST["sv"]) && $_REQUEST["sv"]=='1' ) {
			echo "<b>Saved Successfully.<b>";
	}

?>

		<h1> Add Social Network Image :  </h1>
	
	<form name="form1" method="post" id="form1" action="" enctype="multipart/form-data" >
		
		<table  cellspacing='5' cellpadding="5">
		
			<tr>
				<td>Image Title</td>
				<td>
					<input type="text" name="name" class="name" id="name" value=""  style="width:200px;" Placeholder="Image Title"/>
					
				</td>
			</tr>
			<tr>
				<td>On Mouse Over Image</td>
				<td>
					<input type="file" name="firstimage" class="firstimage" id="firstimage" value="" style="width:200px;" />
					
				</td>
			</tr>
			<!--tr>
				<td>On Mouse Out Image</td>
				<td>
				   <input type="file" name="secondimage" class="secondimage" id="secondimage" value="" style="width:200px;"/>
					
				</td>
			</tr-->
			<tr>
				<td>Image Link</td>
				<td>
				   <input type="text" name="imagelink" class="imagelink" Placeholder="www.google.com" id="imagelink" value="" style="width:200px;"/>
					
				</td>
			</tr>
				<tr>
				<td></td>
					<td><input name="" type="submit" id="btnsubmit" class="submitB"  value="Add" class="button" />
						<input type="button" value="Back"  class="resetB" onclick="window.location='<?php bloginfo('home')?>/wp-admin/admin.php?page=social_links'"/></td>
				</tr>
		</table>
		
	</form>

       

