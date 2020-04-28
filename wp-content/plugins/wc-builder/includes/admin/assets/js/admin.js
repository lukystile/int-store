(function($){
"use strict";

    // Tab Menu
    function wpbforwpbakery_admin_tabs( $tabmenus, $tabpane ){
        $tabmenus.on('click', 'a', function(e){
            e.preventDefault();
            var $this = $(this),
                $target = $this.attr('href');
            $this.addClass('wlactive').parent().siblings().children('a').removeClass('wlactive');
            $( $tabpane + $target ).addClass('wlactive').siblings().removeClass('wlactive');
        });
    }
    wpbforwpbakery_admin_tabs( $(".wpbforwpbakery-admin-tabs"), '.wpbforwpbakery-admin-tab-pane' );
    
})(jQuery);