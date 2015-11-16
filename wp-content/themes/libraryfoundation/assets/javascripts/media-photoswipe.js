(function(window, $, PhotoSwipe){
    $(document).ready(function(){

        var options = {};

        $('.media-gallery').each(function(i, e) {
            PhotoSwipe.attach($(e).find('a'), options);
        });

    })
}(window, window.jQuery, window.Code.PhotoSwipe));