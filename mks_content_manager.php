<?php
/**
Plugin Name: MKS Video Embed With Shortcode
Plugin URI: http://acnosoft.com
Description:  Add video embeded code with Nice and easy interface. Insert anywhere in your site - page/post editor, sidebars, template files. 
Author: Mksharma
Version: 1.00

Author URI: http://acnosoft.com/
*/

load_plugin_textdomain('mks_bsw',false,dirname(plugin_basename(__FILE__)) . '/languages/');

$wp_bsw_tmc_items = array(
	'page'              => array( array(), __( 'Pages', 'mks_bsw' ) ),
	'post'              => array( array(), __( 'Posts', 'mks_bsw' ) )
);

$wp_bsw_agm_items = array(
	'page'              => array( array(), __( 'Pages', 'mks_bsw' ) ),
	'post'              => array( array(), __( 'Posts', 'mks_bsw' ) )
);

$wp_bsw_cs_items = array(
	'page'              => array( array(), __( 'Pages', 'mks_bsw' ) ),
	'post'              => array( array(), __( 'Posts', 'mks_bsw' ) )
);

$mks_bsw_plugin_id = '';
$mks_bsw_plugin_url = plugin_dir_url( __FILE__);
$mks_bsw_css_version = '1.0';

//include functons
require_once( plugin_dir_path( __FILE__ ).'/include/mks_bsw_functions.php' );

//otw components
$mks_bsw_shortcode_component = false;
$mks_bsw_form_component = false;
$mks_bsw_validator_component = false;
$mks_bsw_factory_component = false;
$mks_bsw_factory_object = false;

//load core component functions
@include_once( 'include/mks_components/mks_functions/mks_functions.php' );

if( !function_exists( 'mks_register_component' ) ){
	wp_die( 'Please include otw components' );
}

//register form component
mks_register_component( 'mks_form', dirname( __FILE__ ).'/include/mks_components/mks_form/', $mks_bsw_plugin_url.'include/mks_components/mks_form/' );

//register factory component
mks_register_component( 'mks_factory', dirname( __FILE__ ).'/include/mks_components/mks_factory/', $mks_bsw_plugin_url.'/include/mks_components/mks_factory/' );

//register validator component
mks_register_component( 'mks_validator', dirname( __FILE__ ).'/include/mks_components/mks_validator/', $mks_bsw_plugin_url.'include/mks_components/mks_validator/' );

//register shortcode component
mks_register_component( 'mks_shortcode', dirname( __FILE__ ).'/include/mks_components/mks_shortcode/', $mks_bsw_plugin_url.'include/mks_components/mks_shortcode/' );

/** 
 *call init plugin function
 */
add_action('init', 'mks_bsw_init' );
//add_action('widgets_init', 'mks_bsw_widgets_init' );

?>