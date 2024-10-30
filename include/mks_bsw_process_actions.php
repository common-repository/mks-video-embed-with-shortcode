<?php
/**
 * Process otw cm actions
 *
 */
if( isset( $_POST['mks_bsw_action'] ) ){
	
	require_once( ABSPATH . WPINC . '/pluggable.php' );
	
	switch( $_POST['mks_bsw_action'] ){
		
		case 'mks_bsw_settings_action':
				
				global $wp_cm_tmc_items, $wp_cm_agm_items, $mks_bsw_skins, $wp_cm_cs_items;
				
				$options = array();
				
				if( isset( $_POST['mks_bsw_promotions'] ) && !empty( $_POST['mks_bsw_promotions'] ) ){
					
					global $mks_bsw_factory_object, $mks_bsw_plugin_id;
					
					update_option( $mks_bsw_plugin_id.'_dnms', filter_var($_POST['mks_bsw_promotions'], FILTER_SANITIZE_STRING) );
					
					if( is_object( $mks_bsw_factory_object ) ){
						$mks_bsw_factory_object->retrive_plungins_data( true );
					}
				}
				
				update_option( 'mks_bsw_plugin_options', $options );
				wp_redirect( admin_url( 'admin.php?page=otw-bsw-settings&message=1' ) );
			break;
	}
}
?>