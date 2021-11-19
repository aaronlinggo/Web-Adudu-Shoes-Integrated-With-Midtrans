$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    function loadCatalog(page, query) {
        $.ajax({
            method: "POST",
            url: "./get_catalog.php",
            data: {
                page: page,
                query: query
            },
            success: function(response) {
                $("#catalog_row").html(response);
            }
        });
    }

    loadCatalog();

    $(document).on('click', '.halaman', function(){
        $(window).scrollTop(0);
        loadCatalog($(this).attr("id"));
    });

    $("#search_btn").click(function(e) {
        // e.preventDefault();
        // $("#search_area").css({ display: "none" });
        loadCatalog(1, $("#search_bar").val());
        $("#search_bar").val("");
    });
});
