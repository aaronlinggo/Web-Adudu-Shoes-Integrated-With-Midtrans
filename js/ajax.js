$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });
});
