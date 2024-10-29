<?php
if (!defined( 'ABSPATH' )) { exit; }

function atec_WMS_settings_fields(): void
{
  $page_slug 		= 'atec_WMS';
  $option_group 	= $page_slug.'_settings';
  $section				= $page_slug.'_section';
  $options 			= get_option($option_group,[]); 

  register_setting($page_slug,$option_group);
  add_settings_section($section,'','', $page_slug);

  add_settings_field('mono', __('Monochrome','atec-web-map-service'), 'atec_checkbox'  , $page_slug, $section, ['name'=> 'mono', 'opt-name' => $option_group]);
  add_settings_field('width', __('Width','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 640px or 100%)</span>', function ($options) { atec_WMS_text($options,'width',false); }, $page_slug, $section);
  add_settings_field('height', __('Height','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 480px or 100%)</span>', function ($options) { atec_WMS_text($options,'height',true); }, $page_slug, $section);

  add_settings_field('key', __('API-Key','atec-web-map-service').'<br><span class="small">(optional)</span>', function ($options) { atec_WMS_text($options,'key',true); }, $page_slug, $section);
  add_settings_field('lat', __('Latitude','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 51.242494760)</span>', function ($options) { atec_WMS_text($options,'lat',false); }, $page_slug, $section);
  add_settings_field('lng', __('Longitude','atec-web-map-service').'<br><span class="small">('.__('E.g.','atec-web-map-service').': 6.7780494689)</span>', function ($options) { atec_WMS_text($options,'lng',false); }, $page_slug, $section);
}
add_action( 'admin_init',  'atec_WMS_settings_fields' );
function atec_WMS_text($options,$field,$br): void
{
  $options = get_option( 'atec_WMS_settings',[]); 
  echo '<input id="'.esc_attr($field).'" type="text" name="atec_WMS_settings['.esc_attr($field).']" value="'.esc_attr($options[$field]).'">';
  if ($br) echo '<br><br>'; 
}
?>
