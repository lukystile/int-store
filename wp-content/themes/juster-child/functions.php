<?php
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */

function ww_load_dashicons(){
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons');

function aesti_register_eu_widget()
{
    register_sidebar(array(
        'name'          => 'EU Logo area',
        'id'            => 'eu_logo_widget',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => 'Resellers footer area',
        'id'            => 'resellers_area_widget',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'aesti_register_eu_widget');

function juster_custom_enqueue_child_theme_styles()
{
    wp_enqueue_style('parent-theme-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-child-style', get_stylesheet_uri(), array(), null);
}
add_action('wp_enqueue_scripts', 'juster_custom_enqueue_child_theme_styles', 11);

function filter_ot_recognized_font_families2($array, $field_id)
{

    $array['OfficinaSansBookITC-Reg'] = 'OfficinaSansBookITC-Reg';
    $array['OfficinaSansBoldITC-Reg'] = 'OfficinaSansBoldITC-Reg';
    return $array;
}

add_filter('ot_recognized_font_families', 'filter_ot_recognized_font_families2', 10, 2);

add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs');
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

function add_custom_html_code_to_footer()
{
    dynamic_sidebar('eu_logo_widget');
    // echo '<a href="/"><img src="'. get_theme_file_uri() .'/img/EU-logo.png" class="eu-logo"></a>';
}
add_action('wp_footer', 'add_custom_html_code_to_footer');

/**
 * Auto update cart after quantity change
 *
 * @return  string
 **/
add_action( 'woocommerce_after_cart', 'custom_after_cart' );
function custom_after_cart() {
?>
<script>
    jQuery(document).ready(function($) {
        function updateCart() {
            $(".woocommerce-cart-form").find(".qty").on("change", function(){
                if (Number($(this).val())) {
                    $('[name="update_cart"]').trigger('click');
                    $('.cart-contents-count').text($(this).val());
                }
            });
        }
        updateCart();
        $( document.body ).on( 'updated_cart_totals', function(){
            updateCart();
        });
    });
</script>
<?php
}

add_action('wp_enqueue_scripts', 'customScripts');
function customScripts() {
    wp_enqueue_script('rate-js', 'https://cdn.jsdelivr.net/npm/rater-jquery@1.0.0/rater.min.js', ['jquery'], null, true);
}

add_shortcode('custom_product_reviews', 'customProductReviews');
function customProductReviews() {
    global $product;
    $user_current_locale = get_locale();
    $productFields = get_field_object('field_5dd8054d79428', $product->id)['value'];
    ?>
    <div class="jt-heading">
        <h3 class="jt-main-head">
            <?php if($user_current_locale == "en_US" ):?>
                Customer Review
            <?php elseif($user_current_locale == "ru_RU" ):?>
                Отзыв Клиента
            <?php elseif($user_current_locale == "et" ):?>
                Kliendi Ülevaade
            <?php else:?>
                Customer Review
            <?php endif?>
        </h3>
    </div>
    <div class="vc-row">
        <?php foreach ((array) $productFields as $review): ?>
            <?php if (!empty($review)): ?>

                <div class="vc_text_separator wpb_content_element separator_align_center vc_text_separator_"></div>

                <div class="vc_col-sm-12">
                    <div class="rating-author-row">
                        <div class="rating-author-col review-status">
                            Verified buyer
                        </div>
                        <div class="rating-author-col">
                            <div class="rating" data-rate-value="<?= $review['rating'] ?>" data-rateit-mode="font"  style="font-size:25px;"></div>
                        </div>
                        <div class="rating-author-col review-author">
                            <?= $review['author_name'] ?>
                        </div>
                    </div>

                    <div class="vc-row">
                        <div class="vc_col-sm-12 review-date">
                            <h6><?= $review['date'] ?></h6>
                        </div>
                    </div>

                    <div class="vc-row">
                        <div class="vc_col-sm-12 review-title">
                            <div class="jt-heading" style="text-align:left;">
                                <h5 class="jt-main-head"><?= $review['title'] ?></h5>
                            </div>
                        </div>
                    </div>

                    <div class="vc-row">
                        <div class="vc_col-sm-12">

                            <div class="wpb_text_column wpb_content_element ">
                                <div class="wpb_wrapper">
                                    <p><?= $review['review_text'] ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <script>
            (function($){
                $(document).ready(() => {
                    let options = {
                        max_value: 5,
                        step_size: 0.5,
                        readonly: true
                    };
                    $(".rating").rate(options);
                });
            })(jQuery)
        </script>

        <style>
            .rating-author-row {
                display: flex;
                align-items: center;
                padding: 0 15px;
            }
            .rating-author-col {
                flex: 0 0 30%;
            }
            .rating-author-col:first-child {
                flex: 0 0 25%;
            }
            .rating {
                color: #ff6464;
            }
            .review-status,
            .review-author,
            .review-date {
                color: #808080;
            }
            .review-title h5 {
                font-weight: bold;
                margin-bottom: 0;
            }
        </style>

    </div>
    <?php
}


add_shortcode('custom_product_faq', 'customProductFaq');
function customProductFaq() {
    global $product;
    $user_current_locale = get_locale();
    $productFaq = get_field_object('field_5dde92cf89cc1', $product->id)['value'];
    ?>
    <div class="jt-heading">
        <h3 class="jt-main-head">
            <?php if($user_current_locale == "en_US" ):?>
                Most Asked Questions
            <?php elseif($user_current_locale == "ru_RU" ):?>
                Часто Задаваемые Вопросы
            <?php elseif($user_current_locale == "et" ):?>
                Enim küsitud küsimused
            <?php else:?>
                Most Asked Questions
            <?php endif?>
        </h3>
    </div>
    <div class="vc-row">
        <?php foreach ((array) $productFaq as $faq): ?>
            <?php if (!empty($faq)): ?>


                <div class="vc_col-sm-12 faq-item">
                    <div class="vc_text_separator wpb_content_element separator_align_center vc_text_separator_"></div>

                    <div class="vc-row">
                        <div class="vc_col-sm-12">
                            <blockquote>
                                <div class="jt-heading" style="text-align:left;">
                                    <h4 class="jt-main-head"><?= $faq['question'] ?></h4>
                                </div>

                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <p><?= $faq['answer'] ?></p>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>

        <style>
            .faq-item:nth-child(odd) blockquote {
                border-left-color: #ff6464;
            }
            .faq-item:nth-child(even) blockquote {
                border-left-color: #5aa1e3;
            }
        </style>

    </div>
    <?php
}

add_shortcode('custom_product_customer_story', 'customProductCustomerStory');
function customProductCustomerStory() {
    global $product;
    $user_current_locale = get_locale();
    $product_customer_story = get_field_object('field_5ddea62ee034b', $product->id)['value'];?>
    <div class="vc-row" style="margin-left: auto;margin-right: auto;">
        <?php foreach ((array) $product_customer_story as $review): ?>
            <?php foreach((array) $review as $key => $customer_image): ?>
                <?php if (!empty($review)): ?>

                    <?php if (count($product_customer_story) == 1 ): ?>
                        <div class="vc_col-sm-12">
                    <?php endif;?>
                    <?php if (count($product_customer_story) == 2): ?>
                        <div class="vc_col-sm-6">
                    <?php endif;?>
                    <?php if (count($product_customer_story) == 3): ?>
                        <div class="vc_col-sm-4">
                    <?php endif;?>
                    <?php if (count($product_customer_story) > 3): ?>
                        <div class="vc_col-sm-3">
                    <?php endif;?>
                        <div class="space-fix">
                            <div class="wpb_wrapper">
                                <div class="jt-heading" style="text-align:center;">
                                    <h3 class="jt-main-head">
                                        <?php if($user_current_locale == "en_US" ):?>
                                            Customer Story
                                        <?php elseif($user_current_locale == "ru_RU" ):?>
                                            История клиента
                                        <?php elseif($user_current_locale == "et" ):?>
                                            Kliendilugu
                                        <?php else:?>
                                            Customer Story
                                        <?php endif?>
                                    </h3>
                                </div>
                                <div class="jt-sep"></div>
                                <div class="wpb_single_image wpb_content_element vc_align_center">
                                    <figure class="wpb_wrapper vc_figure">
                                        <div class="vc_single_image-wrapper   vc_box_border_grey">
                                            <img src="<?= $customer_image['url'] ?>" class="vc_single_image-img attachment-full">
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>        
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach;?>
    </div>
<?php
}

add_filter( 'wp_nav_menu_items', 'filter_function_name_4792', 10, 2 );
function filter_function_name_4792( $items, $args ){
    $count = WC()->cart->cart_contents_count;
    if($count != 0){
        $cartWithBadge = "<span class='dashicons dashicons-cart'></span><span class='cart-contents-count'>{$count}</span>";
        $styles = '<style>
        a>span.cart-contents-count{
            background-color:#ff6464;
            padding: 3px 5px;
            border-radius:50%;
            letter-spacing:0;
            color:#fff;
            position:relative;
            top:-10px;
            font-size:10px;
        }
        a>span.dashicons-cart:before{
            // content: "\f303";
            display: inline-block;
            -webkit-font-smoothing: antialiased;
            font: normal 22px/1 "dashicons";
            vertical-align: top;
        }
        
        </style>';
        $items = str_replace('Cart', $cartWithBadge, $items) . $styles;
    }else{
        $items =  str_replace('Cart', ' ', $items);
    }
    return $items;
}

add_shortcode( 'show_subscribe_modal_for_logged_out', 'subscribeIfUserLoggedOut' );
function subscribeIfUserLoggedOut($atts, $content, $tag) {
    if (!is_user_logged_in() && $content) {
        return do_shortcode($content);
    }
}

add_shortcode('custom_product_we_like', 'customProductWeLike');
function customProductWeLike() {
    global $product;
    $user_current_locale = get_locale();
    $product_we_like = get_field_object('field_5df38207971e1', $product->id)['value'];
    if ($product_we_like != FALSE){
            foreach ((array) $product_we_like as $product_object){
                $products_ids[] = $product_object->ID;
            }?>
            <div class="jt-heading">
                <h3 class="jt-main-head">
                    <?php if($user_current_locale == "en_US" ):?>
                        Product We Like
                    <?php elseif($user_current_locale == "ru_RU" ):?>
                        Продукты, которые мы любим
                    <?php elseif($user_current_locale == "et" ):?>
                        Sulle võiks veel meeldida
                    <?php else:?>
                        Customer Story
                    <?php endif?>
                </h3>
            </div>
    <?php echo do_shortcode('[vc_row][vc_column][products columns="3" orderby="title" order="ASC" ids="' . implode(',', $products_ids) . '"][/vc_column][/vc_row]');
    }
}

add_shortcode('modal_window_subscribe', 'modal_window_subscribe');
function modal_window_subscribe($atts){
    ob_start();?>
    <div id="myModal1" class="modal fade" data-toggle="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">×</button>
                    <h3 style="text-align: center;"><?php echo $atts['heading']; ?></h3>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center;"><?php echo $atts['text']; ?></h4>
                    <p><?php echo do_shortcode('[mc4wp_form id="2609"]')?></p>
                </div>
            </div>
        </div>
    </div>
    <style>
        #myModal1 {
            z-index: 999999;
            border-radius: 20px;
            top:20%;
        }
        #myModal1 .modal-title {
            font-size: 32px;
        }
        #myModal1 .modal-body {
            font-size:16px;
        }
    </style>
    <?php
    return ob_get_clean();
}