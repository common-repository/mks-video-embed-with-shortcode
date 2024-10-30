<?php
class MKS_Factory extends MKS_Component{
	
	protected $plugins;
	
	public $errors = array();
	
	private $api_url = '';
	
	private $upd_tm = 1440;
	
	private $remote_request_timeout = 120;
	
	private $dmode = 1;
	
	public $responses = array();
	
	public function __construct(){
		
	/*	if( isset( $_SERVER['DOCUMENT_ROOT'] ) && preg_match( "/webserver\/mks_wp\/home\/web\/(4\.8\.1|4\.9\.8)/", $_SERVER['DOCUMENT_ROOT'] ) ){
			$this->upd_tm = 0;
			$this->api_url = 'http://mks_wp_api.com/v1/';
		}*/
	}
	
	public function init(){}
	
	public function add_plugin( $plugin_id, $plugin_path, $settings = array() ){}
	
	public function is_plugin_active( $plugin_id )
	{}
	
	public function enqueue_admin_styles(){
		
		wp_enqueue_style( 'mks_factory_font_admin_css', $this->component_url.'css/font-awesome.css', array( ), $this->css_version );
		wp_enqueue_style( 'mks_factory_admin_css', $this->component_url.'css/mks_factory.css', array( ), $this->css_version );
	}
	
	public function add_plugin_row( $plugin_path, $plugin_data ){}
	
	public function add_plugin_links( $links, $plugin_path ){}
	
	private function _process_admin_actions(){}
	
	private function _get_lm_plugin(){}
	
	private function process_action( $action, $plugin, $data = array() ){}
	
	public function retrive_plungins_data( $force = false ){}
	
	public function pv_method( $plugin_id, $id ){}
	
	public function admin_notices( $params ){}
	
	private function replace_variables( $string, $vars, $plugin ){}
	
	public function register_pages(){}
	
	public function page_otwfcr(){}
	
	public function page_otwlm( $params ){/*
		
		$current_plugin = $this->_get_lm_plugin();
		
		$license_messages = array();
		
		if( $current_plugin ){
			//download latest state of the plugins
			$this->retrive_plungins_data( true );
			
			if( isset( $this->plugins[ $current_plugin ]['info'] ) && isset( $this->plugins[ $current_plugin ]['info']['license_messages'] ) ){
				
				foreach( $this->plugins[ $current_plugin ]['info']['license_messages'] as $message_data ){
					
					$license_messages[] = array( 'title' => $this->replace_variables( $message_data['title'], $message_data['vars'], $this->plugins[ $current_plugin ]['id']  ), 'text' => $this->replace_variables( $message_data['text'], $message_data['vars'], $this->plugins[ $current_plugin ]['id']  ) );
				}
			}
		}
		
		include_once( 'views/license_manager.php' );
	*/}
	
	public function change_plugin_transient( $transient ){/*
		
		if ( empty( $transient ) ) $transient = new stdClass();
		
		foreach( $this->plugins as $this_plugin ){
			
			if( isset( $this_plugin['info'] ) && isset( $this_plugin['info']['state'] ) && ( $this_plugin['info']['state'] ) ){
				global $pagenow;
				
				if( in_array( $this_plugin['info']['state'], array( 'downgrade_to_lite', 'upgrade_to_pro' ) ) )
				{
					if( $pagenow == 'update.php' )
					{
						$transient->response[ $this_plugin['path'] ] = new stdClass();
						$transient->response[ $this_plugin['path'] ]->slug = $this->_plugin_slug( $this_plugin['path'] );
						$transient->response[ $this_plugin['path'] ]->new_version = $this_plugin['info']['new_version']['version'];
						//$transient->response[ $this_plugin['path'] ]->new_version = $pagenow.' '.$this_plugin['info']['state'];
						$transient->response[ $this_plugin['path'] ]->package = $this->api_url.'download/?k='.$this_plugin['id'].'&s='.urlencode($this_plugin['domain'] ).'&a='.urlencode( $this_plugin['info']['state'] );
					}
				}
				else
				{
					$transient->response[ $this_plugin['path'] ] = new stdClass();
					$transient->response[ $this_plugin['path'] ]->slug = $this->_plugin_slug( $this_plugin['path'] );
					$transient->response[ $this_plugin['path'] ]->new_version = $this_plugin['info']['new_version']['version'];
					$transient->response[ $this_plugin['path'] ]->package = $this->api_url.'download/?k='.$this_plugin['id'].'&s='.urlencode($this_plugin['domain'] ).'&a='.urlencode( $this_plugin['info']['state'] );
				}
			}
		}
		
		return $transient;
	*/}
	
	private function _get_domains(){/*
	
		$domains = array();
		$domains[] = $this->_get_domain();
	
		if( is_multisite() ){
			
			$sites = wp_get_sites();
			
			if( is_array( $sites ) && count( $sites ) ){
				
				foreach( $sites as $site ){
					
					$site_url = $site['domain'].$site['path'];
					
					$site_url = preg_replace( "/(\/)$/", "", $site_url );
					
					if( strlen( trim( $site_url ) ) && !in_array( $site_url, $domains ) ){
						$domains[] = $site_url;
					}
				}
			}
		}
		return $domains;
	*/}
	
	private function _get_domain(){/*
	
		$domain = get_site_url();
		
		if( strlen( trim( $domain ) ) ){
		
			$parsed_url = parse_url( $domain );
			
			if( isset( $parsed_url['host'] ) && strlen( trim( $parsed_url['host'] ) ) ){
			
				$domain = $parsed_url['host'];
				
				if( isset( $parsed_url['path'] ) && strlen( trim( $parsed_url['path'] ) ) ){
				
					$domain = $domain.$parsed_url['path'];
				}
			}
		}
		
		if( !strlen( trim( $domain ) ) ){
			
			if( isset( $_SERVER['HTTP_HOST'] ) ){
				$domain = $_SERVER['HTTP_HOST'];
			}
		}
		
		return $domain;
	*/}
	
	public function get_updates_info($default, $action, $plugin ){/*
		
		//if( !empty( $plugin ) && isset( $plugin->slug ) && isset( $this->plugins[ $plugin->slug ] ) && isset( $this->plugins[ $plugin->slug ]['info']['state'] ) && $this->plugins[ $plugin->slug ]['info']['state'] && ( $this->plugins[ $plugin->slug ]['info']['state'] == 'version_change' ) ){
		
		if( !empty( $plugin ) && isset( $plugin->slug ) ){
			
			foreach( $this->plugins as $this_plugin ){
				
				if( $this->_plugin_slug( $this_plugin['path'] ) == $plugin->slug && isset( $this_plugin['info'] ) ){
				
					$obj = new stdClass();
					$obj->slug = $plugin->slug;
					$obj->name = $this_plugin['info']['name'];
					$obj->plugin_name = $plugin->slug;
					$obj->sections = array();
					$obj->download_link = $this->api_url.'download/?k='.$this_plugin['id'].'&s='.urlencode( $this_plugin['domain'] ).'&a='.urlencode( $this_plugin['info']['state'] );
					
					if( isset( $this_plugin['info']['new_version'] ) && isset( $this_plugin['info']['new_version']['details'] ) ){
						
						foreach( $this_plugin['info']['new_version']['details'] as $detail_key => $detail_data ){
							$obj->{ $detail_key } = $detail_data;
						}
					}
					
					if( $this_plugin['info']['state'] == 'downgrade_to_lite' ){
						$obj->version = $this_plugin['version'].'.'.$obj->version;
						$obj->slug = $plugin->slug;
					}else{
						$obj->slug = $plugin->slug;
					}
					return $obj;
					
				}
			}
		}
		return $default;
	}
	
	public function _plugin_slug( $slug )
	{
		return basename( dirname( $slug ) );
	}
	
	public function _is_plugin_page( $plugin, $screen )
	{
		if( isset( $plugin['settings'] ) && isset( $plugin['settings']['menu_parent'] ) && $screen && isset( $screen->parent_file ) && ( $screen->parent_file == $plugin['settings']['menu_parent'] ) )
		{
			return true;
		}
		return false;
	}
*/}

}



?>