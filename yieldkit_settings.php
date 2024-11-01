<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (isset($_POST['update']) ) {	
	check_admin_referer( 'yieldkit_plugin_update_siteid_and_api_key' );
	global $wpdb;
	$yieldkit_api_key = sanitize_text_field( $_POST['yieldkit_api_key'] );
	$yieldkit_site_id = sanitize_text_field( $_POST['yieldkit_site_id'] );
	if ( strlen( $yieldkit_api_key ) > 33 ) {
	  $yieldkit_api_key = substr( $yieldkit_api_key, 0, 33 );
	}
	if ( strlen( $yieldkit_site_id ) > 33 ) {
	  $yieldkit_site_id = substr( $yieldkit_site_id, 0, 33 );
	}
	
	if(current_user_can( 'administrator' ) || current_user_can( 'super_admin' )){
		update_option('yieldkit_api_key', $_POST['yieldkit_api_key']);
		update_option('yieldkit_site_id', $_POST['yieldkit_site_id']);
		echo '<div id="message" class="updated fade"><p>Your settings have been changed.</p></div>';
	}else{
		echo '<div id="message" class="updated fade"><p>You do not have the permission to update these settings.</p></div>';
	}

}

?>
<div class="wrap">
<h2>YieldKit Settings</h2>
<p>To enable YieldKit you need to get your YieldKit API Key and Site ID at <a href="http://home.yieldkit.com/app/account" target="_blank">http://home.yieldkit.com/app/account</a>.</p>
<form method="post">
<table class="form-table">
	<tbody>
		<tr>
			<th scope="row"><label for="yieldkit_api_key">YieldKit API Key</label></th>
			<td><input style="width: 270px" type="text" name="yieldkit_api_key"
				size="33" maxlength="33	" value="<?php echo esc_attr( get_option('yieldkit_api_key') ); ?>" /></td>
		</tr>
		<tr>
			<th scope="row"><label for="yieldkit_site_id">Your Site ID</label></th>
			<td><input style="width: 270px" type="text" name="yieldkit_site_id"
				size="25" maxlength="33" value="<?php echo esc_attr(get_option('yieldkit_site_id')); ?>" /></td>
		</tr>


	</tbody>
</table>
<?php wp_nonce_field( 'yieldkit_plugin_update_siteid_and_api_key' ) ?>

<p class="submit"><input type="submit" value="Save" name="submit" /><input
	type="hidden" name="update" value="1" /></p>
</form>
</div>
