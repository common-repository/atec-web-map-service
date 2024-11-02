<?php
if (!defined( 'ABSPATH' )) { exit; }
  /**
  * Plugin Name:  atec web-map-service
  * Plugin URI: https://atecmap.com/
  * Description: Include the atecmap.com web map, with customizable location icon. Fully GDPR conform.
  * Version: 1.6.5
  * Requires at least: 5.2
  * Tested up to: 6.7
  * Requires PHP: 7.4
  * Author: Chris Ahrweiler
  * Author URI: https://atec-systems.com
  * Plugin URI: https://de.wordpress.org/plugins/atec-web-map-service/
  * License: GPL2
  * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
  * Text Domain:  atec-web-map-service
  */
  
if (is_admin()) 
{
	wp_cache_set('atec_wms_version','1.6.5');
   	register_activation_hook( __FILE__, function() { require_once('includes/atec-wms-activation.php'); });
	
	if (!defined('ATEC_ADMIN_INC')) require_once('includes/atec-admin.php');
  	add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'atec_plugin_settings' );

	require_once('includes/atec-wms-install.php');
}

function atec_wms_shortcode(): string
{ 
  $options=get_option('atec_WMS_settings',[]);
  return '<iframe style="border:none; width:'.($options['width']??'auto').'; height:'.($options['height']??'auto').';" src="https://atecmap.com?apikey='.($options['key']??'').'&mono='.($options['mono']?'true':'').'&lat='.($options['lat']??'').'&lon='.($options['lng']??'').'" sandbox="allow-scripts allow-popups"></iframe>';
}
add_shortcode( 'atec_wms_shortcode', 'atec_wms_shortcode' );
add_shortcode( 'include_atec_wms_here', 'atec_wms_shortcode' );
?>