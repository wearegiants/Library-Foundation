(function ($) {
    'use strict';

    $(document).ready(function () {
            $('#cii_start').on('click', function () {
                console.log('CII Start...');

                $('#results').html('');
                $(this).attr('disabled', 'disabled');
                fetch_used_images();
            });
        }
    );

    var fetch_used_images = function () {
        var output = 'Looking for used images...';
        $('#loading').text(output).fadeIn();
        console.log(output);

        var ajax = $.get(
            ajaxurl,
            {action: 'fetch_used_images'}
        );

        ajax.done(function (response) {
            response = $.parseJSON(response);
            var output = response.length + " used images found!";
            console.log(output);
            console.log(response);
            $('#loading').fadeOut();
            $('#results').append(output + "<br>");

            fetch_images_from_uploads_folder();
        });
    };

    var fetch_images_from_uploads_folder = function () {
        var output = 'Looking for all images in wp-contents/uploads folder';
        console.log(output);
        $('#loading').text(output).fadeIn();

        var ajax = $.get(
            ajaxurl,
            {action: 'fetch_images_in_uploads_folder'}
        );

        ajax.done(function (response) {
            response = $.parseJSON(response);
            var output = response.length + " images found in uploads folder";

            console.log(output);
            console.log(response);

            $('#loading').fadeOut();
            $('#results').append(output + "<br>");

            delete_unused_images();
        });
    };

    var delete_unused_images = function () {
        console.log('Will remove unused images');
        $.ajax({
            type: "GET",
            url: ajaxurl,
            data: {
                action: 'delete_unused_images',
            },
            success: function (response) {
                response = $.parseJSON(response);
                console.log('Total images removed:');
                console.log(response.length);
                $('#results').append("deleted ALL unused files");
                $('#cii_start').removeAttr('disabled');
                console.log('The plugin finished without errors');
            }
        });
    }
})(jQuery);
