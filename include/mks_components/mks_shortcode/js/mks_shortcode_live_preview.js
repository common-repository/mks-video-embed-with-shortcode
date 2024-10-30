jQuery(function($) {
	/*tabs layout*/
	mks_shortcode_tabs( jQuery( '#otw-shortcode-preview' ).contents().find('body').find( '.otw-sc-tabs' ) );
	mks_shortcode_tabs( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find( '.otw-sc-tabs' ) );

	/*content toggle*/
	mks_shortcode_content_toggle( jQuery( '#otw-shortcode-preview' ).contents().find('body').find('.otw-sc-toggle > .toggle-trigger'), jQuery( '#otw-shortcode-preview' ).contents().find('body').find('.otw-sc-toggle > .toggle-trigger.closed') );
	mks_shortcode_content_toggle( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find('.otw-sc-toggle > .toggle-trigger'), jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find('.otw-sc-toggle > .toggle-trigger.closed') );
	
	//accordions
	mks_shortcode_accordions( jQuery( '#otw-shortcode-preview' ).contents().find('body').find( '.otw-sc-accordion' )  );
	mks_shortcode_accordions( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find( '.otw-sc-accordion' ) );
	
	//faq
	mks_shortcode_faq( jQuery( '#otw-shortcode-preview' ).contents().find('body').find( '.otw-sc-faq' )  );
	mks_shortcode_faq( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find( '.otw-sc-faq' ) );
	
	//showdow overlay
	mks_shortcode_shadow_overlay( jQuery( '#otw-shortcode-preview' ).contents().find('body').find( '.shadow-overlay' )  );
	mks_shortcode_shadow_overlay( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find( '.shadow-overlay' ) );
	
	//contact form
	jQuery( '#otw-shortcode-preview' ).contents().find('body').find('.otw-sc-contact-form form').submit(function() {
		return false;
	});
	jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find('.otw-sc-contact-form form').submit(function() {
		return false;
	});
	
	mks_shortcode_testimonials( jQuery( '#otw-shortcode-preview' ).contents().find('body').find( '.otw-sc-testimonials' ) );
	mks_shortcode_testimonials( jQuery( '.otw-shortcode-preview iframe' ).contents().find('body').find( '.otw-sc-testimonials' ) );
	
});