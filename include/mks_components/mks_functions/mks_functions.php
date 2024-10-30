<?php
global $mks_components;
/**
 *  Load component
 *  @param string component
 *  @param string version. If false will load the latest version available
 *  @param boolean
 *  @return void
 **/
if (!function_exists( "mks_load_component" )){
	function mks_load_component( $component_name, $version = false, $new_instance = false ){
		global $mks_components;
		
		if( isset( $mks_components['registered'][ $component_name ] ) ){
			
			if( !$version ){
				
				foreach( $mks_components['registered'][ $component_name ] as $c_version => $c_path ){
					
					if( !$version || ( $version < $c_version ) ){
						$version = $c_version;
					}
				}
			}
			
			if( isset( $mks_components['registered'][ $component_name ][ $version ] ) ){
				
				if( !isset( $mks_components['loaded'][ $component_name ] ) ){
					$mks_components['loaded'][ $component_name ] = array();
				}
				
				if( !isset( $mks_components['loaded'][ $component_name ][ $version ] ) ){
					$mks_components['loaded'][ $component_name ][ $version ] = array();
					$mks_components['loaded'][ $component_name ][ $version ]['version'] = $version;
					$mks_components['loaded'][ $component_name ][ $version ]['path']    = $mks_components['registered'][ $component_name ][ $version ]['path'];
					$mks_components['loaded'][ $component_name ][ $version ]['url']     = $mks_components['registered'][ $component_name ][ $version ]['url'];
					$mks_components['loaded'][ $component_name ][ $version ]['usage']   = array();
					$mks_components['loaded'][ $component_name ][ $version ]['objects'] = array();
					
				}
				$mks_component_key = 0;
				if( count( $mks_components['loaded'][ $component_name ][ $version ]['objects'] ) ){
					
					if( $new_instance ){
						
						if( !class_exists( 'MKS_Component' ) ){
							include_once( dirname( $mks_components['loaded'][ $component_name ][ $version ]['path'] ).'/mks_functions/mks_component.class.php' );
						}
						
						include_once( $mks_components['loaded'][ $component_name ][ $version ]['path'].$component_name.'.class.php' );
						$mks_component_key = count( $mks_components['loaded'][ $component_name ][ $version ]['objects'] ) + 1;
						$mks_components['loaded'][ $component_name ][ $version ]['objects'][ $mks_component_key ] = new $mks_components['registered'][ $component_name ][ $version ]['class_name'];
					}else{
						$mks_component_key = 1;
					}
				}else{
					
					if( !class_exists( 'MKS_Component' ) ){
						include_once( dirname( $mks_components['loaded'][ $component_name ][ $version ]['path'] ).'/mks_functions/mks_component.class.php' );
					}
					
					include_once( $mks_components['loaded'][ $component_name ][ $version ]['path'].$component_name.'.class.php' );
					$mks_component_key = 1;
					$mks_components['loaded'][ $component_name ][ $version ]['objects'][ $mks_component_key ] = new $mks_components['registered'][ $component_name ][ $version ]['class_name'];
				}
				$mks_components['loaded'][ $component_name ][ $version ]['usage'][] = __FILE__;
				
				$mks_components['loaded'][ $component_name ][ $version ]['objects'][ $mks_component_key ]->add_settings( $mks_components['loaded'][ $component_name ][ $version ] );
				
				return array( 'name' => $component_name, 'version' => $version, 'key' => $mks_component_key );
			}
		}
		else{
			wp_die( 'MKS Component '.$component_name.' is not registered.' );
		}
	}
}

/**
 *  Register component
 *  @param string component
 *  @param string component_path
 *  @return void
 **/
if (!function_exists( "mks_register_component" )){
	function mks_register_component( $component_name, $component_path, $component_url ){
		global $mks_components;
		
		if( !is_array(  $mks_components ) ){
			$mks_components = array();
		}
		
		if( !isset(  $mks_components['registered'] ) ){
			$mks_components['registered'] = array();
		}
		
		if( !isset(  $mks_components['loaded'] ) ){
			$mks_components['loaded'] = array();
		}
		
		//check if requested component exists
		@include( $component_path.$component_name.'.info.php' );
		
		if( isset( $mks_component['version'] ) ){
			
			if( !isset( $mks_components['registered'][ $component_name ] ) ){
				$mks_components['registered'][ $component_name ] = array();
			}
			if( !isset( $mks_components['registered'][ $component_name ][ $mks_component['version'] ] ) ){
				$mks_components['registered'][ $component_name ][ $mks_component['version'] ] = array();
				$mks_components['registered'][ $component_name ][ $mks_component['version'] ]['path'] = $component_path;
				$mks_components['registered'][ $component_name ][ $mks_component['version'] ]['url']  = $component_url;
				$mks_components['registered'][ $component_name ][ $mks_component['version'] ]['class_name'] = $mks_component['class_name'];
			}
		}else{
			wp_die( 'Component '.$component_name.' does not exists.' );
		}
	}
}
/**
 *  Return object of loaded component
 *  @param array component
 *  @return object
 **/
if (!function_exists( "mks_get_component" )){
	function mks_get_component( $component ){
		global $mks_components;
		
		if( isset( $component['name'] ) && isset( $component['version'] ) && isset( $component['key'] )  ){
			
			if( isset( $mks_components['loaded'][ $component['name'] ] ) && isset( $mks_components['loaded'][ $component['name'] ][ $component['version'] ] ) && isset( $mks_components['loaded'][ $component['name'] ][ $component['version'] ]['objects'] ) && isset( $mks_components['loaded'][ $component['name'] ][ $component['version'] ]['objects'][ $component['key'] ] ) ){
				return $mks_components['loaded'][ $component['name'] ][ $component['version'] ]['objects'][ $component['key'] ];
			}
		}
		wp_die( 'MKS Component '.$component['name'].' is not loaded.' );
	}
}
/**
 * Order otw meta goxes
 *
 */
if (!function_exists( "mks_order_meta_boxes" )){
	function mks_order_meta_boxes(){
		global $wp_meta_boxes;
		
		if( is_array( $wp_meta_boxes ) && count( $wp_meta_boxes ) ){
			
			foreach( $wp_meta_boxes as $item_type => $sections ){
			
				if( isset( $sections['normal'] ) && isset( $sections['normal']['high'] ) && is_array( $sections['normal']['high'] ) && count( $sections['normal']['high'] ) ){
					
					$high_boxes = $sections['normal']['high'];
					$box_orders = array();
					
					$order_key = 2;
					foreach( $high_boxes as $box_id => $box_data ){
						
						if( $box_id == 'mks_content_sidebars_settings' ){
							$box_orders[ $box_id ] = 1;
						}elseif( $box_id == 'mks_grid_manager_content' ){
							$box_orders[ $box_id ] = 0;
						}else{
							$box_orders[ $box_id ][ $box_id ] = $order_key;
							$order_key++;
						}
					}
					
					if( count( $box_orders ) ){
						$wp_meta_boxes[ $item_type ]['normal']['high'] = array();
						asort( $box_orders );
						
						foreach( $box_orders as $box_id => $box_order ){
							
							$wp_meta_boxes[ $item_type ]['normal']['high'][ $box_id ] = $high_boxes[ $box_id ];
							
						}
					}
				}
			}
		}
	}
}


/**
 * Wrap the item content with row
 * @param string
 */
if (!function_exists( "mks_pre_content_wrapper" )){
	function mks_pre_content_wrapper( $the_content ){
		return $the_content;
	}
}

/**
 * Wrap the full content with row
 * @param string
 */
if (!function_exists( "mks_post_content_wrapper" )){
	function mks_post_content_wrapper( $the_content ){
	
		if( mks_is_content_sidebars_content() ){
			$the_content = '<div class="otw-row"><div class="otw-row"><div class="otw-twentyfour otw-columns">'.$the_content.'</div></div></div>';
		}
		return $the_content;
	}
}

/**
 *  Check if content is changed by the grid manager component
 *  return @boolean
 */
if (!function_exists( "mks_is_grid_manager_content" )){
	function mks_is_grid_manager_content(){
		
		global $mks_components;
		
		if( isset( $mks_components['loaded'] ) && isset( $mks_components['loaded']['mks_grid_manager'] ) ){
		
			foreach( $mks_components['loaded']['mks_grid_manager'] as $mks_component ){
			
				if( isset( $mks_component['objects'] ) ){
					
					foreach( $mks_component['objects'] as $mks_co_object ){
						
						if( $mks_co_object->is_valid_for_object() ){
							return true;
						}
					}
				}
			}
		}
		return false;
	}
}

/**
 *  Check if content is changed by the content sidebars component
 *  return @boolean
 */
if (!function_exists( "mks_is_content_sidebars_content" )){
	function mks_is_content_sidebars_content(){
		
		global $mks_components;
		
		if( isset( $mks_components['loaded'] ) && isset( $mks_components['loaded']['mks_content_sidebars'] ) ){
		
			foreach( $mks_components['loaded']['mks_content_sidebars'] as $mks_component ){
			
				if( isset( $mks_component['objects'] ) ){
				
					foreach( $mks_component['objects'] as $mks_co_object ){
						
						if( $mks_co_object->is_valid_for_object() ){
							return true;
						}
					}
				}
			}
		
		}
		return false;
	}
}
/**
 *  strip slashes
 *  return @string
 */
if (!function_exists( "mks_stripslashes" )){
	function mks_stripslashes( $string_array ){
	
		if( get_magic_quotes_gpc() ){
			if( is_array( $string_array ) ){
				$string_array = array_map('stripslashes_deep', $string_array );
			}else{
				$string_array = stripslashes( $string_array );
			}
		}else{
			if( is_array( $string_array ) ){
				$string_array = array_map('stripslashes_deep', $string_array );
			}else{
				$string_array = stripslashes( $string_array );
			}
		}
		return $string_array;
	}
}

/**
 *  Html entities
 *  return @string
 */
if (!function_exists( "mks_htmlentities" )){
	function mks_htmlentities( $string ){
		
		return htmlentities( $string, ENT_COMPAT, 'UTF-8' );
	}
}

/**
 *  Html entities decocode
 *  return @string
 */
if (!function_exists( "mks_htmlentities_decode" )){
	function mks_htmlentities_decode( $string ){
		
		return html_entity_decode( $string, ENT_COMPAT, 'UTF-8' );
	}
}

/**
 *  Compare the current version with given one
 *  return integer
 */
if (!function_exists( "mks_comprare_blog_version" )){
	function mks_comprare_blog_version( $version ){
	
		$blog_version = get_bloginfo('version');
		
		$blog_version_parts = explode( '.', $blog_version );
		$version_parts = explode( '.', $version );
		
		foreach( $blog_version_parts as $part_key => $part_value )
		{
			if( $part_value > $version_parts[ $part_key ] )
			{
				return -1;
			}
			elseif( $part_value < $version_parts[ $part_key ] )
			{
				return 1;
			}
		}
		return 0;
	}
}

?>