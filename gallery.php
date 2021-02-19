<?php
include ("conn.php");
include ("server.php");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IEF | Gallery</title>
    
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
             src="img\legalbanner.jpg" 
             class="parallaxEffect" 
             alt="image"
        />

        <div class="contentWrap">
            <div class="infoBox"> 
                <div id="contentBox" class="aboutBox bubble">
                    <div class="headerWrap">
                        <h1>Gallery</h1>
                        <div id="headerHR"></div>
                    </div>
                    <hr>
                    <div class='row' id='pagination_data'>
                        <!--Fetch and display events from database -->          
                        <?php

                        ?>
                    </div>   
                    <hr>
                </div> 
            </div>
        </div>

        <!-- IMAGE MODAL  -->
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">              
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;" >
              </div>
            </div>
          </div>
        </div>
        
    </div>    
        
    <?php include "includes/footer.php" ?> 

    <script>
    $(document).ready(function(){
        //when fucntion is called fetch data from gallery table
        load_data();
        function load_data(page)
        {
            $.ajax({
                url:"pagination.php",
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
    $(function() {
        //SHOW MODAL
        //$('.pop').on('click', function() {
         $(document).on('click', '.pop', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');   
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
            
