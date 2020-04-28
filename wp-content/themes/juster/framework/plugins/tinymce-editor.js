(function() {
    tinymce.PluginManager.add('jt_custom_btn', function( editor, url ) {
        editor.addButton( 'jt_custom_btn', {
            text: 'Custom Shortcode',
            icon: false,
            type: 'menubutton',
            menu: [
                {
                    text: 'Content Styling',
                    menu: [
                        {
                            text: 'Highlight',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Highlight Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Hello' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#ffffff' },
                                        { type: 'textbox', name: 'bg_color', label: 'Background Color', value: '#497bb8' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '22px' },
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}, {text: 'Style Four', value: 'style-four'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_highlight text="' + e.data.text + '" text_color="' + e.data.text_color + '" bg_color="' + e.data.bg_color + '" text_size="' + e.data.text_size + '" style="' + e.data.style + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        },
                        {
                            text: 'Dropcaps',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Dropcaps Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'D' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#ffffff' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '22px' },
                                        { type: 'textbox', name: 'bg_color', label: 'Background Color', value: '#497bb8' },
                                        { type: 'textbox', name: 'border_color', label: 'Border Color', value: '#ffffff' },
                                        { type: 'textbox', name: 'border_bottom_color', label: 'Border Bottom Color', value: '#ffffff' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_dropcaps style="' + e.data.style + '" text="' + e.data.text + '" text_color="' + e.data.text_color + '" text_size="' + e.data.text_size + '" bg_color="' + e.data.bg_color + '" border_color="' + e.data.border_color + '" border_bottom_color="' + e.data.border_bottom_color + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        },
                        {
                            text: 'Tooltip',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Tooltip Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'title', label: 'Tooltip Title', value: 'Tooltip Text' },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Hello' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#ffffff' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '22px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_tooltip tooltip_title="' + e.data.title + '" text="' + e.data.text + '" text_color="' + e.data.text_color + '" text_size="' + e.data.text_size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        },
                        /* Lists */
                        {
                            text: 'Lists',
                            onclick: function() {
                                editor.insertContent('[jt_lists class="custom-class"][jt_list text="Hello" icon="fa fa-heart" link="http://www.google.com" color="#000" size="22px" icon_color="#000" icon_size="22px" target="yes"][jt_list text="Hello" icon="fa fa-heart" link="http://www.google.com" color="#000" size="22px" icon_color="#000" icon_size="22px" target="yes"][/jt_lists]');
                            }
                        }, // End Lists
                        /* Blockquote */
                        {
                            text: 'Blockquote',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Blockquote Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'author_name', label: 'Author Name', value: 'David Ward' },
                                        { type: 'textbox', name: 'content', label: 'Content', value: 'Your Content Here...', multiline: true, minWidth: 300, minHeight: 100 },
                                        { type: 'textbox', name: 'content_color', label: 'Content Color', value: '#000' },
                                        { type: 'textbox', name: 'content_size', label: 'Content Size', value: '13px' },
                                        { type: 'textbox', name: 'link', label: 'Link', value: '' },
                                        { type: 'textbox', name: 'bg_color', label: 'Background Color', value: '' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_blockquote style="' + e.data.style + '" text="' + e.data.author_name + '" content="' + e.data.content + '" content_color="' + e.data.content_color + '" content_size="' + e.data.content_size + '" link="' + e.data.link + '" bg_color="' + e.data.bg_color + '" text_color="' + e.data.text_color + '" text_size="' + e.data.text_size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Blockquote
                        /* H4 */
                        {
                            text: 'H4',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'H4 Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'title', label: 'Title', value: 'Hello' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#000' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '18px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_h4 title="' + e.data.title + '" color="' + e.data.text_color + '" size="' + e.data.text_size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End H4
                        /* Custom Button */
                        {
                            text: 'Custom Button',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Custom Button Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'text', label: 'Title', value: 'Hello' },
                                        { type: 'textbox', name: 'link', label: 'Link', value: '' },
                                        { type: 'listbox', name: 'target', label: 'Need to Open New Window?',
                                            'values': [ {text: 'Yes, please.', value: 'yes'}, {text: 'No', value: 'no'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#DD3533' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '20px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_custom_button button_text="' + e.data.text + '" link="' + e.data.link + '" target="' + e.data.target + '" size="' + e.data.text_size + '" color="' + e.data.text_color + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Custom Button
                        /* Separator */
                        {
                            text: 'Separator',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Separator Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'type', label: 'Type',
                                            'values': [ {text: 'Type One', value: 'type-one'}, {text: 'Type Two', value: 'type-two'}, {text: 'Type Three', value: 'type-three'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Title', value: 'Hello' },
                                        { type: 'listbox', name: 'align', label: 'Alignment',
                                            'values': [ {text: 'Center', value: 'center'}, {text: 'Left', value: 'left'}, {text: 'Right', value: 'right'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'sep_width', label: 'Separator Width', value: '50px' },
                                        { type: 'textbox', name: 'sep_height', label: 'Separator Height', value: '5px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_separator type="' + e.data.type + '" title="' + e.data.text + '" align="' + e.data.align + '" sep_width="' + e.data.sep_width + '" sep_height="' + e.data.sep_height + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Separator
                        /* Link Text */
                        {
                            text: 'Link Text',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Link Text Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'View More Works' },
                                        { type: 'textbox', name: 'link', label: 'Link', value: '' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#000' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '16px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_link_text style="' + e.data.style + '" text="' + e.data.text + '" link="' + e.data.link + '" color="' + e.data.color + '" size="' + e.data.size + '" class="' + e.data.extra_class + '"]' );
                                    }
                                });
                            }
                        }, // End Link Text
                    ]
                },
                {
                    text: 'Misc',
                    menu: [
                        /* Special Heading */
                        {
                            text: 'Special Heading',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Special Heading Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}, {text: 'Style Four', value: 'style-four'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Hello' },
                                        { type: 'textbox', name: 'tag', label: 'Tag', value: 'h2' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#000' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '22px' },
                                        { type: 'listbox', name: 'text_transform', label: 'Text Transform',
                                            'values': [ {text: 'Normal', value: 'none'}, {text: 'Uppercase', value: 'uppercase'}, {text: 'Capitalize', value: 'capitalize'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_special_heading style="' + e.data.style + '" text="' + e.data.text + '" tag="' + e.data.tag + '" color="' + e.data.color + '" size="' + e.data.size + '" text_transform="' + e.data.text_transform + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Special Heading
                        /* Special Text */
                        {
                            text: 'Special Text',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Special text Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}, {text: 'Style Four', value: 'style-four'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Hello' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#000' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '22px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_special_text text="' + e.data.text + '" color="' + e.data.color + '" size="' + e.data.size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Special Text
                        /* Special Content */
                        {
                            text: 'Special Content',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Special Content Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'heading', label: 'Heading', value: 'Hello' },
                                        { type: 'textbox', name: 'heading_color', label: 'Heading Color', value: '#35373E' },
                                        { type: 'textbox', name: 'heading_size', label: 'Heading Size', value: '14px' },
                                        { type: 'textbox', name: 'content_color', label: 'Content Color', value: '#999' },
                                        { type: 'textbox', name: 'content_size', label: 'Content Size', value: '15px' },
                                        { type: 'textbox', name: 'content', label: 'Content', value: 'Your Content Here...', multiline: true, minWidth: 300, minHeight: 100 },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_special_content style="' + e.data.style + '" class="' + e.data.extra_class + '" heading="' + e.data.heading + '" heading_color="' + e.data.heading_color + '" heading_size="' + e.data.heading_size + '" content_color="' + e.data.content_color + '" content_size="' + e.data.content_size + '"]' + e.data.content + '[/jt_special_content]');
                                    }
                                });
                            }
                        }, // End Special Content
                        // Social Icon
                        {
                            text: 'Social Icon',
                            menu: [
                                /* Social as Text */
                                {
                                    text: 'Social As Text',
                                    onclick: function() {
                                        editor.insertContent('[jt_social_icons style="style-one" heading="Social Icons" class=""][social text="Facebook" link="http://www.facebook.com" color="#000" size="22px"][jt_social style="style-one" text="Linkedin" link="http://www.linkedin.com" color="#000" size="22px" ][/jt_social_icons]');
                                    }
                                }, // End Social as Text
                                {
                                    text: 'Social As Icon',
                                    onclick: function() {
                                        editor.windowManager.open( {
                                            title: 'Contact Icon',
                                            body: [
                                                { type: 'listbox', name: 'style', label: 'Style',
                                                    'values': [ {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}, {text: 'Style Four', value: 'style-four'}, {text: 'Style Five', value: 'style-five'}, {text: 'Style Six', value: 'style-six'}, {text: 'Style Seven', value: 'style-seven'}, {text: 'Style Eight', value: 'style-eight'}, {text: 'Style Nine', value: 'style-nine'}, {text: 'Style Ten', value: 'style-ten'}, {text: 'Style Eleven', value: 'style-eleven'}
                                                    ]
                                                },
                                                { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                            ],
                                            onsubmit: function( e ) {
                                                editor.insertContent( '[jt_social_icons style="' + e.data.style + '" class="' + e.data.extra_class + '"][jt_social icon="fa fa-facebook" link=""http://www.facebook.com" icon_color="#000" icon_size="18px"][jt_social icon="fa fa-twitter" link="http://www.twitter.com" icon_color="#000" icon_size="18px"][/jt_social_icons]');
                                            }
                                        });
                                    }
                                },
                                // End Social as Icon
                            ]
                        },
                        // End Social Icon
                        /* Addresses */
                        {
                            text: 'Addresses',
                            onclick: function() {
                                editor.insertContent( '[jt_addresses][jt_address][h4 title="Address" color="" size="" ][jt_special_text text="44 New Design Street, Melbourne 005" color="" size=""][/jt_address][jt_address][h4 title="Social Shares" color="" size="" ][jt_social_icons style="style-two" class=""][jt_social icon="fa fa-facebook" link="#" icon_color="" icon_size=""][jt_social style="style-two" icon="fa fa-linkedin" link="#" icon_color="" icon_size=""][jt_social style="style-two" icon="fa fa-twitter" link="#" icon_color="" icon_size=""][/jt_social_icons][/jt_address][/jt_addresses]');
                            }
                        }, // End Addresses
                        {
                            text: 'Contact Info',
                            menu: [
                                {
                                    text: 'Icon',
                                    onclick: function() {
                                        editor.windowManager.open( {
                                            title: 'Contact Icon',
                                            body: [
                                                { type: 'listbox', name: 'style', label: 'Style',
                                                    'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}
                                                    ]
                                                },
                                                { type: 'textbox', name: 'icon', label: 'Icon', value: 'pe-7s-call' },
                                                { type: 'textbox', name: 'title', label: 'Title', value: 'Call' },
                                                { type: 'textbox', name: 'link', label: 'Link', value: '' },
                                                { type: 'textbox', name: 'text', label: 'Text', value: '+(61) 123 456 7890' },
                                                { type: 'listbox', name: 'target', label: 'Need to Open New Window?',
                                                    'values': [ {text: 'Yes, please.', value: 'yes'}, {text: 'No', value: 'no'}
                                                    ]
                                                },
                                                { type: 'textbox', name: 'icon_color', label: 'Icon Color', value: '#333' },
                                                { type: 'textbox', name: 'icon_size', label: 'Icon Size', value: '20px' },
                                                { type: 'textbox', name: 'title_size', label: 'Title Size', value: '16px' },
                                                { type: 'textbox', name: 'title_color', label: 'Title Color', value: '#999' },
                                                { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#D0D0D0' },
                                                { type: 'textbox', name: 'text_size', label: 'Text Size', value: '16px' },
                                                { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                            ],
                                            onsubmit: function( e ) {
                                                editor.insertContent( '[jt_text_icon style="' + e.data.style + '" icon="' + e.data.icon + '" title="' + e.data.title + '" text="' + e.data.text + '" link="' + e.data.link + '" target="' + e.data.target + '" icon_color="' + e.data.icon_color + '" icon_size="' + e.data.icon_size + '" title_color="' + e.data.title_color + '" title_size="' + e.data.title_size + '" text_color="' + e.data.text_color + '" text_size="' + e.data.text_size + '" class="' + e.data.extra_class + '"]');
                                            }
                                        });
                                    }
                                },
                                /* Image */
                                {
                                    text: 'Image',
                                    onclick: function() {
                                        editor.insertContent('[jt_text_icon style="style-three" image_url="YOUR IMAGE URL" text="Hello" text_color="" text_size="" class="custom-class"]');
                                    }
                                }, // End Image
                            ]
                        },
                        /* Steps */
                        {
                            text: 'Steps',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Steps Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'heading', label: 'Heading', value: 'Creative Concept' },
                                        { type: 'textbox', name: 'icon', label: 'Icon', value: 'pe-7s-loop' },
                                        { type: 'textbox', name: 'heading_color', label: 'Heading Color', value: '#35373E' },
                                        { type: 'textbox', name: 'heading_size', label: 'Heading Size', value: '12px' },
                                        { type: 'textbox', name: 'icon_color', label: 'Content Color', value: '#000' },
                                        { type: 'textbox', name: 'icon_size', label: 'Content Size', value: '32px' },
                                        { type: 'listbox', name: 'step_type', label: 'Step Type',
                                            'values': [ {text: 'None', value: 'none'}, {text: 'Plus', value: 'plus'}, {text: 'Equal', value: 'equal'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_steps heading="' + e.data.heading + '" icon="' + e.data.icon + '" heading_color="' + e.data.heading_color + '" heading_size="' + e.data.heading_size + '" icon_color="' + e.data.icon_color + '" icon_size="' + e.data.icon_size + '" step_type="' + e.data.step_type + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Steps
                        /* Intro Text */
                        {
                            text: 'Intro Text',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Intro Text Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Hello' },
                                        { type: 'textbox', name: 'bold_text', label: 'Bold Text', value: 'Welcome' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#35373E' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '35px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_intro_text text="' + e.data.text + '" bold_text="' + e.data.bold_text + '" color="' + e.data.color + '" size="' + e.data.size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Intro Text
                        /* About List */
                        {
                            text: 'About List',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'About List Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'heading', label: 'Heading', value: 'Master Degree of design' },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'University of Design - 2012' },
                                        { type: 'textbox', name: 'heading_color', label: 'Heading Color', value: '#333' },
                                        { type: 'textbox', name: 'heading_size', label: 'Heading Size', value: '11px' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#999' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '16px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_about_list heading="' + e.data.heading + '" text="' + e.data.text + '" heading_color="' + e.data.heading_color + '" heading_size="' + e.data.heading_size + '" color="' + e.data.color + '" size="' + e.data.size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End About List
                        /* Contact Details */
                        {
                            text: 'Contact Details',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Contact Details Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'icon', label: 'Icon', value: 'pe-7s-call' },
                                        { type: 'textbox', name: 'text', label: 'Text', value: '+1 (123) 456-7890-321' },
                                        { type: 'textbox', name: 'icon_color', label: 'Icon Color', value: '#333' },
                                        { type: 'textbox', name: 'icon_size', label: 'Icon Size', value: '25px' },
                                        { type: 'textbox', name: 'color', label: 'Color', value: '#1A1A1A' },
                                        { type: 'textbox', name: 'size', label: 'Size', value: '16px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_contact_details icon="' + e.data.icon + '" text="' + e.data.text + '" icon_color="' + e.data.icon_color + '" icon_size="' + e.data.icon_size + '" color="' + e.data.color + '" size="' + e.data.size + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Contact Details
                        /* Social Counter */
                        {
                            text: 'Social Counter',
                            onclick: function() {
                                editor.insertContent('[jt_social_counter class=""][jt_social_like_count icon="fa fa-twitter" text="Twitter" number="25 758" link="" icon_color="" icon_size="" icon_border_color="" text_color="" text_size="" number_color="" number_size=""][jt_social_like_count icon="fa fa-linkedin" text="Linkedin" link="" number="7 854" icon_color="" icon_size="" icon_border_color="" text_color="" text_size="" number_color="" number_size="" ][/jt_social_counter]');
                            }
                        }, // End Social Counter
                    ]
                },
                {
                    text: 'Advanced',
                    menu: [
                        /* Typing Text */
                        {
                            text: 'Typing Text',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Typing Text Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'text_tag', label: 'Select Tag',
                                            'values': [ {text: 'h1', value: 'h1'}, {text: 'h2', value: 'h2'}, {text: 'h3', value: 'h3'}, {text: 'h4', value: 'h4'}, {text: 'h5', value: 'h5'}, {text: 'h6', value: 'h6'}, {text: 'p', value: 'p'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'normal_text', label: 'Normal Text', value: 'Handcrafted designs & ' },
                                        { type: 'textbox', name: 'animation_text', label: 'Animating Text', value: 'Experiences, Innovation, Excellence' },
                                        { type: 'textbox', name: 'type_speed', label: 'Type Speed', value: '30' },
                                        { type: 'textbox', name: 'back_delay', label: 'Back Delay', value: '500' },
                                        { type: 'textbox', name: 'loop', label: 'Loop', value: 'true' },
                                        { type: 'textbox', name: 'cursor', label: 'Cursor', value: '|' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_typing_text text_tag="' + e.data.text_tag + '" normal_text="' + e.data.normal_text + '" animation_text="' + e.data.animation_text + '" type_speed="' + e.data.type_speed + '" back_delay="' + e.data.back_delay + '" loop="' + e.data.loop + '" cursor="' + e.data.cursor + '"]');
                                    }
                                });
                            }
                        }, // End Typing Text
                        /* Subscribe */
                        {
                            text: 'Subscribe',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Subscribe Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Newsletter Subscribe' },
                                        { type: 'textbox', name: 'text_color', label: 'Text Color', value: '#35373E' },
                                        { type: 'textbox', name: 'text_size', label: 'Text Size', value: '11px' },
                                        { type: 'textbox', name: 'content', label: 'Content', value: '' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_subscribe text="' + e.data.text + '" text_color="' + e.data.text_color + '" text_size="' + e.data.text_size + '" class="' + e.data.extra_class + '"]' + e.data.content + '[/jt_subscribe]');
                                    }
                                });
                            }
                        }, // End Subscribe
                        /* Language */
                        {
                            text: 'Language Selector',
                            onclick: function() {
                                editor.insertContent('[jt_language_select class=""][jt_language text="en" link="http://www.google.com" color="#000" size="15px"][jt_language text="de" link="http://www.google.com" color="#000" size="15px"][/jt_language_select]');
                            }
                        }, // End Language
                        /* Social Share */
                        {
                            text: 'Social Share',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Social Share - Only for single post/portfolio',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'Share' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_social_share style="' + e.data.style + '" class="' + e.data.extra_class + '" text="' + e.data.text + '"][jt_icons facebook="yes" twitter="yes" linkedin="yes" google_plus="yes" icon_color="" icon_size=""][/jt_social_share]');
                                    }
                                });
                            }
                        }, // End Social Share
                        {
                            text: 'Dropdown Menu',
                            menu: [
                                /* Without Image */
                                {
                                    text: 'Without Image',
                                    onclick: function() {
                                        editor.insertContent('[jt_topbar_dropdown title="My Account" class="" title_color="" title_size="" title_link="" target="yes"][jt_dropdown_menu text="Login" size="" link="" target="yes"][jt_dropdown_menu text="Sign up" color="" size="" link="" target="yes"][/jt_topbar_dropdown]');
                                    }
                                }, // End Without Image
                                /* With Image */
                                {
                                    text: 'With Image',
                                    onclick: function() {
                                        editor.insertContent('[jt_topbar_dropdown title="EN" class="" title_color="" title_size="" title_link="" target="yes"][jt_dropdown_menu image_url="YOUR IMAGE URL" text="engliah" color="" size="" link="" target="yes"][jt_dropdown_menu image_url="YOUR IMAGE URL" text="francais" color="" size="" link="" target="yes"][/jt_topbar_dropdown]');
                                    }
                                }, // End With Image
                            ]
                        },
                    ]
                },
                // Others
                {
                    text: 'Others',
                    menu: [
                        /* Spacer */
                        {
                            text: 'Spacer',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Spacer Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'height', label: 'Height', value: '34px' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_spacer height="' + e.data.height + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Spacer
                        /* Back Text */
                        {
                            text: 'Back Text',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Back Text Shortcode',
                                    body: [
                                        { type: 'textbox', name: 'text', label: 'Text', value: 'VINTOX' },
                                        { type: 'textbox', name: 'front_text_color', label: 'Front Text Color', value: '#35373E' },
                                        { type: 'textbox', name: 'back_text_color', label: 'Back Text Color', value: '#F5F5F5' },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_back_text text="' + e.data.text + '" front_text_color="' + e.data.front_text_color + '" back_text_color="' + e.data.back_text_color + '" class="' + e.data.extra_class + '"]');
                                    }
                                });
                            }
                        }, // End Back Text
                        /* Portfolio Custom Meta */
                        {
                            text: 'Portfolio Custom Meta',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Portfolio Custom Meta - Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}, {text: 'Style Three', value: 'style-three'}, {text: 'Style Four', value: 'style-four'}, {text: 'Style Five', value: 'style-five'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'content', label: 'Content', value: '[jt_portfolio_meta title="Client" text="Loren Hanson" title_color="" title_size="" text_size="" text_color="" link="#" target="yes"][jt_portfolio_meta title="Type" text="Commercial" title_color="" title_size="" text_size="" text_color="" link="#" target="yes"]', multiline: true, minWidth: 450, minHeight: 200 },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_portfolio_custom_meta style="' + e.data.style + '" class="' + e.data.extra_class + '"]' + e.data.content + '[/jt_portfolio_custom_meta]');
                                    }
                                });
                            }
                        }, // End Portfolio Custom Meta
                        /* Footer Content */
                        {
                            text: 'Footer Content',
                            onclick: function() {
                                editor.windowManager.open( {
                                    title: 'Footer Content Shortcode',
                                    body: [
                                        { type: 'listbox', name: 'style', label: 'Style',
                                            'values': [ {text: 'Style One', value: 'style-one'}, {text: 'Style Two', value: 'style-two'}
                                            ]
                                        },
                                        { type: 'textbox', name: 'content', label: 'Content', value: 'Your Content Here...', multiline: true, minWidth: 300, minHeight: 100 },
                                        { type: 'textbox', name: 'extra_class', label: 'Extra Class', value: '' },
                                    ],
                                    onsubmit: function( e ) {
                                        editor.insertContent( '[jt_footer_content style="' + e.data.style + '" class="' + e.data.extra_class + '"]' + e.data.content + '[/jt_footer_content]');
                                    }
                                });
                            }
                        }, // End Footer Content
                    ]
                },
                // End Others
            ]
        });
    });
})();