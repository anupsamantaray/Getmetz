<?php 
	if(isset($_REQUEST['choice']) && $_REQUEST['choice'] == 'wpmb_save_options') {
		$_REQUEST['option']['message'] = stripcslashes($_REQUEST['option']['message']);
		update_option('wpmb_save_options',$_REQUEST['option']);
	}
	$options = get_option('wpmb_save_options');
?>

<div class="wrap">
	<h2>Common Settings</h2>
	<div class="setting-form">
		<form action="" method='post' onsubmit="">
			<input type="hidden" name="choice" value="wpmb_save_options">
			<table cellspacing='4' style="width:99%;">
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td>Email Subject Format</td>
					<td>
						<input type="text" name="option[subject]" value="<?php echo $options['subject']?>" class="pregular-text">
					</td>
				</tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td>Email Message Format</td>
					<td>
						<textarea name="option[message]" cols="10" rows="4" class="large-text"><?php echo stripcslashes($options['message'])?></textarea>
					</td>
				</tr>
				<tr><td colspan=2>&nbsp;</td></tr>
				<tr>
					<td colspan=2>
						<input type="submit" value="Save Settings" class="button-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<style>
	.pregular-text{width:250px;}
	.set_heading{ height:25px;padding:7px 0 0 5px; background-color:#EFEFEF;color: #21759B;font-family: sans-serif;}
</style>