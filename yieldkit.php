<?php
/*
 Plugin Name: YieldKit Affiliate Marketing
 Plugin URI: http://yieldkit.com
 Description: YieldKit generates affiliate links out of already existing product links and product names, brands or merchants - fully automatically.
 Author: YieldKit
 Version: 1.8
 Author URI: http://yieldkit.com
 */


define ("YIELDKIT_VERSION", "1.8");

if (!class_exists('YieldKit')) {
	class YieldKit	{

		var $version;
		var $api_key;
		var $site_id;
	
			
		/**
		 * PHP 4 Compatible Constructor
		 */
		function YieldKit(){$this->__construct();}

		/**
		 * PHP 5 Constructor
		 */
		function __construct(){

			$this->version = YIELDKIT_VERSION;
			$this->api_key = get_option('yieldkit_api_key');
			$this->site_id = get_option('yieldkit_site_id');

			if(is_admin()){
				add_action('admin_menu', array(& $this, 'admin_menu'));	
			}
			
			add_action( "wp_footer", array(& $this, 'yieldkit_plugin') );

		}

		function admin_menu(){
			//global $menu, $submenu;
			add_submenu_page('options-general.php', 'YieldKit', 'YieldKit', 8, 'yieldkit_settings', array(& $this, 'admin_menu_template'));
		}

		function admin_menu_template() {
			include("yieldkit_settings.php");
		}

	
		// adds the YieldKit JavaScript to the footer
		function yieldkit_plugin() {
			$api_key = get_option('yieldkit_api_key');
			$site_id = get_option('yieldkit_site_id');
			if( $api_key && $site_id ) {
			?>
		  	<script type="text/javascript">
			  	(function () { 
						var scriptProto = 'https:' == document.location.protocol ? 'https://' : 'http://'; 
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.async = true;
						script.src = scriptProto+'js.srvtrck.com/v1/js?api_key=<?php print ( $api_key ); ?>&site_id=<?php print ( $site_id ); ?>';
						(document.getElementsByTagName('head')[0] || document.body).appendChild(script); 
				})();
			</script>
			<?php
		  	}
		}

	}
}

//instantiate the class
if (class_exists('YieldKit')) {
	$YieldKit = new YieldKit();
}

?>