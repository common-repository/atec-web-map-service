<?php
if (!defined( 'ABSPATH' )) { exit; }

function atec_WMS_settings_fields(): void
{
  $page_slug 		= 'atec_WMS';
  $option_group 	= $page_slug.'_settings';
  $section				= $page_slug.'_section';
  $options 			= get_option($option_group,[]); 

  if (!defined('ATEC_CHECK_INC')) require_once('atec-check.php');

  register_setting($page_slug,$option_group);
  add_settings_section($section,'','', $page_slug);

  add_settings_field('mono', __('Monochrome','atec-web-map-service'), 'atec_checkbox'  , $page_slug, $section, ['name'=> 'mono', 'opt-name' => $option_group]);
  add_settings_field('width', __('Width','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 640px or 100%)</span>', 'atec_input_text', $page_slug, $section, atec_opt_arr('width','WMS'));
  add_settings_field('height', __('Height','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 480px or 100%)</span>', 'atec_input_text', $page_slug, $section, atec_opt_arr('height','WMS'));

  add_settings_field('key', __('API-Key','atec-web-map-service').'<br><span class="small">(optional)</span>', 'atec_input_text', $page_slug, $section, atec_opt_arr('key','WMS'));
  add_settings_field('lat', __('Latitude','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 51.242494760)</span>', 'atec_input_text', $page_slug, $section, atec_opt_arr('lat','WMS'));
  add_settings_field('lng', __('Longitude','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 6.7780494689)</span>', 'atec_input_text', $page_slug, $section, atec_opt_arr('lng','WMS'));
}
add_action( 'admin_init',  'atec_WMS_settings_fields' );
?>
