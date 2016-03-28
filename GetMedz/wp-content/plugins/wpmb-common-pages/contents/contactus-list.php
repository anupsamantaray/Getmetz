<?php 
	global $wpdb;
	$url = $path = wpmb_cur_url();
	$delete_url = add_query_arg( 'wpmb_choice','delete',$url);
	$tbl		= $wpdb->prefix. "contactus";
	$sql 		= "SELECT * FROM `".$tbl."` ORDER BY id DESC";
	$rows 		= $wpdb->get_var("SELECT COUNT(*) FROM ".$tbl);
	$page_rows 	= 50;
	$page_nos 	= 4;
	$c_content 	= $page = array();
	$page 		= wpmb_pagedata($sql,$rows,$page_rows);
	$c_content 	= $page[0];	
?>
<link rel="stylesheet" type="text/css" href="<?php echo SPVGALLERY_PLUGIN_URL?>/css/plugin.css">
<div class="wrap">
	<h2>Contact Us Manage</h2>
		<table width="627" cellspacing="0" cellpadding="0" border="0" class="wp-list-table widefat">
			<tbody>
				<tr class="ft_header">
					<td><b>Sl No</b></td>
					<td><b>First Name</b></td>
					<td><b>Last Name</b></td>
					<td><b>Email</b></td>
					<td><b>Contact No</b></td>
					<td><b>Message</b></td>
					<td><b>Date/Time</b></td>
					<td width="100"><b>Action</b></td>
				</tr>
				<?php if(!empty($c_content)) : ?>
					<?php foreach($c_content as $k=>$v) : ?>
						<?php $_delete_url = add_query_arg( 'id',$v['id'],$delete_url);?>
						<tr>
							<td width="100"><?php echo $k?></td>
							<td><?php echo stripslashes($v['first_name'])?></td>
							<td><?php echo stripslashes($v['last_name'])?></td>
							<td><?php echo stripslashes($v['email'])?></td>
							<td><?php echo stripslashes($v['phone'])?></td>
							<td><?php echo stripslashes($v['message'])?></td>
							<td><?php echo stripslashes($v['create_date'])?></td>
							<td>
								<a href="<?php echo $_delete_url?>" title="delete" onclick="javascript:return confirm('Do you want to delete this record?')">Delete</a>
							</td>
						</tr>
					<?php endforeach?>
				<?php else : ?>
					<tr><td colspan=2 class="nfont"><br>No record(s) found</td></tr>
				<?php endif?>
			</tbody>
		</table>
		<?php if($page[1] > 1) : ?>
			<div id="page-counter" style="background:none;">
				<p>
					<?php echo wpmb_pagination($page,$page_nos,$path)?>
				</p>
			</div>
		<?php endif?>
		<div style="clear:both;"></div>
</div>