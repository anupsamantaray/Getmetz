<?PHP
$id=$_REQUEST["id"];

if (isset($_REQUEST["upd"])&& $_REQUEST["upd"]=='1'){
		echo "<b style='color:#2E8B57;'>Updated successfully.</b>";
}

if (isset($_REQUEST["pqr"])&& $_REQUEST["pqr"]=='1'){
		echo "<b style='color:#FF0000;'>Request Deleted Successfully.</b>";
}

?>

<script type="application/javascript">
function confirmDelete() {
	if( confirm( "Do you really want to delete this request ?" ) ) {
		return true;
	} else {
		return false;
	}
}
</script>
<h1>Social Link Details </h1>
	<table>
		<tr>
			<td>
				<input name="" type="button" align="right" value="Add Social Link Image " class="button" onclick="location.href='<?php bloginfo('home')?>/wp-admin/admin.php?page=social_links&action=add_image'"/>
			</td>	
			
	   </tr>
   </table>
<table class="wp-list-table widefat fixed ">
	<tr>
		<thead>
			<th>Image Title</th>
			<th>Social Link Image</th>
			<th>Image Link</th>
			<th style="width: 100px;">&nbsp;Action  </th>
		</thead>	
	</tr>
	<?
	$rs = mysql_query("SELECT * FROM  wp_sociallink ORDER BY image_id DESC ");
		  while($RESULT=mysql_fetch_assoc($rs)){
	?>	
	<tr>
		<td><?echo $RESULT['image_title'] ?></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo WP_CONTENT_URL?>/uploads/images/<?echo $RESULT['image_mouse_over'] ?>" width="30" height="30"/></td>
		<td><?echo $RESULT['image_link'];?></td>
		
		<td style="width:100px;">
		<a href="<?php bloginfo('home')?>/wp-admin/admin.php?page=social_links&action=edit_image&prd_id=<?echo 	$RESULT["image_id"]?>" title="Edit The Request"><img src="<?php bloginfo('template_url');?>/img/editImg.png"/></a>
		&nbsp;&nbsp;
		<a href="<?php bloginfo('home');?>/wp-admin/admin.php?page=social_links&action=delete_image&image_id=<? echo $RESULT["image_id"]?>" title="Delete The Request" onClick="return confirmDelete();"><img src="<?php bloginfo('template_url');?>/img/delete.gif" /></a>
		</td>
	</tr>

	<?
	}

	?>

</table>