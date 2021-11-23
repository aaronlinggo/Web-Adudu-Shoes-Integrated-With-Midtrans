$(document).ready(function() {
    $.ajax({
        "cache": false
    });

    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        options.async = true;
    });

    // $(document).on('click', '.page-item', function() {
    //     $(window).scrollTop(0);
    // });

    // $("#search_btn").click(function(e) {
    //     e.preventDefault();
    //     loadCatalog(1, true);
    // });

    loadCatalog(1, false);
});

function loadCatalog(page, search) {
    $.ajax({
        method: "POST",
        url: "./get_search.php",
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
            $("#catalog_row").html(response.hasil);
        }
    });
}
