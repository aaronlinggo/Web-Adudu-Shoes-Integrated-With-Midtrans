let notifTimer;

$(document).ready(function() {
    $(".btn-close").click(function(e) { 
        e.preventDefault();
        clearTimeout(notifTimer);

        $("#liveToast").removeClass("show");
        $("#liveToast").addClass("hide");
    });
});

function addCart(obj, qty) {
    let id_sepatu = $(obj).attr("value");

    $.ajax({
        method: "POST",
        url: "./update_cart.php",
        data: {
            id_sepatu: id_sepatu,
            qty : qty
        },
        success: function() {
            clearTimeout(notifTimer);

            $("#liveToast").removeClass("hide");
            $("#liveToast").addClass("show");

            notifTimer = setTimeout(() => {
                $("#liveToast").removeClass("show");
                $("#liveToast").addClass("hide");
            }, 5000);
        }
    });
}
