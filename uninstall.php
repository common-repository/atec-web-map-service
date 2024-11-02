<?php
	if (!defined('ABSPATH')) die;
	wp_cache_delete('atec_wms_version');
	delete_option('atec_WMS_settings');
?>