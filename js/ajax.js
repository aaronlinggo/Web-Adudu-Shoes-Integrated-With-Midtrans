$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    loadCatalog();

    function loadCatalog(page) {
        // $("#catalog_row").load("./ajax.php", "", function(response, status, request) {
        // });

        $.ajax({
            method: "POST",
            url: "./ajax.php",
            data: {
                page: page
            },
            success: function(response) {
                console.log(response);
                $("#catalog_row").html(response);
            }
        });
    }
});
