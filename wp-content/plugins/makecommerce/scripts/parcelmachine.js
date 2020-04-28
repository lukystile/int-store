jQuery(function(){
	jQuery(document).on('updated_checkout', function(){
		jQuery(".parcel_machine_checkout").css('display', 'none');
		jQuery('.shipping_method:checked, .shipping_method[type=hidden]').each(function(){
			var method = jQuery(this).val(), display;
			if (method.indexOf(':') > -1) {
				var tmp = method.split(':');
				method = tmp[0];
			}
			jQuery(".parcel_machine_checkout_"+method).not(':first').remove();
			jQuery(".parcel_machine_checkout_"+method).css('display', 'table-row');
		});
		jQuery('.select-postmachine select').select2({
			formatResult: function(item) { 
				var texts = item.text.split(' - ', 2);
				return '<strong>'+texts[0]+'</strong>' + (texts[1] ? '<br/><small>'+texts[1]+'</small>' : '');
			}
		});
	});
});
