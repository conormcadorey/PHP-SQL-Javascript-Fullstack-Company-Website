<?php
session_start();
if(!isset($_SESSION["email"]))  {
   header("location:index.php");
   exit;
} 

include ("conn.php");
include ("server.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Admin Portal</title>
    
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d6cf5ed24c.js" crossorigin="anonymous"></script>   
    <!-- Parallax effect -->
    <script src="https://cdn.jsdelivr.net/npm/simple-parallax-js@5.2.0/dist/simpleParallax.min.js"></script>
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="styles/styles.css"/>
    
  </head>
  
<body>
    <?php include "includes/adminheader.php" ?>  
      
    <!--Main body content --> 
    <div class="mainBody">
        <img id="aboutImg" 
             style="filter: blur(8px); -webkit-filter: blur(8px);" 
             src="img\adminbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">    
                        <h1>Welcome to the Admin Portal <i class="fas fa-user-cog"></i></h1>
                        <div id="headerHR"></div>
                    </div> 
                        <hr>
                        <p>Please select from an option below to begin:<p> 
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg cmsInterface" id="cms1" align="center">
                                <h5>
                                    <a href="newsportal.php">
                                        <i class="fas fa-chevron-right"></i> 
                                        Create/Edit a News Article 
                                        <i class="far fa-newspaper"></i>
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg  cmsInterface" id="cms2" align="center">
                                <h5>
                                    <a href="eventportal.php">
                                        <i class="fas fa-chevron-right"></i> 
                                        Create/Edit an Event 
                                        <i class="far fa-calendar-times"></i>
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg  cmsInterface" id="cms3" align="center">
                                <h5>
                                    <a href="staffportal.php">
                                        <i class="fas fa-chevron-right"></i> 
                                        Add/Edit Staff 
                                        <i class="fas fa-user-alt"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg cmsInterface" id="cms1" align="center">
                                <h5>
                                    <a href="galleryportal.php">
                                        <i class="fas fa-chevron-right"></i>
                                        Upload/Edit Gallery 
                                        <i class="far fa-images"></i>
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg  cmsInterface" id="cms2" align="center">
                                <h5>
                                    <a href="adminportal.php">
                                        <i class="fas fa-chevron-right"></i> 
                                        Add/Edit Admin 
                                        <i class="fas fa-user-cog"></i>
                                    </a>
                                </h5>
                            </div>
                            <div class="col-lg  cmsInterface" id="cms3" align="center">
                                <h5>
                                    <a href="analyticsportal.php">
                                        <i class="fas fa-chevron-right"></i>
                                        Analytics <i class="fas fa-chart-line"></i>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                <br><hr>

                </div> 
            </div>
        </div>
    </div>
  
    <?php include "includes/footer.php" ?> 
    
  </body>
</html>