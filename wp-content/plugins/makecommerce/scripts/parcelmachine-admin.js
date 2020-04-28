		jQuery(document).ready(function($) {
			var env_select = $('#woocommerce_parcelmachine_omniva_use_mk_contract');
			var contract_fields = ['woocommerce_parcelmachine_omniva_service_user', 'woocommerce_parcelmachine_omniva_service_password'];
			var self_fields = ['verify_feature_swc'];
			env_select.on('change', function(){
				hideFileds($(this).val());
			});
			hideFileds(env_select.val());
			function hideFileds(type) {
				var hide = type == '1' ? contract_fields : self_fields;
				var show = type == '0' ? contract_fields : self_fields;
				$.each(hide, function(i, elem) {
					$('#'+elem).closest('tr').addClass('fhidden');
				});
				$.each(show, function(i, elem) {
					$('#'+elem).closest('tr').removeClass('fhidden');
				});
			}
		});
