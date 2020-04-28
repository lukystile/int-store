(function ($) {
     /* ==============================================
        Backend Stuffs in this JS
    =============================================== */
    $(document).ready(function ($) {

        // Header Radio Button
        $( "#setting_menu_position .format-setting-wrap .type-radio-image .option-tree-ui-radio-images" ).append( "<span class='header-bottom-arrow'></span>" );

        $("#setting_menu_position .format-setting-wrap .type-radio-image .option-tree-ui-radio-images").on('click', function() {
            $("#setting_menu_position .format-setting-wrap .type-radio-image .option-tree-ui-radio-images").removeClass('header-is-active');
            $(this).addClass('header-is-active');
        });

        /*---------------------------------------------------------------*/
        /* =  Toggle Meta boxes based on page template
        /*---------------------------------------------------------------*/
        function juster_page_template_toggle_metaboxes() {

            var choice = $("option[value='page-kenburns-photography.php']:selected, option[value='page-slider-photography.php']:selected, option[value='page-photography.php']:selected, option[value='page-masonry-photography.php']:selected, option[value='template-one-page-architecture.php']:selected, option[value='template-vintage-home.php']:selected, option[value='template-agency-home.php']:selected, option[value='template-scroll-lock.php']:selected").val();

            $('#setting_port_limit').hide();
            $('#setting_port_column').hide();
            $('#setting_enable_cat_filter').hide();
            $('#setting_filter_title').hide();
            $('#setting_filter_text_color').hide();
            $('#setting_filter_bg').hide();
            $('#setting_port_click_effect').hide();
            $('#setting_port_order').hide();
            $('#setting_port_order_by').hide();
            $('#setting_offset_port').hide();
            $('#setting_show_port_cat').hide();
            $('#setting_port_pageination').hide();
            $('#setting_one_page_arch').hide();
            $('#setting_one_page_arch_limit').hide();
            $('#setting_one_page_arch_order').hide();
            $('#setting_one_page_arch_orderby').hide();
            $('#setting_one_page_arch_offset').hide();
            $('#setting_one_page_arch_cat_slug').hide();
            // Scroll Lock
            $('#setting_sl_limits').hide();
            $('#setting_sl_order').hide();
            $('#setting_sl_orderby').hide();
            $('#setting_sl_category').hide();

            // Agency typing text
            $('#setting_special_banner_typetext').hide();

            if (choice == 'page-kenburns-photography.php') {
                $('#setting_port_limit').slideDown('slow');
                $('#setting_port_order').slideDown('slow');
                $('#setting_port_order_by').slideDown('slow');
                $('#setting_offset_port').slideDown('slow');
                $('#setting_show_port_cat').slideDown('slow');
                $('#setting_port_pageination').slideDown('slow');
            }
            if (choice == 'page-slider-photography.php') {
                $('#setting_port_limit').slideDown('slow');
                $('#setting_port_order').slideDown('slow');
                $('#setting_port_order_by').slideDown('slow');
                $('#setting_offset_port').slideDown('slow');
                $('#setting_show_port_cat').slideDown('slow');
                $('#setting_port_pageination').slideDown('slow');
            }
            if (choice == 'page-photography.php') {
                $('#setting_port_limit').slideDown('slow');
                $('#setting_port_column').slideDown('slow');
                $('#setting_enable_cat_filter').slideDown('slow');
                $('#setting_filter_title').slideDown('slow');
                $('#setting_filter_text_color').slideDown('slow');
                $('#setting_filter_bg').slideDown('slow');
                $('#setting_port_click_effect').slideDown('slow');
                $('#setting_port_order').slideDown('slow');
                $('#setting_port_order_by').slideDown('slow');
                $('#setting_offset_port').slideDown('slow');
                $('#setting_show_port_cat').slideDown('slow');
                $('#setting_port_pageination').slideDown('slow');
            }
            if (choice == 'page-masonry-photography.php') {
                $('#setting_port_limit').slideDown('slow');
                $('#setting_port_column').slideDown('slow');
                $('#setting_enable_cat_filter').slideDown('slow');
                $('#setting_filter_title').slideDown('slow');
                $('#setting_filter_text_color').slideDown('slow');
                $('#setting_filter_bg').slideDown('slow');
                $('#setting_port_click_effect').slideDown('slow');
                $('#setting_port_order').slideDown('slow');
                $('#setting_port_order_by').slideDown('slow');
                $('#setting_offset_port').slideDown('slow');
                $('#setting_show_port_cat').slideDown('slow');
                $('#setting_port_pageination').slideDown('slow');
            }
            if (choice == 'template-one-page-architecture.php') {
                $('').slideUp('fast');
                $('#setting_one_page_arch').slideDown('slow');
                $('#setting_one_page_arch_limit').slideDown('slow');
                $('#setting_one_page_arch_order').slideDown('slow');
                $('#setting_one_page_arch_orderby').slideDown('slow');
                $('#setting_one_page_arch_offset').slideDown('slow');
                $('#setting_one_page_arch_cat_slug').slideDown('slow');
            }
            if (choice == 'template-agency-home.php') {
                $('').slideUp('fast');
                $('#setting_special_banner_typetext').slideDown('slow');
            }
            // Scroll Lock
            if (choice == 'template-scroll-lock.php') {
                $('#setting_sl_limits').slideDown('slow');
                $('#setting_sl_order').slideDown('slow');
                $('#setting_sl_orderby').slideDown('slow');
                $('#setting_sl_category').slideDown('slow');
            }

            var check = $("#setting_enable_page_title input:checked").val();
            $('#setting_new_page_title').hide();
            if (check!='') {
                $('#setting_new_page_title').slideDown('slow');
            }

        }

        juster_page_template_toggle_metaboxes(); // Execute on document ready

        $('#pageparentdiv select[id="page_template"]').click(juster_page_template_toggle_metaboxes);

    });

    $(document).ready(function ($) {
        /*---------------------------------------------------------------*/
        /* =  Toggle Meta boxes based on post formats
        /*---------------------------------------------------------------*/
        function juster_post_format_toggle_metaboxes() {

            // Hide All Format Metabox Fields
            function hide_all_format_metaboxes() {
              $('#setting_link_content, #setting_audio_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_default_message, #setting_video_content_popup, #setting_audio_content_popup').hide();
            }
            // Show Only Image Format Metabox Fields
            function image_format_metaboxes() {
              $('#setting_link_content, #setting_audio_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_video_content_popup, #setting_audio_content_popup').slideUp('fast');
              $('#setting_default_message').slideDown('slow');
            }
            // Show Only Link Format Metabox Fields
            function link_format_metaboxes() {
              $('#setting_audio_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_default_message, #setting_video_content_popup, #setting_audio_content_popup').slideUp('fast');
              $('#setting_link_content').slideDown('slow');
            }
            // Show Only Audio Format Metabox Fields
            function audio_format_metaboxes() {
              $('#setting_link_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_default_message, #setting_video_content_popup').slideUp('fast');
              $('#setting_audio_content_popup, #setting_audio_content').slideDown('slow');
            }
            // Show Only Video Format Metabox Fields
            function video_format_metaboxes() {
              $('#setting_link_content, #setting_audio_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_default_message, #setting_audio_content_popup').slideUp('fast');
              $('#setting_video_content_popup, #setting_video_content').slideDown('slow');
            }
            // Show Only Gallery Format Metabox Fields
            function gallery_format_metaboxes() {
              $('#setting_link_content, #setting_audio_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_default_message, #setting_video_content_popup, #setting_audio_content_popup').slideUp('fast');
              $('#setting_gallery_content').slideDown('slow');
            }
            // Show Only Quote Format Metabox Fields
            function quote_format_metaboxes() {
              $('#setting_link_content, #setting_audio_content, #setting_video_content, #setting_gallery_content, #setting_default_message, #setting_video_content_popup, #setting_audio_content_popup').slideUp('fast');
              $('#setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote').slideDown('slow');
            }

            function getMetaFieldsWork() {
              if (postFormat == 'standard') {image_format_metaboxes();}
              if (postFormat == 'image') {image_format_metaboxes();}
              if (postFormat == 'link') {link_format_metaboxes();}
              if (postFormat == 'audio') {audio_format_metaboxes();}
              if (postFormat == 'video') {video_format_metaboxes();}
              if (postFormat == 'gallery') {gallery_format_metaboxes();}
              if (postFormat == 'quote') {quote_format_metaboxes();}
            }

            hide_all_format_metaboxes();
            let postFormat;
            if ($('div').hasClass("block-editor")) {
              wp.data.subscribe( () => {
                const newPostFormat = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'format' );
                if ( postFormat !== newPostFormat ) {
                  postFormat = newPostFormat;
                }
                getMetaFieldsWork(); // On Change Page Effect
              } );
            } // If hasClass of block-editor

            // Saved Value Effect
            getMetaFieldsWork();

            // Classic Editor
            if (!$('body').hasClass('.block-editor-page')) { // If Condition for Classic Editor
                var format = $("input[name='post_format']:checked").val();

                $('#setting_link_content, #setting_audio_content, #setting_video_content, #setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote, #setting_gallery_content, #setting_default_message, #setting_video_content_popup, #setting_audio_content_popup').hide();

                if (format == '0' || format == 'image') {
                    $('').slideUp('fast');
                    $('#setting_default_message').slideDown('slow');
                }
                if (format == 'link') {
                    $('').slideUp('fast');
                    $('#setting_link_content').slideDown('slow');
                }
                if (format == 'audio') {
                    $('').slideUp('fast');
                    $('#setting_audio_content_popup, #setting_audio_content').slideDown('slow');
                }
                if (format == 'video') {
                    $('').slideUp('fast');
                    $('#setting_video_content_popup, #setting_video_content').slideDown('slow');
                }
                if (format == 'gallery') {
                    $('').slideUp('fast');
                    $('#setting_gallery_content').slideDown('slow');
                }
                if (format == 'quote') {
                    $('').slideUp('fast');
                    $('#setting_quote_author_name, #setting_quote_author_link, #setting_quote_author_quote').slideDown('slow');
                }
            } // If Condition for Classic Editor
        }

        juster_post_format_toggle_metaboxes(); // Execute on document ready

        if (!$('body').hasClass('.block-editor-page')) {
            $('#post-formats-select input[type="radio"]').click(juster_post_format_toggle_metaboxes);
        }

    });

})(jQuery);