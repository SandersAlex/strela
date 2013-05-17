function ChangeIMG(small, big) {
    jQuery('#small').attr('src', small);
    jQuery('.big').attr('href', big);
    jQuery('.cloud-zoom, .cloud-zoom-gallery').CloudZoom();
}

function ajax_colors(id, size) {
    jQuery.post(
            '/ajax/index.php',
            {
                ID: id,
                size: size
            },
            function (date) {
                jQuery('#colors_select').html(date);
                jQuery('#colors_select').slideDown();
            }
    );
}

jQuery(function () {
    jQuery('.select_size li:first-child a').addClass('active');
    jQuery('#colors_select li:first-child a').addClass('active');

    jQuery('.select_size a').click(function () {
        jQuery('#tovar_id').val('');

        jQuery('#colors_select').slideUp(200);
        var id = this.rel;
        var size = this.text;
        var res = ajax_colors(id, size);
        jQuery('.select_size a').removeClass('active');

        jQuery(this).addClass('active');
        return false;
    });
    jQuery('#colors_select a').live('click', function () {
        var tovar_id = jQuery(this).attr('rel');
        jQuery('#tovar_id').val(tovar_id);
        jQuery('#colors_select a').removeClass('active');
        jQuery(this).addClass('active');
        return false;
    });



});