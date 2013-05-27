jQuery.noConflict();
jQuery(window).load(function () {
    jQuery("#carousel").carouFredSel({
        shownavitems:3,
        scroll:1,
        mousewheel:true,
        circular:true,
        start:1
    });
});
jQuery(document).ready(function () {
    jQuery('input[title]').each(function () {
        if (jQuery(this).val() === '') {
            jQuery(this).val(jQuery(this).attr('title'));
        }

        jQuery(this).focus(function () {
            if (jQuery(this).val() === jQuery(this).attr('title')) {
                jQuery(this).val('').addClass('focused');
            }
        });

        jQuery(this).blur(function () {
            if (jQuery(this).val() === '') {
                jQuery(this).val(jQuery(this).attr('title')).removeClass('focused');
            }
        });
    });
    jQuery('.menu').find('li').hover(function () {
        jQuery(this).toggleClass('active');
        jQuery(this).find('ul.submenu').stop(true, true).slideToggle();
    });



});
jQuery(function () {
    jQuery("#container").clickCarousel({margin:51});
});



