	<script type="text/javascript" src="{{ url() }}/js/tinymce/tinymce.min.js"></script>
	<style>
		@media screen and (max-width: 640px) {
			table {
				overflow-x: auto;
				display: block;
			}
		}
	</style>
	<script>
        // content
        tinymce.init({
            selector: "textarea#content",
            theme: "modern",
            width: '100%',
            height: 300,
            menubar : false,
            keep_styles: true,
            valid_elements : '*[*]',
            extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor anchor code"
           ],
           toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | table | link newimage anchor | print media | blockquote | code preview fullpage | shortcodes",
           document_base_url: "{{ config::get('web.website.url') }}/",
           relative_urls: false,
           setup: function(editor) {
                editor.addButton('newimage', {
                    icon: 'image',
                    onclick : function(){
                        openMediaTool('{{ config::get('web.app.url') }}/image-library');
                    }
                });
                editor.addButton('shortcodes', {
                    type: 'menubutton',
                    text: 'Insert',
                    icon: false,
                    menu: [
                        // {
                        //     text: 'Gallery',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/gallery?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Survey',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/survey/list?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Image Flip',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/image_flip?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Video',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/video_library?target=tinymce');
                        //     }
                        // },
                        {
                            text: 'SNS Post',
                            onclick: function() {
                                openMediaTool('{{ config::get('web.app.url') }}/article/sns#facebook?target=tinymce');
                            }
                        },
                        /*{
                            text: 'Recommended Articles',
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/single_reco?target=tinymce');
                            }
                        },
                        {
                            text: 'Custom button',
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/custom_button?target=tinymce');
                            }
                        },
                        {
                            text: 'Establishment',
                            tooltip: 'Establishment',
                            onpostrender: changeButton,
                            onclick: function() {
                                var shortcode = '[establishments:'+1+']';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'Event',
                            tooltip: 'Event',
                            onpostrender: changeButton,
                            onclick: function() {
                                var shortcode = '[events:'+1+']';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'In-Article Search Widget',
                            onclick: function() {
                                var shortcode = '[searchbox]';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'Big Image',
                            tooltip: 'Big Image',
                            onpostrender: changeButton,
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/image_library?target=bigImage');
                            }
                        },*/
                    ]
                });
           }
        });
        // custom content
		tinymce.init({
		    selector: "textarea#content_custom",
		    theme: "modern",
		    width: '100%',
		    height: 300,
		    menubar : false,
		    keep_styles: true,
		    valid_elements : '*[*]',
		    extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",
		    plugins: [
		         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		         "save table contextmenu directionality emoticons template paste textcolor anchor code"
		   ],
		   toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | bullist numlist | table | link newimage anchor | print media | blockquote | code preview fullpage | shortcodes",
		   document_base_url: "{{ config::get('web.website.url') }}/",
		   relative_urls: false,
		   setup: function(editor) {
                editor.addButton('newimage', {
					icon: 'image',
					onclick : function(){
						openMediaTool('{{ config::get('web.app.url') }}/image-library');
					}
				});
				editor.addButton('shortcodes', {
                    type: 'menubutton',
                    text: 'Insert',
                    icon: false,
                    menu: [
                        // {
                        //     text: 'Gallery',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/gallery?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Survey',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/survey/list?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Image Flip',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/image_flip?target=tinymce');
                        //     }
                        // },
                        // {
                        //     text: 'Video',
                        //     onclick: function() {
                        //         $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/video_library?target=tinymce');
                        //     }
                        // },
                        {
                            text: 'SNS Post',
                            onclick: function() {
								openMediaTool('{{ config::get('web.app.url') }}/article/sns#facebook?target=tinymce');
                            }
                        },
                        /*{
                            text: 'Recommended Articles',
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/single_reco?target=tinymce');
                            }
                        },
                        {
                            text: 'Custom button',
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/article/custom_button?target=tinymce');
                            }
                        },
                        {
                            text: 'Establishment',
                            tooltip: 'Establishment',
                            onpostrender: changeButton,
                            onclick: function() {
                                var shortcode = '[establishments:'+1+']';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'Event',
                            tooltip: 'Event',
                            onpostrender: changeButton,
                            onclick: function() {
                                var shortcode = '[events:'+1+']';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'In-Article Search Widget',
                            onclick: function() {
                                var shortcode = '[searchbox]';
                                parent.tinymce.get('article_content').execCommand('mceInsertContent', false, shortcode);
                                singleCookies.clear();
                                singleWidget.clear();
                            }
                        },
                        {
                            text: 'Big Image',
                            tooltip: 'Big Image',
                            onpostrender: changeButton,
                            onclick: function() {
                                $('#toolModal').modal('show').find('iframe').attr('src', window.location.origin+'/image_library?target=bigImage');
                            }
                        },*/
                    ]
                });
		   }
        });

	</script>
