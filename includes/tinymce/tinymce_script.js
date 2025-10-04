(function () {
    tinymce.PluginManager.add('theme_mweb_shortcodes', function (editor, url) {
        editor.addButton('mweb_button_key', {
            type: 'listbox',
            text: 'شورتکد ها',
            classes: 'btn mweb-tinymce-dropdown',
            icon: false,
            onselect: function (e) {
            },
            values: [
                {text: 'دکمه', classes: 'mweb_tinymce_dropdown_label'},
                {text: 'Default', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="default" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: 'گرد', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="round" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: '3D', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[button type="3d" color="" target="" link=""]' + tinyMCE.activeEditor.selection.getContent() + '[/button]');
                }},
                {text: 'مدیا', classes: 'mweb_tinymce_dropdown_label'},
                {text: 'آپارات', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[media type="aparat" id="id video aparat"]');
                }},
				{text: 'موزیک پلیر', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[myaudio link="audio file url"]');
                }},
				
				{text: 'دانلود', classes: 'mweb_tinymce_dropdown_label'},
                {text: 'دانلود ساده', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[dlline title="title" link="url"]');
                }},
               
				{text: 'نقل قول', classes: 'mweb_tinymce_dropdown_label'},
				{text: 'نقل قول', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[blockquote author=""]' + tinyMCE.activeEditor.selection.getContent() + '[/blockquote]');
                }},
              
                {text: 'لیست کشویی', classes: 'mweb_tinymce_dropdown_label'},
                {text: 'باکس لیست کشویی', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[accordion]' + tinyMCE.activeEditor.selection.getContent() + '[/accordion]');
                }},
                {text: 'گزینه لیست کشویی', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[accordion-item title=""]' + tinyMCE.activeEditor.selection.getContent() + '[/accordion-item]');
                }},
				{text: 'لیست مثبت', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[list_positive]' + tinyMCE.activeEditor.selection.getContent() + '[/list_positive]');
                }},
				{text: 'لیست منفی', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[list_negative]' + tinyMCE.activeEditor.selection.getContent() + '[/list_negative]');
                }},
				
				{text: 'محتوا', classes: 'mweb_tinymce_dropdown_label'},
				{text: 'محتوای کشویی', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[more_content btn="" height=""]' + tinyMCE.activeEditor.selection.getContent() + '[/more_content]');
                }},
				{text: 'لیست قیمت', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[product_lists id="" outofstock="false"]');
                }},
				
                {text: 'ستون بندی', classes: 'mweb_tinymce_dropdown_label'},
                {text: 'row', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[row]' + tinyMCE.activeEditor.selection.getContent() + '[/row]');
                }},
                {text: 'col 1/2', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="50%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'col 1/3', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="33%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'col 2/3', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="66%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
                {text: 'col 1/4', onclick : function() {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, '[column width="25%"]' + tinyMCE.activeEditor.selection.getContent() + '[/column]');
                }},
            ]
        });

    });
})();


