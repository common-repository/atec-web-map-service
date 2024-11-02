<?php
if (!defined( 'ABSPATH' )) { exit; }

if (!defined('ATEC_INIT_INC')) require_once('atec-init.php');
add_action('admin_menu', function() 
{
	$options=get_option('atec_WMS_settings',[]);
	$active=(($options['lat']??'')!=='' && ($options['lng']??'')!=='');
	$pn='WebMapService';
	atec_wp_menu(__DIR__,'atec_wms',$active?$pn:'<span style="font-size: 9.5px;" title="Not configured">'.$pn.'</span>❗');
});

$atec_query_args=add_query_arg(null,null);
if (str_contains($atec_query_args, 'atec_wms') || str_contains($atec_query_args, 'options.php')) require_once('atec-wms-register-settings.php');

add_action( 'init', function()
{
	if (in_array($slug=atec_get_slug(), ['atec_group','atec_wms']))
	{
		if (!defined('ATEC_TOOLS_INC')) require_once('atec-tools.php');	
		add_action( 'admin_enqueue_scripts', function() { atec_reg_style('atec',__DIR__,'atec-style.min.css','1.0.002'); });
		
		if (!function_exists('atec_load_pll')) { require_once('atec-translation.php'); }
		atec_load_pll(__DIR__,'web-map-service');

		if ($slug!=='atec_group')
		{	  
			function atec_wms(): void { require_once('atec-wms-settings.php'); }
			add_action( 'admin_enqueue_scripts', function()
			{
				atec_reg_style('atec_check',__DIR__,'atec-check.min.css','1.0.001');
				atec_reg_script('atec_check',__DIR__,'atec-check.min.js','1.0.001');	  
			});			
		}
	}	
});
?>
