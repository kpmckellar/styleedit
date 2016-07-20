jQuery(function($) {

    tinymce.create('tinymce.plugins.rg_plugin', {
        init: function(ed, url) {
            ed.addCommand('rg_insert_shortcode', function() {
                //selected = tinyMCE.activeEditor.selection.getContent();
                content = '[owl-carousel category="Uncategorized" singleItem="true" autoPlay="true"]';
                tinymce.execCommand('mceInsertContent', false, content);
            });
            ed.addButton('rg_button', {
            	title: 'Insert shortcode', 
            	cmd: 'rg_insert_shortcode', 
            	image: url + '/../images/rg-logo-20.png'
            });
        }
    });
    
    tinymce.PluginManager.add('rg_button', tinymce.plugins.rg_plugin);

});