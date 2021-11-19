<!-- <script src="./js/jquery.min.js"></script> -->
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/popper.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<!-- <script src="./js/jquery-3.0.0.min.js"></script> -->
<script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- <script src="./js/plugin.js"></script>
<script src="./js/custom.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $('#myCarousel').carousel({
            interval: false
        });

        $("#myCarousel").on("touchstart", function(event) {
            var yClick = event.originalEvent.touches[0].pageY;

            $(this).one("touchmove", function(event) {
                var yMove = event.originalEvent.touches[0].pageY;

                if(Math.floor(yClick - yMove) > 1) {
                    $(".carousel").carousel('next');
                } else if(Math.floor(yClick - yMove) < -1) {
                    $(".carousel").carousel('prev');
                }
            });

            $(".carousel").on("touchend", function() {
                $(this).off("touchmove");
            });
        });
    });
</script>
