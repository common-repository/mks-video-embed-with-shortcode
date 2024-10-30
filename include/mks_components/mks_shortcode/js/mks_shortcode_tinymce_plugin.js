(function(){
	
	tinymce.PluginManager.requireLangPack( mks_shortcode_component.tinymce_button_key );
	
	tinymce.create('tinymce.plugins.' + mks_shortcode_component.tinymce_button_key + 'Plugin', {
	
		init : function(ed, url) {
			
			
			ed.addCommand(mks_shortcode_component.tinymce_button_key + 'Command', function( ui, v ) {
				
				if( typeof( v ) == 'object' && v.size() ){
					mks_shortcode_component.open_drowpdown_menu( v );
				}else{
					mks_shortcode_component.open_drowpdown_menu( jQuery( '#content_' + mks_shortcode_component.tinymce_button_key ).parent() );
				}
				mks_shortcode_component.insert_code = function( shortcode_object ){
					
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, shortcode_object.shortcode_code );
					tb_remove();
				}
			});
			
			// Register example button
			ed.addButton( mks_shortcode_component.tinymce_button_key, {
				
				title : 'Insert ShortCode',
				/*cmd :  mks_shortcode_component.tinymce_button_key + 'Command',
*/
				image : url + '/../images/otw-sbm-icon.png',
				onclick: function( p1 ){
					
					jQuery( '#' + this._id ).attr( 'data-otwkey', mks_shortcode_component.tinymce_button_key  );
					ed.execCommand( mks_shortcode_component.tinymce_button_key + 'Command', true, jQuery( '#' + this._id ) );
					
				}
			});
			
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive( mks_shortcode_component.tinymce_button_key, n.nodeName == 'IMG');
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return { 
				longname : 'MKSW Shortcode Component',
				author : 'Acnosoft.com',
				authorurl : 'https://acnosoft.com/',
				infourl : 'https://acnosoft.com',
				version : "1.0"
			}
		}
	});
	
	// Register plugin
	tinymce.PluginManager.add( mks_shortcode_component.tinymce_button_key, tinymce.plugins[ mks_shortcode_component.tinymce_button_key + 'Plugin' ]);
	
})();