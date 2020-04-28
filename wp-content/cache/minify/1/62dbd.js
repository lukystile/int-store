jQuery(function(t){if("undefined"==typeof wc_add_to_cart_params)return!1;var a=function(){t(document).on("click",".add_to_cart_button",this.onAddToCart).on("added_to_cart",this.updateButton).on("added_to_cart",this.updateCartPage).on("added_to_cart",this.updateFragments)};a.prototype.onAddToCart=function(a){var d=t(this);if(d.is(".ajax_add_to_cart")){if(!d.attr("data-product_id"))return!0;a.preventDefault(),d.removeClass("added"),d.addClass("loading");var o={};t.each(d.data(),function(t,a){o[t]=a}),t(document.body).trigger("adding_to_cart",[d,o]),t.post(wc_add_to_cart_params.wc_ajax_url.toString().replace("%%endpoint%%","add_to_cart"),o,function(a){a&&(a.error&&a.product_url?window.location=a.product_url:"yes"!==wc_add_to_cart_params.cart_redirect_after_add?t(document.body).trigger("added_to_cart",[a.fragments,a.cart_hash,d]):window.location=wc_add_to_cart_params.cart_url)})}},a.prototype.updateButton=function(a,d,o,r){(r=void 0!==r&&r)&&(r.removeClass("loading"),r.addClass("added"),wc_add_to_cart_params.is_cart||0!==r.parent().find(".added_to_cart").length||r.after(' <a href="'+wc_add_to_cart_params.cart_url+'" class="added_to_cart wc-forward" title="'+wc_add_to_cart_params.i18n_view_cart+'">'+wc_add_to_cart_params.i18n_view_cart+"</a>"),t(document.body).trigger("wc_cart_button_updated",[r]))},a.prototype.updateCartPage=function(){var a=window.location.toString().replace("add-to-cart","added-to-cart");t(".shop_table.cart").load(a+" .shop_table.cart:eq(0) > *",function(){t(".shop_table.cart").stop(!0).css("opacity","1").unblock(),t(document.body).trigger("cart_page_refreshed")}),t(".cart_totals").load(a+" .cart_totals:eq(0) > *",function(){t(".cart_totals").stop(!0).css("opacity","1").unblock(),t(document.body).trigger("cart_totals_refreshed")})},a.prototype.updateFragments=function(a,d){d&&(t.each(d,function(a){t(a).addClass("updating").fadeTo("400","0.6").block({message:null,overlayCSS:{opacity:.6}})}),t.each(d,function(a,d){t(a).replaceWith(d),t(a).stop(!0).css("opacity","1").unblock()}),t(document.body).trigger("wc_fragments_loaded"))},new a});
;jQuery(function(a){function b(){a("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").append('<input type="button" value="+" class="plus" />').prepend('<input type="button" value="-" class="minus" />')}String.prototype.getDecimals||(String.prototype.getDecimals=function(){var a=this,b=(""+a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);return b?Math.max(0,(b[1]?b[1].length:0)-(b[2]?+b[2]:0)):0}),a(document).on("updated_wc_div",function(){b()}),a(document).on("click",".plus, .minus",function(){var b=a(this).closest(".quantity").find(".qty"),c=parseFloat(b.val()),d=parseFloat(b.attr("max")),e=parseFloat(b.attr("min")),f=b.attr("step");c&&""!==c&&"NaN"!==c||(c=0),""!==d&&"NaN"!==d||(d=""),""!==e&&"NaN"!==e||(e=0),"any"!==f&&""!==f&&void 0!==f&&"NaN"!==parseFloat(f)||(f=1),a(this).is(".plus")?d&&c>=d?b.val(d):b.val((c+parseFloat(f)).toFixed(f.getDecimals())):e&&c<=e?b.val(e):c>0&&b.val((c-parseFloat(f)).toFixed(f.getDecimals())),b.trigger("change")}),b()});
;window.jQuery( document ).ready( function ( $ ) {
	$( 'body' ).on( 'adding_to_cart', function ( event, $button, data ) {
		$button && $button.hasClass( 'vc_gitem-link' ) && $button
			.addClass( 'vc-gitem-add-to-cart-loading-btn' )
			.parents( '.vc_grid-item-mini' )
			.addClass( 'vc-woocommerce-add-to-cart-loading' )
			.append( $( '<div class="vc_wc-load-add-to-loader-wrapper"><div class="vc_wc-load-add-to-loader"></div></div>' ) );
	} ).on( 'added_to_cart', function ( event, fragments, cart_hash, $button ) {
		if ( 'undefined' === typeof($button) ) {
			$button = $( '.vc-gitem-add-to-cart-loading-btn' );
		}
		$button && $button.hasClass( 'vc_gitem-link' ) && $button
			.removeClass( 'vc-gitem-add-to-cart-loading-btn' )
			.parents( '.vc_grid-item-mini' )
			.removeClass( 'vc-woocommerce-add-to-cart-loading' )
			.find( '.vc_wc-load-add-to-loader-wrapper' ).remove();
	} );
} );
