(function($) {
    $(document).ready(function() {

        $('.gallery-item a').has('img').attr('rel', 'prettyPhoto["my-pp"]');

        $("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false,
            theme: mypp_values[0].my_pp_theme
        });
    });
})(jQuery);