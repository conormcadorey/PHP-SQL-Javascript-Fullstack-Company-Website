<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Find Us</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">   
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/>

  </head>
  
<body>
    <?php include "includes/cookies.php" ?> 
    <?php include "includes/header.php" ?> 
  
    <!--Main body content --> 
    <div class="mainBody">
        <img id="aboutImg" 
             style="filter: blur(8px); -webkit-filter: blur(8px);" 
             src="img\findusbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">
                        <h1>Find us</h1>
                        <div id="headerHR"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div id="findUsAddress" align="center" class="col-lg-4">   
                            <h3><i class="fas fa-map-marker-alt"></i> <br>Address:</h3>   
                            <p>
                                20 William Street
                                <br>
                                Ballymena
                                <br>
                                Co Antrim
                                <br>
                                Northern Ireland
                                <br>
                                BT43 6AW
                            </p>
                        </div>
                        <div id="findUsOpening" align="center" class="col-lg-4">   
                            <h3><i class="far fa-clock"></i>  <br>Opening Hours:</h3>     
                            <p>Monday: 9-5
                                <br>
                                Tuesday: 9-5
                                <br>
                                Wednesday: 9-5
                                <br>
                                Thursday: 9-5
                                <br>
                                Friday: 9-5
                                <br>
                                Staurday/Sunday: Closed
                            </p>
                        </div>    
                        <div id="findUsPhone" align="center" class="col-lg-4">   
                            <h3><i class="far fa-envelope"></i>  <br>Contact:</h3>   
                            <p>Telephone:
                                <br>
                                028 2564 8822
                                <br>
                                <br>
                                Email:
                                <br>
                                Ivy.goddard@interethnicforum.org.uk
                                <br>
                                Natasha.taylor@interethnicforum.org.uk
                            </p>
                        </div>   
                        <div align="center" class="col-md-12"> 
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">
                        <h1>Map</h1>
                        <div id="headerHR"></div>
                    </div>
                    <hr>
                    <div class="container-fluid">
                        <div class="googleMap">
                            <iframe class="" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2295.975570756208!2d-6.2770810843262765!3d54.8682400673295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48604cb4d57668d1%3A0xb609fc4cf7405556!2sBallymena%20Ethnic%20Forum!5e0!3m2!1sen!2suk!4v1572975271484!5m2!1sen!2suk" width="600" height="480" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                        </div>
                    </div> 
                </div>
            </div>              
        </div>      
    </div>
    
    <?php include "includes/footer.php" ?> 

    <!--Responsive Google Map --> 
    <script type="text/javascript">
    function initialize() {
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

      // Resize stuff...
      google.maps.event.addDomListener(window, "resize", function() {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center); 
      });
    } 
    
    //Parallax image
    var image = document.getElementsByClassName('parallaxEffect');
        new simpleParallax(image, {
        scale: 1.2
    });
    </script>

  </body>
</html>