$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    loadCatalog();
    
    function loadCatalog(page) {
        $.ajax({
            method: "POST",
            url: "./ajax.php",
            data: {
                page: page
            },
            success: function(response) {
                $("#catalog_row").html(response);
            }
        });
    }

    $(document).on('click', '.halaman', function(){
        $(window).scrollTop(0);
        loadCatalog($(this).attr("id"));
    });
});
