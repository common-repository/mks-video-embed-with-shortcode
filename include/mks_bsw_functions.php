<?php
/**
 * Init function
 */
if( !function_exists( 'mks_bsw_widgets_init' ) ){
	
	function mks_bsw_widgets_init(){
		
		global $mks_components;
		
		if( isset( $mks_components['registered'] ) && isset( $mks_components['registered']['mks_shortcode'] ) ){
			
			$shortcode_components = $mks_components['registered']['mks_shortcode'];
			arsort( $shortcode_components );
			
			foreach( $shortcode_components as $shortcode ){
				if( is_file( $shortcode['path'].'/widgets/mks_shortcode_widget.class.php' ) ){
					
					include_once( $shortcode['path'].'/widgets/mks_shortcode_widget.class.php' );
					break;
				}
			}
		}
		register_widget( 'MKS_Shortcode_Widget' );
	}
}
/**
 * Init function
 */
if( !function_exists( 'mks_bsw_init' ) ){
	
	function mks_bsw_init(){
		
		global $mks_bsw_plugin_url, $mks_bsw_plugin_options, $mks_bsw_shortcode_component, $mks_bsw_shortcode_object, $mks_bsw_form_component, $mks_bsw_validator_component, $mks_bsw_form_object, $mks_bsw_skin, $wp_bsw_cs_items, $mks_bsw_factory_component, $mks_bsw_factory_object, $mks_bsw_plugin_id;
		
		if( is_admin() ){
			
			include_once( 'mks_bsw_process_actions.php' );
			
			add_action('admin_menu', 'mks_bsw_init_admin_menu' );
			
			add_action('admin_print_styles', 'mks_bsw_enqueue_admin_styles' );
			
			add_action('admin_enqueue_scripts', 'mks_bsw_enqueue_admin_scripts');
			
			add_filter('otwfcr_notice', 'mks_bsw_factory_message' );
		}
		mks_bsw_enqueue_styles();
		
		include_once( plugin_dir_path( __FILE__ ).'mks_bsw_dialog_info.php' );
		
		//shortcode component
		$mks_bsw_shortcode_component = mks_load_component( 'mks_shortcode' );
		$mks_bsw_shortcode_object = mks_get_component( $mks_bsw_shortcode_component );
		$mks_bsw_shortcode_object->editor_button_active_for['page'] = true;
		$mks_bsw_shortcode_object->editor_button_active_for['post'] = true;
		$mks_bsw_shortcode_object->editor_button_active_for['cpt'] = true;
		
		$mks_bsw_shortcode_object->add_default_external_lib( 'css', 'style', get_stylesheet_directory_uri().'/style.css', 'live_preview', 10 );
		
		$mks_bsw_shortcode_object->shortcodes['button'] = array( 'title' => __('Video Iframe', 'mks_bsw'),'enabled' => true,'children' => false, 'parent' => false, 'order' => 0,'path' => dirname( __FILE__ ).'/mks_components/mks_shortcode/', 'url' => $mks_bsw_plugin_url.'include/mks_components/mks_shortcode/', 'dialog_text' => $mks_bsw_dialog_text );
		
		include_once( plugin_dir_path( __FILE__ ).'mks_labels/mks_bsw_shortcode_object.labels.php' );
		$mks_bsw_shortcode_object->init();
		
		//form component
		$mks_bsw_form_component = mks_load_component( 'mks_form' );
		$mks_bsw_form_object = mks_get_component( $mks_bsw_form_component );
		include_once( plugin_dir_path( __FILE__ ).'mks_labels/mks_bsw_form_object.labels.php' );
		$mks_bsw_form_object->init();
		
		//validator component
		$mks_bsw_validator_component = mks_load_component( 'mks_validator' );
		$mks_bsw_validator_object = mks_get_component( $mks_bsw_validator_component );
		$mks_bsw_validator_object->init();
		
		$mks_bsw_factory_component = mks_load_component( 'mks_factory' );
		$mks_bsw_factory_object = mks_get_component( $mks_bsw_factory_component );
		$mks_bsw_factory_object->add_plugin( $mks_bsw_plugin_id, dirname( dirname( __FILE__ ) ).'/mks_content_manager.php', array( 'menu_parent' => 'otw-bsw-settings', 'lc_name' => __( 'License Manager', 'mks_bsw' ), 'menu_key' => 'otw-bsw' ) );
		
		include_once( plugin_dir_path( __FILE__ ).'mks_labels/mks_bsw_factory_object.labels.php' );
		$mks_bsw_factory_object->init();

	}
}

/**
 * include needed styles
 */
if( !function_exists( 'mks_bsw_enqueue_styles' ) ){
	function mks_bsw_enqueue_styles(){
		global $mks_bsw_plugin_url, $mks_bsw_css_version;
	}
}


/**
 * Admin styles
 */
if( !function_exists( 'mks_bsw_enqueue_admin_styles' ) ){
	
	function mks_bsw_enqueue_admin_styles(){
		
		global $mks_bsw_plugin_url, $mks_bsw_css_version;
		
		$currentScreen = get_current_screen();
		
		switch( $currentScreen->id ){
			
			case 'widgets':
			case 'page':
			case 'post':
					wp_enqueue_style( 'mks_bsw_admin', $mks_bsw_plugin_url.'/css/mks_bsw_admin.css', array( 'thickbox' ), $mks_bsw_css_version );
				break;
		}
	}
}


/**
 * Admin scripts
 */
if( !function_exists( 'mks_bsw_enqueue_admin_scripts' ) ){
	
	function mks_bsw_enqueue_admin_scripts( $requested_page ){
		
		global $mks_bsw_plugin_url, $mks_bsw_js_version;
		
		switch( $requested_page ){
			
			case 'widgets.php':
					wp_enqueue_script("mks_shotcode_widget_admin", $mks_bsw_plugin_url.'include/mks_components/mks_shortcode/js/mks_shortcode_widget_admin.js'  , array( 'jquery', 'thickbox' ), $mks_bsw_js_version );
					
					if(function_exists( 'wp_enqueue_media' )){
						wp_enqueue_media();
					}else{
						wp_enqueue_style('thickbox');
						wp_enqueue_script('media-upload');
						wp_enqueue_script('thickbox');
					}
				break;
		}
	}
	
}

/**
 * Init admin menu
 */
if( !function_exists( 'mks_bsw_init_admin_menu' ) ){
	
	function mks_bsw_init_admin_menu(){
		
		global $mks_bsw_plugin_url;
		
		//add_menu_page(__('Video Shortcode and Widget', 'mks_bsw'), __('Video Shortcode and Widget', 'mks_bsw'), 'manage_options', 'otw-bsw-settings', 'mks_bsw_settings', $mks_bsw_plugin_url.'images/otw-sbm-icon.png');
		//add_submenu_page( 'otw-bsw-settings', __('Settings', 'mks_bsw'), __('Settings', 'mks_bsw'), 'manage_options', 'otw-bsw-settings', 'mks_bsw_settings' );
	}
}

/**
 * Settings page
 */
if( !function_exists( 'mks_bsw_settings' ) ){
	
	function mks_bsw_settings(){
		require_once( 'mks_bsw_settings.php' );
	}
}
/**
 * factory messages
 */
if( !function_exists( 'mks_bsw_factory_message' ) ){
	
	function mks_bsw_factory_message( $params ){
		
		global $mks_bsw_plugin_id;
		
		if( isset( $params['plugin'] ) && $mks_bsw_plugin_id == $params['plugin'] ){
			
			//filter out some messages if need it
		}
		if( isset( $params['message'] ) )
		{
			return $params['message'];
		}
		return $params;
	}
}
?>