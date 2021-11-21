$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    // $(document).on('click', '.halaman', function(){
    //     $(window).scrollTop(0);
    //     loadCatalog($(this).attr("id"));
    // });

    $("#search_btn").click(function(e) {
        // e.preventDefault();
        // $("#search_area").css({ display: "none" });
        loadCatalog(1, true);
        // $("#search_bar").val("");
    });

    loadCatalog(1, false);
});

function loadCatalog(page, search) {
    $.ajax({
        method: "POST",
        url: "./get_search.php",
        // url: "./get_catalog.php",
        data: {
            page: page,
            query: $("#search_bar").val(),
            search: search, 
        },
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response) {
            // $("#catalog_row").html(response);
            $("#catalog_row").html(response.hasil);
        }
    });
}