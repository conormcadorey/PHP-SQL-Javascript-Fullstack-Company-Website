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
    <title>IEF | News</title>
    
    <!-- Styles 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css"> -->
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

        <div class="mainBody">

            <img id="newsImg" 
                 src="img\soonbanner.jpg" 
                 class="parallaxEffect" 
                 alt="image"
            />
            
            <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">
                        <h1>News</h1>
                        <div id="headerHR"></div>
                    </div>
                    <hr><br>
                    <!-- -->
                        <div class='row' id='pagination_data'>      
                            <!--Fetch and display events from database --> 
                            <?php ?>   
                        </div>
                        <br><hr><br><br>

                        <form>     
                            <div class="row">
                                <div class="col-md-4 offset-md-4">  
                                    <p align='center'>You can also check out 
                                        <a href="https://www.facebook.com/InterEthnicForum/">facebook</a> 
                                        and 
                                        <a href="https://twitter.com/inter_ethnic?lang=en">twitter</a> 
                                        for more.
                                    </p>
                                      <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="SearchNews" placeholder="Search for an article" aria-label="Article Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                        <button class="btn btn-sm btn-outline-secondary" type="button">
                                            Search <i class="fas fa-search"></i>
                                        </button>
                                        <br>
                                        </div>
                                      </div>
                                </div>
                            </div>
                        </form>
                        <br><br>                    
                    </div> 
                </div>
            </div>  
        </div>     

    <?php include "includes/footer.php" ?> 

    <script>
    $(document).ready(function(){
        //when fucntion is called, fetch data from pagination component
        load_data();
        function load_data(page)
        { 
            $.ajax({
                url:"paginationnews.php",
                method: "POST",
                data:{page:page},
                success:function(data){
                    
                    $('#pagination_data').html(data); 
                }
            })
        }
        
        $(document).on('click', '.pagination_link', function()  {
            var page = $(this).attr("id");
            load_data(page);
            $('html, body').animate({ scrollTop: 0 }, 'slow');   
        }); 
    });
    </script>
                
    <script>
    //Parallax image
    var image = document.getElementsByClassName('parallaxEffect');
        new simpleParallax(image, {
        scale: 1.2
    });
    </script>
                    
  </body> 
</html>
      