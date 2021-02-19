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
    <title>IEF | Analytics</title>
    
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
    
    <!-- JQuery and datepicker-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
    
    <!--Summernote 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script> DOESN'T WORK WITH DATEPICKER-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>
    
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
                    <!-- Validation message -->
                    <?php include("errors.php"); ?>
                    <div class="headerWrap">    
                        <h1>Analytics <i class="fas fa-chart-line"></i></h1>
                        <div id="headerHR"></div> 
                        <br>
                    </div> 
                    <p>Reports are generated automatically on a regular basis using Google Analytics</p>
                    <p><a href="https://analytics.google.com/analytics/web/#/report-home/a158643632w223021909p211725633"><i class="fas fa-chevron-right"></i> Click here for more</a></p>
                        <b>
                            <a href='portal.php'>Go back</a>
                        </b>
                    <hr><br>
                    <!-- Grid row-->
                     <div class="row">
                         <div id="eventAdmin" align="left" class="col-lg-12">
                            <div align='center'>
                                <h3>Total visits</h3>
                            </div> 
                         </div>
                         <!-- Grid row-->
                         <div id="eventAdmin" align="center" class="col-xl-6">
                            <br>
                            <p>Total visitor sessions this week:</p>
                            <iframe 
                                width="600" 
                                height="371" 
                                seamless 
                                frameborder="0" 
                                scrolling="no" 
                                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTes2YY4gbQE_FsfrwpgSn9JVupckUMLVar32M5oCtGyvO77L2KvqfRUXJz8WKDr5HtvPQhGgtJBlLm/pubchart?oid=839241072&amp;format=interactive">        
                            </iframe>               
                        </div>
                        <!-- Grid row-->
                        <div id="eventAdmin" align="center" class="col-xl-6">
                            <br>
                            <p>Total visitor sessions last week:</p>
                            <iframe 
                                width="600" 
                                height="371" 
                                seamless 
                                frameborder="0" 
                                scrolling="no" 
                                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTes2YY4gbQE_FsfrwpgSn9JVupckUMLVar32M5oCtGyvO77L2KvqfRUXJz8WKDr5HtvPQhGgtJBlLm/pubchart?oid=367846963&amp;format=interactive">        
                            </iframe>
                        </div>
                    </div>
                    <hr><br>
                        <p>
                            <b>
                                <a href='portal.php'>Go back</a>
                            </b>
                        </p>
                    <br>
                </div> 
            </div>
        </div>
    </div>
    
    <?php include "includes/footer.php" ?>

    <script>
    //Parallax image
     var image = document.getElementsByClassName('parallaxEffect');
         new simpleParallax(image, {
         scale: 1.2
    });
    </script>
        
    <script>  
    $(document).ready(function(){  
         //Format date output
         $.datepicker.setDefaults({  
              dateFormat: 'yy-mm-dd'   
         //Set up date picker     
         });  
         $(function(){  
              $("#eventDate").datepicker();      
         }); 

    });  

    //Display choosen file name in submission form
      $(document).on('change', '.custom-file-input', function (event) {
          $(this).next('.custom-file-label').html(event.target.files[0].name);
      })

    //Summernote rich-text editor 
      /*$('.summernote').summernote({
      placeholder: 'required*',
      tabsize: 2,
      height: 250
      });*/

      $('.summernote').summernote({
      placeholder: 'required*',
      tabsize: 2,
      height: 250,

      toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ]

      }); 
    </script>
     
  </body>  
</html>
