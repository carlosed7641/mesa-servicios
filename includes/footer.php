<footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xs-12">
                    <div class="left-text-content">
                        <p>Copyright &copy; 2021 Carlos Castro</p>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <div class="right-text-content">
                            <ul class="social-icons">
                                <li><p>Síguenos</p></li>
                                <li><a rel="nofollow" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a rel="nofollow" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a rel="nofollow" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a rel="nofollow" href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    

    <!-- jQuery -->
    <script src="/mesa-servicios/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="/mesa-servicios/assets/js/popper.js"></script>
    <script src="/mesa-servicios/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="/mesa-servicios/assets/js/owl-carousel.js"></script>
    <script src="/mesa-servicios/assets/js/scrollreveal.min.js"></script>
    <script src="/mesa-servicios/assets/js/waypoints.min.js"></script>
    <script src="/mesa-servicios/assets/js/jquery.counterup.min.js"></script>
    <script src="/mesa-servicios/assets/js/imgfix.min.js"></script> 
    <script src="/mesa-servicios/assets/js/slick.js"></script> 
    <script src="/mesa-servicios/assets/js/lightbox.js"></script> 
    <script src="/mesa-servicios/assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="/mesa-servicios/assets/js/custom.js"></script>

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

</body>
</html>