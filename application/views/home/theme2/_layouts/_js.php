

    <!-- Bootstrap -->
    <script src="<?= $asset_folder ?>js/popper.js"></script>
    <script src="<?= $asset_folder ?>js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="<?= $asset_folder ?>js/owl-carousel.js"></script>
    <script src="<?= $asset_folder ?>js/accordions.js"></script>
    <script src="<?= $asset_folder ?>js/datepicker.js"></script>
    <script src="<?= $asset_folder ?>js/scrollreveal.min.js"></script>
    <script src="<?= $asset_folder ?>js/waypoints.min.js"></script>
    <script src="<?= $asset_folder ?>js/jquery.counterup.min.js"></script>
    <script src="<?= $asset_folder ?>js/imgfix.min.js"></script> 
    <script src="<?= $asset_folder ?>js/slick.js"></script> 
    <script src="<?= $asset_folder ?>js/lightbox.js"></script> 
    <script src="<?= $asset_folder ?>js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="<?= $asset_folder ?>js/custom.js"></script>
    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>