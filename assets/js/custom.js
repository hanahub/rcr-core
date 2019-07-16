function fb_block(selector) {
    jQuery(selector).block({ message: '<div class="fb_block"><img src="' + base_url + 'assets/images/ajax-loader.gif" /></div>',
                            overlayCSS: { backgroundColor: '#fff', opacity: '0.6' },
                            css: {border: 'none', background: "transparent", width: "188px", top: "30%" } });
}

function fb_unblock(selector) {
    jQuery(selector).unblock({fadeOut:  0});
}

jQuery(document).ready(function($) {
    $(document).on("change", "#check_all_products", function() {
        if ($(this).is(":checked")) 
            $(".product_checkbox").prop("checked", true);
        else 
            $(".product_checkbox").prop("checked", false);
    });
    
    $(document).ready(function() {
        setTimeout(function() {
            $("a[rel^='prettyPhoto']").prettyPhoto();    
        }, 3000);
        
        $(".filtering_form").on("submit", function(e) {
            setTimeout(function() {
                $("a[rel^='prettyPhoto']").prettyPhoto();    
            }, 3000);
        });
    });
});        