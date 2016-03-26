<?
//	$errorData = array();
	
	$prd_id = $_REQUEST["prd_id"];
	
	if( $_POST ) {
		$title 			= $_POST["name"];
		$firstmage 		= $_FILES["firstImage"]['name'];
		#$secondimage	= $_FILES["secondImage"]['name'];
		$imagelink 		= $_POST["imagelink"];
		$oldPic		 	= $_POST["oldPic"];
		#$oldPicsec	 	= $_POST["oldPicsec"];
		$prd_id 		= $_POST["prd_id"];
		//first image upload..
		if( isset( $_FILES["firstImage"] ) and $_FILES["firstImage"]!='' ) {
			$fName=time().$_FILES["firstImage"]["name"];
			if(move_uploaded_file($_FILES["firstImage"]["tmp_name"], WP_CONTENT_DIR."/uploads/images/".$fName)){
				$link= WP_CONTENT_DIR."/uploads/images/".$oldPic;
				if(filesize($link)>0)
					unlink($link);
			}
			else {	
				//$fName = $_POST['hid_filename'];
				$fName = $oldPic;
			}
		}
		else{
			//$fName = $_POST['hid_filename'];
			$fName = $oldPic;
		}
		// second image
		/* if( isset( $_FILES["secondImage"] ) and $_FILES["secondImage"]!='' ) {
			if(move_uploaded_file($_FILES["secondImage"]["tmp_name"], WP_CONTENT_DIR."/uploads/images/image/".$secondimage)){
	
				$link= WP_CONTENT_DIR."/uploads/images/image/".$oldPicsec;
				if(filesize($link)>0)
					unlink($link);
			
			}
			else {	
				$secondimage = $oldPicsec;
			}
		}
		else{
			$secondimage = $oldPicsec;
		} */
			
		mysql_query("UPDATE wp_sociallink SET
					image_title='".$title."',
					image_mouse_over='".$fName."',
					image_link='".$imagelink."'
				WHERE image_id='".$prd_id."'")or die(mysql_error());
				
		print("<script>window.location='". get_bloginfo('home')."/wp-admin/admin.php?page=social_links&upd=1'</script>");
	}		
	else{
		if( isset( $prd_id ) ) {
			$q = "SELECT * FROM  wp_sociallink WHERE image_id='".$_REQUEST["prd_id"]."'";
			$QUERY_PRODUCT = mysql_query( $q );
			$RESULT = mysql_fetch_assoc( $QUERY_PRODUCT );
			$title 			= $RESULT["image_title"];
			$oldImage		= $RESULT["image_mouse_over"];
			#$secondimage	= $RESULT["image_mouse_left"];
			$imagelink 		= $RESULT["image_link"];
			
		}
	}
?>
<h1>Edit Social Link Image: </h1>
	 
<form name="form1" method="post" id="form1" action="" enctype="multipart/form-data" >
<input type="hidden" name="prd_id" id="prd_id" value="<?=$prd_id?>" />
<input type="hidden" name="oldPic" id="oldPic" value="<?=$oldImage?>" />
<input type="hidden" name="oldPicsec" id="oldPicsec" value="<?=$secondimage?>" />
           <table>
				<tr>
					<td>Image Title</td>
					<td>
						<input type="text" name="name" class="name" id="name" value="<?=$title?>" style="width:200px;" />
						
					</td>
				</tr>
				<tr>
					<td>Soclal Link Image</td>	
					<td align="left">
						<span style="float:left;">
							<img src="<?php echo WP_CONTENT_URL?>/uploads/images/<? echo $oldImage?>" width="30" height="30" />
						</span>
						<span style="float:left; padding:10px; color:#000000;">
							<input name="firstImage" id="firstImage" style="width:200px;" type="file" />
						</span>
					</td>
				</tr>
				<!--tr>
					<td>On Mouse Left</td>
						<td align="left">
							<span style="float:left;">
								<img src="<?php echo WP_CONTENT_URL?>/uploads/images/image/<? echo $secondimage?>" width="30" height="30" />
							</span>
							<span style="float:left; padding:10px; color:#000000;">
								<input name="secondImage" id="secondImage" style="width:200px;" type="file" />
							</span>
					</td>
					
				</tr-->
				<tr>
					<td>Image Link</td>
					<td>
						<input type="text" name="imagelink" class="imagelink" id="imagelink" value="<?=$imagelink?>" style="width:200px;"/>
						
					</td>
				</tr>
				
			
				<tr>
					<td></td>
                        <td><input name="" type="submit"  id="btnsubmit" value="Save" class="button" />
                		<input name="" type="button" value="Back" class="button" onclick="window.location='<?php bloginfo('home')?>/wp-admin/admin.php?page=social_links'"/></td>
                    </tr> 
           </table>

</form>
