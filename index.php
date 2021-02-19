<?php
session_start();
include ("conn.php");
include ("server.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Home</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>  
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>   
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158643632-1"></script>
    
    <link rel="stylesheet" href="styles/styles.css"/> 
  </head>
  
  <body>
    <?php include "includes/header.php" ?>  
      
    <!--Main body content --> 
    <div class="mainBody">

        <div class="covidMessage">
            <h6>
            <a href="covidportal.php">
            <i class="fas fa-bell"> Click here for advice and information regarding COVID19</i>
            </a>
            </h6>
        </div>

        <?php
            $query = "SELECT * FROM news ORDER BY articleDate DESC LIMIT 1;";  
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row["articleTitle"];
                        $date = $row["articleDate"];
                        $photo = $row["articlePhoto"];
                        $articleid = $row["articleID"];
                        //display default image if no uploaded profile photo 
                        if (empty($row["articlePhoto"])){
                            $photo = "<img src='img/newsdefaultimg.jpg' style='max-width: 100%; height: auto;'/>"; 
                         } else {
                            $photo = "<img src='useruploads/" . $row['articlePhoto'] . "' style='max-width: 100%; height: auto;'/>";
                         }                                 
            echo "
                <img id='aboutImg' src='img\homebanner1.jpg' class='parallaxEffect' alt='image'/>
                <div class='contentWrap'>
                <div id='aboutQuote' align='center' class='qoute col-lg-7'>   
                <div class='infoBox'>     
                <div id='newsContentBox' class='aboutBox bubble'>
                <hr>
                    <div class='headerWrap'>
                    <div id='headerLink'>
                    <h1><a href='newspage.php?articleid=$articleid'>$title</a></h1>
                    </div>
                    <div id='headerHR'></div>
                    </div>
                    "; $content=substr($row['articleContent'], 0, 220); echo" $content...
                    <div id='newsPadding'></div>

                    <br> <h6><a href='newspage.php?articleid=$articleid'><i class='far fa-arrow-alt-circle-right'></i> Read more </a>| <i class='far fa-calendar-times'></i> ". gmdate("d/m/Y | H:i", strtotime($date)) ."</h6>
                        <p><a class='button' href='news.php'><i class='far fa-arrow-alt-circle-right'></i> SEE ALL NEWS</a></p>
                </div>    
                </div> 
            </div>    
            </div>
                ";    
                     }  
            } else {
                echo "
                    <div class='container'>
                    <div class='row'>
                    <div class='newsPreview col-xs-12 mx-auto'> 
                    <h1>No Results! <i class='fas fa-exclamation-circle'></i></h1>
                    </div>
                    </div>
                    </div>
              ";
            }
        ?>  
              
        <!--Events panel-->
        <div class="row">  
            <div id="eventsTitle" align="center" class="col-md-12">     
                  <h1>Events</h1>             
              </div>
        </div>    
   
        <!--CAROUSEL -->
        <style>
        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }
        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }
        </style>
        
        <div class="row">           
            <div class="col-md-12">
            <div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
            <div class='carousel-inner'>
            <div class='carousel-item active'>
            <div class='carousel-caption'>
                
            <div class='row'>
            <!--Fetch and display events from database for SLIDE 1 -->          
            <?php
            $query = "SELECT * FROM events ORDER BY eventDate DESC LIMIT 3;";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $event = $row["eventName"];
                    $date = $row["eventDate"];
                    $time = $row["eventTime"];
                    $loc = $row["eventPlace"];  
                    $desc = $row["eventDesc"]; 
                    $today = date("Y-m-d");
        
            echo " <div id='eventCard' align='center' class='col-md-4'>
                   <hr>
                   <h3>$event</h3> 
                   <br>
                   <p><i class='far fa-calendar-times'></i> ". date("d/m/Y", strtotime($date)) ." ";
            echo " ".($today == $date ? "<span class='badge badge-pill badge-danger'>Today!</span>" : "")." "; 
            echo"
                  <br>
                  <i class='fas fa-map-marker-alt'></i> $loc
                  <br>
                  <i class='far fa-clock'></i> $time
                  <br>
                  <br>
                  <a href='events.php'>More Info </a>
                  </p>
                  <hr>
                  </div>
                ";    
                }     
            } else {
                echo "
                    <div id='eventCard' align='center' class='col-md-4'>
                    <h1><i class='fas fa-exclamation-circle'></i> No Results!</h1>
                    </div>
              ";
            }
            ?>
    
        </div>
        </div> <!--CAROUSEL CAPTION -->    
        </div>  <!--CAROUSEL ACTIVE -->  
            <div class='carousel-item'>
            <div class='carousel-caption'>
        
            <div class='row'>
            <!--Fetch and display events from database for SLIDE 2 -->          
            <?php
            $query = "SELECT * FROM `events` ORDER BY `eventDate` DESC LIMIT 3 OFFSET 3;";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $event = $row["eventName"];
                    $date = $row["eventDate"];
                    $time = $row["eventTime"];
                    $loc = $row["eventPlace"];  
                    $desc = $row["eventDesc"]; 
                    $today = date("Y-m-d");
            echo " <div id='eventCard' align='center' class='col-md-4'>
                   <hr>
                   <h3>$event</h3> 
                   <br>
                   <p><i class='far fa-calendar-times'></i> ". date("d/m/Y", strtotime($date)) ." ";
            echo " ".($today == $date ? "<span class='badge badge-pill badge-danger'>Today!</span>" : "")." ";
            echo" 
                  <br>
                  <i class='fas fa-map-marker-alt'></i> $loc
                  <br>
                  <i class='far fa-clock'></i> $time
                  <br>
                  <br>
                  <a href='events.php'>More Info </a>
                  </p>
                  <hr>
                  </div>
                ";   
                 }
            } else {
                echo "
                    <div id='eventCard' align='center' class='col-md-4'>
                    <h1><i class='fas fa-exclamation-circle'></i> No Results!</h1>
                    </div>
              ";
            } 
            ?>
            </div>
            </div>
            </div>
   
            </div> <!--CAROUSEL INNER -->
            <div id='carouselControls'>
                <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
                <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                <span class='sr-only'>Previous</span>
                </a>
                <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
                <span class='carousel-control-next-icon' aria-hidden='true'></span>
                <span class='sr-only'>Next</span>
                </a>
                </div>
            </div> <!--CAROUSEL CONTROLS -->

            <div id="eventButton" align="right" class="col-md-12">   
                <a class='button' href="events.php"><i class='far fa-arrow-alt-circle-right'></i> MORE EVENTS</a>
            </div>
                  
        </div> <!--CAROUSEL COLS -->  
        </div> <!--CAROUSEL ROWS -->
        <!--end CAROUSEL-->
                
        <!--Gallery panel -->
        <div id="galleryHome">
            <a href='gallery.php'>       
            <div class="row">
                <div id="homeGallery" align="center" class="col-md-6"> 
                    <img id="homeGalleryImg" src="img\ourteambanner.jpg"/>      
                <!--Gallery overlay -->
                <div class="galleryOverlay"></div>
                <div class="galleryText"><h1>View Gallery <i class="fas fa-external-link-alt"></i></h1></div>
                </div>
                <div id="homeGallery" align="center" class="col-md-6"> 
                     <img id="homeGalleryImg" src="img\legalbanner.jpg"/>
                </div>      
                <div id="homeGallery" align="center" class="col-md-6"> 
                      <img id="homeGalleryImg" src="img\soonbanner.jpg"/>
                  </div>
                 <div id="homeGallery" align="center" class="col-md-6"> 
                      <img id="homeGalleryImg" src="img\findusbanner.jpg"/>
                 </div>  
            </div>  
            </a>   
        </div>   
           
    <!--EUSS Panel -->  
    <div class="eussContainer">
        <div id="eussBackground">
        <div class="eussOverlay"></div>
        <div></div>
        <div class="infoBox"> 
            <div id="eussBox" class="aboutBox bubble">
                <a href="http://interethnicforum.org.uk/euss.php">
                    <h1>Apply for EU Settled Status by 30/6/21 
                        <medium><i class="fas fa-external-link-alt"></medium></i>
                    </h1>
                </a>
                <div id="euPic" align="right"><img src ="img\eu1.png"/></div>
            </div>
        </div>
        </div>
    </div>    
    </div>
    
    <?php include "includes/footer.php" ?> 

    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>

    <script>
        window.cookieconsent.initialise({
        "palette": {
          "popup": {
            "background": "#343c66",
            "text": "#cfcfe8"
            },
           "button": {
          "background": "#f71559"
         }
        }
       });

       //Parallax image
        var image = document.getElementsByClassName('parallaxEffect');
            new simpleParallax(image, {
            scale: 1.2
    });
    </script>

    <script> 
    //Parallax image
     var image = document.getElementsByClassName('parallaxEffect');
         new simpleParallax(image, {
         scale: 1.2
    });
    </script>
    
    <!--Google Analytics -->
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-158643632-1');
    </script>  
  </body> 
</html>