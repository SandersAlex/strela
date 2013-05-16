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
            }
    );
}

jQuery(function () {
    jQuery('.select_size a').click(function () {
        var id = this.rel;
        var size = this.text;
//        alert(id + " " + size);
        var res = ajax_colors(id,size);

        return false;
    });
});