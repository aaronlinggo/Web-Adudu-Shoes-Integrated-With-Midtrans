let notifTimer;

$(document).ready(function() {
    $(".btn-close").click(function(e) {
        e.preventDefault();
        clearTimeout(notifTimer);

        $("#liveToast").removeClass("show");
        $("#liveToast").addClass("hide");

        setTimeout(() => {
            $("#notifPopup").removeAttr("style");
            $("#notifPopup").css({ "display": "none" });
        }, 250);
    });
});

function addCart(obj, qty) {
    let id_sepatu = $(obj).attr("value");
    let calcHeaderHeight = $("#header").height() + 30;

    $.ajax({
        method: "POST",
        url: "./update_cart.php",
        data: {
            id_sepatu: id_sepatu,
            qty : qty
        },
        success: function() {
            $("#notifPopup").removeAttr("style");
            $("#notifPopup").css({
                "display": "block",
                "top": calcHeaderHeight,
                "right": "0",
                "z-index": "99999"
            });

            clearTimeout(notifTimer);

            setTimeout(() => {
                $("#liveToast").removeClass("hide");
                $("#liveToast").addClass("show");
            }, 250);

            notifTimer = setTimeout(() => {
                $("#liveToast").removeClass("show");
                $("#liveToast").addClass("hide");

                setTimeout(() => {
                    $("#notifPopup").removeAttr("style");
                    $("#notifPopup").css({ "display": "none" });
                }, 250);
            }, 5000);
        }
    });
}
