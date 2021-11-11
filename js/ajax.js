$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    loadCatalog();
    
    function loadCatalog(page, query) {
        $.ajax({
            method: "POST",
            url: "./ajax.php",
            data: {
                page: page,
                query: query
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

    $("#search_btn").click(function(e) {
        // e.preventDefault();
        loadCatalog(1, $("#search_bar").val());
    });
});
