jQuery( document ).ready( function(){

	//tabs
	mks_shortcode_tabs( jQuery( '.otw-sc-tabs' ) );
	
	//content toggle
	mks_shortcode_content_toggle( jQuery('.toggle-trigger'), jQuery('.toggle-trigger.closed') );
	
	//accordions
	mks_shortcode_accordions( jQuery( '.otw-sc-accordion' ) );
	
	//faqs
	mks_shortcode_faq( jQuery( '.otw-sc-faq' ) );
	
	//shadow overlay
	mks_shortcode_shadow_overlay( jQuery( '.shadow-overlay' ) );
	
	//messages
	jQuery(".otw-sc-message.closable-message").find(".close-message").click(function() {
		jQuery(this).parent(".otw-sc-message").fadeOut("fast");
	});
	
	//testimonials
	mks_shortcode_testimonials( jQuery( '.otw-sc-testimonials' ) );
});