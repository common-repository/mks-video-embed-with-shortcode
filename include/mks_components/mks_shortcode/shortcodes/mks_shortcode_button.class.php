<?php
class MKS_Shortcode_Button extends MKS_Shortcodes{
	
	
	public function __construct(){
		
		$this->has_custom_options = true;
		
		parent::__construct();
	}
	
	/**
	 * apply settings
	 */
	public function apply_settings(){
	
		$this->settings = array(
			'sizes' => array(
				'tiny'   => $this->get_label( 'Tiny' ),
				'small'  => $this->get_label( 'Small' ),
				'medium' => $this->get_label( 'Medium' ),
				'large'  => $this->get_label( 'Large' ),
			),
			'default_size' => 'medium',
			'icon_types' => array(
			
				''                      => $this->get_label( 'none (Default)' ),
				'general foundicon-settings'      => $this->get_label( 'Settings' ),
				'general foundicon-heart'         => $this->get_label( 'Heart' ),
				'general foundicon-star'          => $this->get_label( 'Star' ),
				'general foundicon-plus'          => $this->get_label( 'Plus' ),
				'general foundicon-minus'         => $this->get_label( 'Minus' ),
				'general foundicon-checkmark'     => $this->get_label( 'Checkmark' ),
				'general foundicon-remove'        => $this->get_label( 'Remove' ),
				'general foundicon-mail'          => $this->get_label( 'Mail' ),
				'general foundicon-calendar'      => $this->get_label( 'Calendar' ),
				'general foundicon-page'          => $this->get_label( 'Page' ),
				'general foundicon-tools'         => $this->get_label( 'Tools' ),
				'general foundicon-globe'         => $this->get_label( 'Globe' ),
				'general foundicon-cloud'         => $this->get_label( 'Cloud' ),
				'general foundicon-error'         => $this->get_label( 'Error' ),
				'general foundicon-right-arrow'   => $this->get_label( 'Right arrow' ),
				'general foundicon-left-arrow'    => $this->get_label( 'Left arrow' ),
				'general foundicon-up-arrow'      => $this->get_label( 'Up arrow' ),
				'general foundicon-down-arrow'    => $this->get_label( 'Down arrow' ),
				'general foundicon-trash'         => $this->get_label( 'Trash' ),
				'general foundicon-add-doc'       => $this->get_label( 'Add Doc' ),
				'general foundicon-edit'          => $this->get_label( 'Edit' ),
				'general foundicon-lock'          => $this->get_label( 'Lock' ),
				'general foundicon-unlock'        => $this->get_label( 'Unlock' ),
				'general foundicon-refresh'       => $this->get_label( 'Refresh' ),
				'general foundicon-paper-clip'    => $this->get_label( 'Paper clip' ),
				'general foundicon-video'         => $this->get_label( 'Video' ),
				'general foundicon-photo'         => $this->get_label( 'Photo' ),
				'general foundicon-graph'         => $this->get_label( 'Graph' ),
				'general foundicon-idea'          => $this->get_label( 'Idea' ),
				'general foundicon-mic'           => $this->get_label( 'Mic' ),
				'general foundicon-cart'          => $this->get_label( 'Cart' ),
				'general foundicon-address-book'  => $this->get_label( 'Address book' ),
				'general foundicon-compass'       => $this->get_label( 'Compass' ),
				'general foundicon-flag'          => $this->get_label( 'Flag' ),
				'general foundicon-location'      => $this->get_label( 'Location' ),
				'general foundicon-clock'         => $this->get_label( 'Clock' ),
				'general foundicon-folder'        => $this->get_label( 'Folder' ),
				'general foundicon-inbox'         => $this->get_label( 'Inbox' ),
				'general foundicon-website'       => $this->get_label( 'Website' ),
				'general foundicon-smiley'        => $this->get_label( 'Smiley' ),
				'general foundicon-search'        => $this->get_label( 'Search' ),
				'general foundicon-phone'         => $this->get_label( 'Phone' ),
				
				'social foundicon-thumb-up'       => $this->get_label( 'Thumb up' ),
				'social foundicon-thumb-down'     => $this->get_label( 'Thumb down' ),
				'social foundicon-rss'            => $this->get_label( 'Rss' ),
				'social foundicon-facebook'       => $this->get_label( 'Facebook' ),
				'social foundicon-twitter'        => $this->get_label( 'Twitter' ),
				'social foundicon-pinterest'      => $this->get_label( 'Pinterest' ),
				'social foundicon-github'         => $this->get_label( 'Github' ),
				'social foundicon-path'           => $this->get_label( 'Path' ),
				'social foundicon-linkedin'       => $this->get_label( 'LinkedIn' ),
				'social foundicon-dribbble'       => $this->get_label( 'Dribbble' ),
				'social foundicon-stumble-upon'   => $this->get_label( 'Stumble upon' ),
				'social foundicon-behance'        => $this->get_label( 'Behance' ),
				'social foundicon-reddit'         => $this->get_label( 'Reddit' ),
				'social foundicon-google-plus'    => $this->get_label( 'Google plus' ),
				'social foundicon-youtube'        => $this->get_label( 'Youtube' ),
				'social foundicon-vimeo'          => $this->get_label( 'Vimeo' ),
				'social foundicon-clickr'         => $this->get_label( 'Clickr' ),
				'social foundicon-slideshare'     => $this->get_label( 'Slideshare' ),
				'social foundicon-picassa'        => $this->get_label( 'Picassa' ),
				'social foundicon-skype'          => $this->get_label( 'Skype' ),
				'social foundicon-instagram'      => $this->get_label( 'instagram' ),
				'social foundicon-foursquare'     => $this->get_label( 'Foursquare' ),
				'social foundicon-delicious'      => $this->get_label( 'Delicious' ),
				'social foundicon-chat'           => $this->get_label( 'Chat' ),
				'social foundicon-torso'          => $this->get_label( 'Torso' ),
				'social foundicon-tumblr'         => $this->get_label( 'Tumblr' ),
				'social foundicon-video-chat'     => $this->get_label( 'Video chat' ),
				'social foundicon-digg'           => $this->get_label( 'Digg' ),
				'social foundicon-wordpress'      => $this->get_label( 'Wordpress' )
			),
			'default_icon_type' => '',
			'color_classes' => array(
			
				''                      => $this->get_label( 'none (Default)' ),
				'otw-red'                   => $this->get_label( 'Red' ),
				'otw-orange'                => $this->get_label( 'Orange' ),
				'otw-green'                 => $this->get_label( 'Green' ),
				'otw-greenish'              => $this->get_label( 'Greenish' ),
				'otw-aqua'                  => $this->get_label( 'Aqua' ),
				'otw-blue'                  => $this->get_label( 'Blue' ),
				'otw-pink'                  => $this->get_label( 'Pink' ),
				'otw-silver'                => $this->get_label( 'Silver' ),
				'otw-brown'                 => $this->get_label( 'Brown' ),
				'otw-black'                 => $this->get_label( 'Black' )
			),
			'default_color_class' => '',
			'icon_positions' => array(
				'left' => $this->get_label( 'Left (default)'),
				'right' => $this->get_label( 'Right')
			),
			'default_icon_position' => 'left',
			'shapes' => array(
				'square'      =>     $this->get_label( 'Square (default)' ),
				'radius'      =>     $this->get_label( 'Radius' ),
				'round'       =>     $this->get_label( 'Round' )
			),
			'default_shape' => 'square'
			
		);
		
	}
	
	public function register_external_libs(){
	
		$this->add_external_lib( 'css', 'otw-shortcode-general_foundicons', $this->component_url.'css/general_foundicons.css', 'all', 10 );
		$this->add_external_lib( 'css', 'otw-shortcode-social_foundicons', $this->component_url.'css/social_foundicons.css', 'all', 20 );
		$this->add_external_lib( 'css', 'otw-shortcode', $this->component_url.'css/mks_shortcode.css', 'all', 100 );
	
	}
	
	/**
	 * Shortcode button admin interface
	 */
	public function build_shortcode_editor_options(){
		
		$html = '';
		
		$source = array();
		if( isset( $_POST['shortcode_object'] ) ){
			$source = filter_var($_POST['shortcode_object'], FILTER_SANITIZE_STRING);;
		}
		
		$html .= MKS_Form::select( array( 'id' => 'otw-shortcode-element-video_type', 'label' => $this->get_label( 'Video site' ), 'description' => $this->get_label( 'Select Video Type/Sites' ), 'parse' => $source, 'options' => array('yt'=>'YouTube','vm'=>'Vimeo','dm'=>'Dailymotion'), 'value' => $this->settings['video_type'] )  );
		
		$html .= MKS_Form::text_input( array( 'id' => 'otw-shortcode-element-video_id', 'label' => $this->get_label( 'Video ID' ), 'description' => $this->get_label( 'The video id .' ), 'parse' => $source )  );
		
		$html .= MKS_Form::text_input( array( 'id' => 'otw-shortcode-element-width', 'label' => $this->get_label( 'Ifram width' ), 'description' => $this->get_label( 'Width of Video Ifram ( e.g 200 ) ' ), 'parse' => $source )  );
		
		$html .= MKS_Form::text_input( array( 'id' => 'otw-shortcode-element-height', 'label' => $this->get_label( 'Ifram Height' ), 'description' => $this->get_label( 'Height of Video Ifram ( e.g 200 ) ' ), 'parse' => $source )  );
		
		$html .= MKS_Form::select( array( 'id' => 'otw-shortcode-element-autoplay', 'label' => $this->get_label( 'Autoplay' ), 'description' => $this->get_label( '1 for true and 0 for false' ), 'parse' => $source, 'options' => array(1=>'True',0=>'Fasle'), 'value' => $this->settings['video_autoplay'] )  );
		
		$html .= MKS_Form::select( array( 'id' => 'otw-shortcode-element-muted', 'label' => $this->get_label( 'Mute' ), 'description' => $this->get_label( '1 for true and 0 for false' ), 'parse' => $source, 'options' => array(1=>'True',0=>'Fasle'), 'value' => $this->settings['video_muted'] )  );
		
		$html .= MKS_Form::select( array( 'id' => 'otw-shortcode-element-no_cta', 'label' => $this->get_label( 'No CTA' ), 'description' => $this->get_label( '1 for true and 0 for false' ), 'parse' => $source, 'options' => array(1=>'True',0=>'Fasle'), 'value' => $this->settings['video_no_cta'] )  );
		
		
		$html .= MKS_Form::select( array( 'id' => 'otw-shortcode-element-framborder', 'label' => $this->get_label( 'Frameborder' ), 'description' => $this->get_label( 'Select Option 1 for true and 0 for false' ), 'parse' => $source, 'options' => array(0=>'0',1=>'1'), 'value' => $this->settings['video_framborder'] )  );
		
		$html .= MKS_Form::text_input( array( 'id' => 'otw-shortcode-element-style', 'label' => $this->get_label( 'Custome Style' ), 'description' => $this->get_label( 'Custome Style for Video Iframe e.g background:#ccc; color:white; - Note (don`t use style="" )' ), 'parse' => $source )  );
		
		return $html;
	}
	
	/**
	 * Shortcode button admin interface custom options
	 */
	public function build_shortcode_editor_custom_options(){
		
		$html = '';
		
		
		return $html;
	}
	
	/** build button shortcode
	 *
	 *  @param array
	 *  @return string
	 */
	public function build_shortcode_code( $attributes ){
		
		$code = '';
		
		if( !isset( $attributes['video_id'] ) || !strlen( trim( $attributes['video_id'] ) ) ){
			$this->add_error( $this->get_label( 'Video ID is required field' ) );
		}
		
		if( !$this->has_error ){
		
			$code = '[mks_video_shortcode_ifram ';
		    $code .= $this->format_attribute( 'video_type', 'video_type', $attributes );
			$code .= $this->format_attribute( 'video_id', 'video_id', $attributes );
			$code .= $this->format_attribute( 'width', 'width', $attributes );
			$code .= $this->format_attribute( 'height', 'height', $attributes );
			$code .= $this->format_attribute( 'autoplay', 'autoplay', $attributes );
			$code .= $this->format_attribute( 'muted', 'muted', $attributes );
			$code .= $this->format_attribute( 'no_cta', 'no_cta', $attributes );
			$code .= $this->format_attribute( 'framborder', 'framborder', $attributes );
			$code .= $this->format_attribute( 'style', 'style', $attributes );			
			$code .= ']';
			
		}
		
		return $code;
	}
	
	
	/**
	 * Process shortcode Button
	 */
	public function display_shortcode( $attributes, $content ){
		
		$html = '<iframe ';
		
		$video_type = $this->format_attribute( '', 'video_type', $attributes );
		$video_id = $this->format_attribute( '', 'video_id', $attributes );
		$autoplay = $this->format_attribute( '', 'autoplay', $attributes );
		$width = $this->format_attribute( 'width', 'width', $attributes );
		$height = $this->format_attribute( 'height', 'height', $attributes );
		$autoplay = $this->format_attribute( '', 'autoplay', $attributes );
		$muted = $this->format_attribute( '', 'muted', $attributes );
		$no_cta = $this->format_attribute( '', 'no_cta', $attributes );
		$framborder = $this->format_attribute( 'framborder', 'framborder', $attributes );
		$style = $this->format_attribute( '', 'style', $attributes );
		
		$wt = $width!=''?'':'width:100%;';
		$ht = $height!=''?'':'height:100%;';
		
		$mkstyle = $style!=''?$style:' border:0px solid #fff;';
		
			$html .= $width!=''?$width:'width="100%"';
			$html .= $height!=''?$height:'height="100%"';
			
			if($video_type=='yt'){
				$videoTag = 'src="https://www.youtube.com/embed/'.$video_id.'?controls=0"';
			}elseif($video_type=='vm'){
				$videoTag = 'src="https://player.vimeo.com/video/'.$video_id.'"';
			}elseif($video_type=='dm'){
				$videoTag = 'src="https://www.dailymotion.com/embed/video/'.$video_id.'"';
			}
			
				
			$html .= $videoTag.' style="'.$mkstyle.'"';
			$html .= ' allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture " ';
		
			$html .= $framborder;
			$html .= "allowfullscreen";
	
		
		$html .= '>';
		
		
		
	
		
		$html .= $content.'</iframe>';
		
		return $html;
	}
	

}