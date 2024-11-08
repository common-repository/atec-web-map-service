<?php
if (!defined('ABSPATH')) { exit; }

class ATEC_wms_activation { function __construct() {
	
if (!defined('ATEC_TOOLS_INC')) require_once('atec-tools.php');	
atec_integrity_check(__DIR__);

$arr=['width','height','key','mono','lat','lng'];
$optName='atec_WMS_settings';
$options=atec_create_options($optName,$arr);

if ($options && isset($options['awms_apikey'])) // old version
{ 
	$arr['width']=$options['awms_width']; $arr['height']=$options['awms_height']; $arr['key']=$options['awms_apikey']; 
	delete_option('awms_settings'); 
}
if ($options['width']=='') $options['width'] = '100%';
if ($options['height']=='') $options['height'] = '100%';

update_option($optName,$options); 

}} new ATEC_wms_activation();
?>